<?php

/**
 * Description of class
 *
 * @author camilo
 */
class About {

    private $id;
    private $title;
    private $content;

    public function __construct($idCname = 0) {
        if ($idCname)
            $this->setAtribut($idCname);
    }

    public function setAtribut($idCname = 0) {
        ///Instancia de la Conexion a la Bd
        $dbConn = new DbConn();
        ///Objeto con los atributos
        $objAtribut = NULL;
        /////Obtiene el nombre de la clase
        $cName = strtolower(get_class($this));
        ////Consulta a la bd los valores de los atributos de la clase
        $objAtribut = $dbConn->sConstruct($cName, $idCname);

        if (!empty($objAtribut)) {
            foreach ($objAtribut as $aName => $aValue) {
                if ($aName == "id_" . $cName)
                    $this->id = $aValue;
                else
                    $this->$aName = $aValue;
            }
        }
    }

    public function __get($aName) {
        return (isset($this->$aName)) ? $this->$aName : NULL;
    }

    public function __set($aName, $val) {
        $this->$aName = $val;
    }

    public function __isset($aName) {
        return isset($this->$aName);
    }

    public function __unset($aName) {
        unset($this->$aName);
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////Funciones Basicas de matenimiento del Objeto y la base de datos
    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    function crear($aPar, $trc = false) {
        $db = new DbConn();
        /////Obtiene el nombre de la clase
        $cName = get_class($this);
        $aPar['fec_cre'] = date("Y-m-d H:i:s");
        return $db->insert($cName, $aPar, $trc);
    }

    function modificar($aPar, $trc = false) {
        $aId = array();
        $db = new DbConn();
        /////Obtiene el nombre de la clase
        $cName = get_class($this);
        $aId["id_" . $cName] = $aPar["id_" . $cName];
        return $db->update($cName, $aPar, $aId, $trc);
    }

    function eliminar($aPar, $trc = false) {
        $db = new DbConn();
        /////Obtiene el nombre de la clase
        $cName = get_class($this);
        if (is_array($aPar)) {
            $aId = $aPar;
        } else {
            $aId["id_" . $cName] = $aPar["id_" . $cName];
        }
        return $db->delete($cName, $aId, $trc);
    }

    function getGuiCont($aPar) {
        $objBd = new DbConn();
        $nRows;
        $aObjElem;
        $aObjReturn;
        $cName = get_class($this);

		$aPar["filtro"] = " section = '{$aPar["section"]}'";
        $aReturn = $objBd->consultar($cName, $aPar);

        $aObjElem = $aReturn["elementos"];
        $nRows = $aReturn["n"];
        if ($nRows > 0) {
            foreach ($aObjElem as $i => $objElem) {
                $objNew = new About($objElem->id);
                $aObjReturn = array(
					$objElem->section => array(
						'title' => $objNew->title,
						'description' => $objNew->content,
						'url1' => $objNew->url1,
						'url2' => $objNew->url2
					)
				);
			}
        } else {
            $aObjReturn = array();
        }

        return $aObjReturn;
    }

    ////Array php to array Js
    function aPhpToaJs($aName, $aInput) {
        $strJs = "";
        $aJs = "";
        if (!empty($aInput)) {
            if (is_array($aInput)) {
                foreach ($aInput as $key => $value) {
                    if (is_object($value)) {
                        $aJs[] = "{$aName}['{$key}']= 'name':\"{$value->name}\"}";
                    } else {
                        $aJs[] = "{$aName}['{$key}']=\"{$value}\"";
                    }
                }
                $strJs = implode(";", $aJs);
            }
        }
        return $strJs;
    }

}
