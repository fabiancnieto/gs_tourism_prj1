<?php

/**
 * Description of class
 *
 * @author camilo
 */
class Plans {

    private $id;

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
		$aConditions = array(
			1 => "included",
			2 => "optional",
			3 => "not_included",
			4 => "date"
		);
		$aPrices = array(
			1 => "T. Baja",
			2 => "Semana Santa",
			3 => "T. Alta"
		);
        $nRows;
        $aObjElem;
        $aObjReturn;

        $startPage = ($aPar["page"] == 1) ? 0 : ($aPar["page"] - 1) * $aPar["rp"];
        $aPar['aliasTb'] = "P";
		$aPar['filtro'] = " plan = '{$aPar["section"]}'";

        ///Id compuesto para el select
        $cName = get_class($this);
		$aPar['idComp'] = 1;

        $aReturn = $objBd->consultar($cName, $aPar);
        $aObjElem = $aReturn["elementos"];
        $nRows = $aReturn["n"];
        if ($nRows > 0) {
            foreach ($aObjElem as $i => $objElem) {
                $objNew = new Plans($objElem->id);
                $aObjReturn = array(
					$objElem->plan => array(
						'title' => $objNew->name,
						'description' => $objNew->description,
						'url2' => $objNew->url2
					)
				);
            }
			
			$aPar = array();
			$aPar['aliasTb'] = "I";
			$aPar['filtro'] = " I.plan_id = {$objNew->id}";
			$aPar['orderBy'] = "I.position";
			$aReturn = $objBd->consultar('Itinerary', $aPar);
			$aObjElem = $aReturn["elementos"];
			$nRows = $aReturn["n"];
			if ($nRows > 0) {
				foreach ($aObjElem as $j => $objElem) {
					$aObjReturn[$objNew->plan]["travel_route"][] = array(
						'title' => $objElem->title,
						'description' => $objElem->content
					);
				}
			}
			
			$aPar = array();
			$aPar['aliasTb'] = "C";
			$aPar['filtro'] = " C.plan_id = {$objNew->id}";
			$aReturn = $objBd->consultar('Conditions', $aPar);
			$aObjElem = $aReturn["elementos"];
			$nRows = $aReturn["n"];
			if ($nRows > 0) {
				foreach ($aObjElem as $j => $objElem) {
					$aObjReturn[$objNew->plan][$aConditions[$objElem->type]][] = $objElem->content;
				}
			}
			
			$aPar = array();
			$aPar['aliasTb'] = "V";
			$aPar['filtro'] = " V.plan_id = {$objNew->id}";
			$aReturn = $objBd->consultar('Pricing', $aPar);
			$aObjElem = $aReturn["elementos"];
			$nRows = $aReturn["n"];
			if ($nRows > 0) {
				$aPrice = array();
				foreach ($aObjElem as $j => $objElem) {
					$aObjReturn[$objNew->plan]["prices"][$objElem->type] = array(
						'title' => $aPrices[$objElem->type],
						'hotel' => $objElem->hotel
					);
					$aPrice[$objElem->accomodation] = $objElem->value;
				}
				$aObjReturn[$objNew->plan]["prices"][$objElem->type]['price'] = $aPrice;
			}
        } else {
            $aObjReturn = array();
        }

        return $aObjReturn;
    }

}
