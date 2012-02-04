<?php
/**
 * DokuWiki Plugin HowHard (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Fabrice DEJAIGHER <fabrice@chtiland.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'syntax.php';

class syntax_plugin_howhard extends DokuWiki_Syntax_Plugin {
    
    var $notes_hh = array('1','2','3','4','5');
    
    var $note_defaut = '1';
    

    
    public function getType() {
        return 'container';
    }
    
    //public function getAllowedTypes() { return array('formatting', 'substition', 'disabled'); }
    
    public function getPType() {
        return 'normal';
    }
    public function getAllowedTypes() { 
        return array('container','substition','protected','disabled','formatting','paragraphs');
    }

    public function getSort() {
        return 195;
    }


    public function connectTo($mode) {
        $this->Lexer->addSpecialPattern('\{\{howhard>.*?\}\}',$mode,'plugin_howhard');
    }

    public function handle($match, $state, $pos, &$handler){
	switch ($state) {
	    case DOKU_LEXER_ENTER : 
	    break;

	    case DOKU_LEXER_UNMATCHED :	
	    break;
		
	    case DOKU_LEXER_SPECIAL :
		$retour = substr($match,-3,1);
		return array($state,$retour);
	    break;
		
	    default : 
		return array($state);    
		
	
	}
	
	
    }

    public function render($mode, &$renderer, $indata) {
	list($state, $data) = $indata;
        if($mode == 'xhtml') {

	    $arr_retour = explode(',',$data);
	    $nom_user = $arr_retour[1];if(empty($nom_user)) $nom_user='USER';
	    $classe = $arr_retour[0];
	    $renderer->doc.= '<div class="howhard">';
	    $renderer->doc.= '<div class="howhard_title">'.$this->getLang('howhardtitle').'</div>';
	    $text_level = 'level'.$data;
	    $style = $this->getConf('confhowhardstyle');
	    $renderer->doc.= '<div class="howhard_img"><img src="lib/plugins/howhard/images/style'.$style.'/'.$data.'.png" borber="0"></div><div class="howhard_txt">'.$this->getLang($text_level).'</div>';
	    $renderer->doc.= '</div>';
	    
	    return true;
	} else {
	    return false;
	}

        
    }
}

?>