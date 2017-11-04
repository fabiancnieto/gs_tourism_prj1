<?php

/**
 * Description of class
 *
 * @author camilo
 */
class Venta {

    private $id;
    private $id_venta;
    private $id_provider;
    private $cantidad;
    private $valor;
    private $code;
    private $estado;
    private $id_user_cre;
    private $date_cre;
    private $id_ciudad_ent;
    private $direccion_ent;
    private $valor_envio;

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
        $objAtribut = $dbConn->sConstruct($cName, $idCname, 2);

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
        $db = new conection();
        /////Obtiene el nombre de la clase
        $cName = get_class($this);
        $aPar['fec_cre'] = date("Y-m-d H:i:s");
        return $db->insert($cName, $aPar, $trc);
    }

    function modificar($aPar, $trc = false) {
        $aId = array();
        $db = new conection();
        /////Obtiene el nombre de la clase
        $cName = get_class($this);
        $aId["id_" . $cName] = $aPar["id_" . $cName];
        return $db->update($cName, $aPar, $aId, $trc);
    }

    function eliminar($aPar, $trc = false) {
        $db = new conection();
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

        $startPage = ($aPar["page"] == 1) ? 0 : ($aPar["page"] - 1) * $aPar["rp"];
        $aPar['aliasTb'] = "P";

        if ($aPar["provider"] > 0) {
//            if ($aPar["category"] > 0) {
                $aPar['orderBy'] = "PR.due_date ASC,P.num_avai_items DESC";
                $aPar['filtro'] = "P.status=1 AND PR.id_menu={$aPar["menu"]} AND PR.due_date >= CURDATE() AND PR.status=1 AND P.id_categoria={$aPar["provider"]}";
//            } else {
//                $aPar['orderBy'] = "P.name";
//                $aPar['filtro'] = "P.id_provider={$aPar["provider"]} AND P.status=1 AND P.id_categoria={$aPar["category"]}";
//            }
        } elseif ($aPar["provider"] == 0) {
            $aPar['orderBy'] = "RAND()";
            $aPar['filtro'] = "P.status=1 AND PR.id_menu={$aPar["menu"]} AND PR.due_date >= CURDATE() AND PR.status=1";
        }
        $aPar['join'] = "INNER JOIN provider PR ON P.id_provider=PR.id_provider ";
        $aPar['limit'] = "LIMIT {$aPar["rp"]} OFFSET {$startPage}";
        ///Id compuesto para el select
        $aPar['idComp'] = 2;

        $cName = get_class($this);

        $aReturn = $objBd->consultar($cName, $aPar);
        $aObjElem = $aReturn["elementos"];
        $nRows = $aReturn["n"];
        if ($nRows > 0) {
            foreach ($aObjElem as $i => $objElem) {
                $objNew = new Venta($objElem->id);
                $objCategoria = new Categoria($objNew->id_categoria);
                $aObjReturn[$i]["title"] = utf8_encode("{$objNew->name}");
                $aObjReturn[$i]["description"] = "{$objNew->description}";
                $aObjReturn[$i]["short_desc"] = "{$objNew->short_desc}";
                $aObjReturn[$i]["img"] = "{$objNew->img_Venta}";
                $aObjReturn[$i]["view_img"] = "{$objNew->view_short_img}";
                $aObjReturn[$i]["img_short"] = "{$objNew->img_short_desc}";
                $aObjReturn[$i]["id_color"] = "{$objNew->id_color}";
                $aObjReturn[$i]["category"] = "{$objCategoria->nombre}";
            }
        } else {
            $aObjReturn = array();
        }

        return $aObjReturn;
    }

}

?>
