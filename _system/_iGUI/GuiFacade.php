<?php

/**
 * Description of GuiFacade
 *
 * @author camilo
 */
class GuiFacade {

    private $_about;
    private $_plan;
    private $_news;
    private $_carFleet;

    public function __construct(
		About $_about, Plans $_plan, News $_news, CarFleet $_carFleet
    ) {
        $this->_about = $_about;
        $this->_plan = $_plan;
        $this->_news = $_news;
        $this->_carFleet = $_carFleet;
    }

    public function getData($aParam) {
		header('Content-Type: application/json');
        $aObj = array();
        $aParQry = array();
        $aReturn = array();
        
        $aObj["NEWS"] = $this->_news;
        $aObj["ABOUT"] = $this->_about;
        $aObj["PLANS"] = $this->_plan;
        $aObj["CAR_FLEET"] = $this->_carFleet;

        $objFac = $aObj[strtoupper($aParam["type"])];
        $aParQry["section"] = (!empty($aParam["section"])) ? $aParam["section"] : "";
        $aParQry["page"] = (!empty($aParam["page"])) ? $aParam["page"] : 1;
        $aParQry["rp"] = (!empty($aParam["rp"])) ? $aParam["rp"] : 10;
        $aParQry["menu"] = (!empty($aParam["menu"])) ? $aParam["menu"] : 1;
        $aReturn = $objFac->getGuiCont($aParQry);
		$return[$aParam["type"]] = $aReturn;
        return $return;
    }
	
	function hyphenize($string) {
		$string = str_replace(array('[\', \']'), '', $string);
		$string = preg_replace('/\[.*\]/U', '', $string);
		$string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
		$string = htmlentities($string, ENT_COMPAT, 'utf-8');
		$string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
		$string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
		return strtolower(trim($string, '-'));
	}

	function cleanString($text) {
		$utf8 = array(
			'/[áàâãªä]/u'   =>   'a',
			'/[ÁÀÂÃÄ]/u'    =>   'A',
			'/[ÍÌÎÏ]/u'     =>   'I',
			'/[íìîï]/u'     =>   'i',
			'/[éèêë]/u'     =>   'e',
			'/[ÉÈÊË]/u'     =>   'E',
			'/[óòôõºö]/u'   =>   'o',
			'/[ÓÒÔÕÖ]/u'    =>   'O',
			'/[úùûü]/u'     =>   'u',
			'/[ÚÙÛÜ]/u'     =>   'U',
			'/ç/'           =>   'c',
			'/Ç/'           =>   'C',
			'/ñ/'           =>   'n',
			'/Ñ/'           =>   'N',
			'/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
			'/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
			'/[“”«»„]/u'    =>   ' ', // Double quote
			'/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
		);
		return preg_replace(array_keys($utf8), array_values($utf8), $text);
	}
}

