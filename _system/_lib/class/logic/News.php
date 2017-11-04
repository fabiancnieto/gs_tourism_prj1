<?php

/**
 * Description of class
 *
 * @author camilo
 */
class News {

    private $id;
    private $title;
    private $description;
    private $state;
    private $img_path;
    private $date_expira;
    private $id_user_cre;
    private $date_cre;

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

    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////Funciones Basicas de matenimiento del Objeto y la base de datos
    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////

    function getGuiCont($aPar) {
        $objBd = new DbConn();
        $nRows;
        $aObjElem;
        $aObjReturn;
        $aPar['filtro'] = "status=1";
        $aPar['orderBy'] = "plan";
        $aPar['limit'] = "LIMIT 16";
        $aPar['idComp'] = 1;
        $aPar['aliasTb'] = "N";
        $aPar['join'] = "INNER JOIN plans P ON N.plan=P.plan ";

        $cName = get_class($this);

        $aReturn = $objBd->consultar($cName, $aPar);
        $aObjElem = $aReturn["elementos"];
        $nRows = $aReturn["n"];
        if ($nRows > 0) {
            foreach ($aObjElem as $i=>$objElem) {
                $objNew = new News($objElem->id);
                $aObjReturn[$i]["plan	"] = "{$objNew->plan}";
				$objNew = new Plans($objElem->id);
                $aObjReturn[$i]["pic"] = "{$objNew->img_path}";
            }
        } else {
            $aObjReturn = array();
        }

        return $aObjReturn;
    }

}

?>
