<?php

class DbConn {

    private $host; //direccion ip del host donde nos conectamos a la bd
    private $bd; //nombre de la base de datos
    private $usuario; //usuario de conexion
    private $password; //clave del usuario de conexion
    private $link; //almacenamos el link para luego destruirlo
    private $result; //almacenamos el link para luego destruirlo
    private $transac; //si se esta haciendo una transaccion este toma el calor de true
    private $sqlTransac; //aca almacenamos el sql de la transaccion para finalmente ejecutarlo
    private $preFijo = "";

    //constructor en el constructor colocamos los datos por defecto, a fin de recibir de manera opcional

    function __construct($host = 'localhost', $bd = 'partwolt_gs_tourism_db', $user = 'partwolt_UsrTur', $pass = ']xGtTkZ%V}4O') {
        //asigno valores para ensamblar el string de conexion
        $this->host = $host;
        $this->bd = $bd;
        $this->usuario = $user;
        $this->password = $pass;
        //emsamblamos el string de conexion
//        $datos_bd = "host='$this->host' dbname='$this->bd' user='$this->usuario' password='$this->password'";
        //establecemos el link
	$this->link = mysqli_connect($host, $user, $pass, $bd);
        /// $this->link = mysql_connect($host, $user, $pass); //cargamos la variable para el destructor el cual elimina la conexion
        /// mysql_select_db($bd);
    }

    //destructor: aca elimino la conexion con postgres
    function __destruct() {
        //pg_close($this->link);
    }

    //funcion que ejecuta la consulta en la base de datos
    //en esta funcion envio el sql puede ser insert, update, select
    public function query($sql) {
        //ejecutamos la consulta
        $this->result = mysqli_query($this->link,$sql);
        if (!$this->result)
            echo $sql; //si no ejecuta la consulta imprimo el sql que llega solo cuando hacemos pruebas
        return $this->result;
    }

    public function fetch() {
        if ($this->result != null) {
            return $this->result->mysqli_fetch_object();
        }
    }

    function valsecuencia($nom_secuencia) {
        $query = $this->query("select nextval('" . $nom_secuencia . "') as valor;");
        if (!$query)
            return false;
        $val = $this->fetch();
        return $val->valor;
    }

    function resSecuencia($nom_secuencia, $cantReg = 1) {
        $id_seq_inicio = $this->valsecuencia($nom_secuencia);
        $sql = "SELECT SETVAL('{$nom_secuencia}', {$id_seq_inicio}+$cantReg-1, true);";
        $query = $this->consultar($sql);
        if (!$query)
            return false;
        else
            $arrReturn = array($id_seq_inicio, $id_seq_inicio + $cantReg - 1);
        return $arrReturn;
    }

    public function sConstruct($cName, $idCname, $idComp = 0) {
        $aAtribut = array();
        $result = "";
        $idElem = ($idComp > 0 ) ? "id_{$cName}" : "id";
        $sql = "SELECT * FROM {$this->preFijo}{$cName} WHERE {$idElem}={$idCname};";

        $result = $this->query($sql);
        ///$result = $this->result->execute();
        if (!empty($result)) {
            $aAtribut = $this->fetch_all();
            unset($this);
            return $aAtribut['elementos'][0];
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //arrPar indica que se recibe un array con todos los parametros que se utilizan que son:
    //['aliasTb'] => String con el nombre del alias de la tabla de la clase por defecto vacio
    //['join'] => String con el join que se reciba de otras tablas por defecto vacio
    //['filtro'] => String con el filtro que hemos ensamblado por defecto vacio
    //['orderBy'] => String con el campo por el cual debe ordenar, por defecto queda el id de la tabla
    //['limit'] => String con el la limitacion de registros que debe hacer si esta vacio por seguridad limita a 1000
    //nombre de la clase que estamos generando este campo es OBLIGATORIO
    function consultar($nomClase, $arrPar = array()) {
        $tb = "";
        $sql = "";
        $n = "";
        $nomClase = strtolower($nomClase);

        $arrPar['aliasTb'] = (isset($arrPar['aliasTb'])) ? $arrPar['aliasTb'] : '';
        $arrPar['join'] = (isset($arrPar['join'])) ? $arrPar['join'] : '';
        $arrPar['filtro'] = (isset($arrPar['filtro'])) ? $arrPar['filtro'] : '';
        $arrPar['orderBy'] = (isset($arrPar['orderBy'])) ? $arrPar['orderBy'] : '';
        $arrPar['groupBy'] = (isset($arrPar['groupBy'])) ? $arrPar['groupBy'] : '';
        $arrPar['limit'] = (isset($arrPar['limit'])) ? $arrPar['limit'] : '';
        $arrPar['idComp'] = (isset($arrPar['idComp'])) ? $arrPar['idComp'] : 1;
        $retornos = array();

        $tb = "{$this->preFijo}{$nomClase} {$arrPar['aliasTb']}";
        $idTable = ($arrPar['idComp'] == 1) ? "id" : "id_{$nomClase}";
        $sql = "SELECT " . ($arrPar['aliasTb'] ? "{$arrPar['aliasTb']}.{$idTable}" : "{$idTable}") . " FROM {$tb} ";
        $sql .= " " . ($arrPar['join'] != '' ? $arrPar['join'] : '');
        $sql .= ($arrPar['filtro'] != '' ? " WHERE " . $arrPar['filtro'] : '');
        $sql .= ($arrPar['groupBy'] != '' ? " GROUP BY " . $arrPar['groupBy'] : '');
        $sql .= " ORDER BY " . ($arrPar['orderBy'] != '' ? $arrPar['orderBy'] : " {$idTable} ");
        $sql .= " " . ($arrPar['limit'] != '' ? $arrPar['limit'] : 'LIMIT 1000 OFFSET 0');

        $this->query($sql);
        $arrQuery = $this->fetch_all();

        if ($arrQuery['num'] > 0) {
            foreach ($arrQuery['elementos'] as $arrData) {
                $retornos[] = new $nomClase($arrData[$idTable]);
            }
        }
        return array('elementos' => $retornos, 'n' => $arrQuery['num']);
    }

//    function consultar($sql) {
//        return $this->query($sql);
//    }
    // function que retorna el numero de registros de una consulta
    function num_reg($tb, $filtro = '', $join = '') {
        $sql = "SELECT COUNT(*) FROM {$tb}";

        if ($join != '')
            $sql .= " " . $join;
        if ($filtro != '')
            $sql .= " WHERE " . $filtro;

        $consulta = $this->consultar($sql);
        $cant = $this->result->mysqli_fetch_row();
        return $cant[0];
    }

    function num_registros() {
//        $valor = $this->consultar($sql);
        return mysqli_num_rows($this->result);
    }

    //metodo que retorna la hora actual
    //sumando o restando horas, minutos, o intervalos
    function current_time($arrPar = array()) {
        $sql = "SELECT CURRENT_TIME ";

        if (isset($arrPar['suma'])) {
            if (isset($arrPar['tipo']))
                $sql .= ' + ' . $arrPar['tipo'] . ' \'' . $arrPar['suma'] . '\'';
        }
        $sql .= " AS hora;";

        $this->query($sql);
        $hora = $this->result->fetch_row();

        return $hora->hora;
    }

    //metodo que retorna la hora actual
    //sumando o restando horas, minutos, o intervalos
    function current_time_stamp($arrPar = array()) {
        $sql = "SELECT CURRENT_TIMESTAMP ";

        if (isset($arrPar['suma'])) {
            if (isset($arrPar['tipo']))
                $sql .= ' + ' . $arrPar['tipo'] . ' \'' . $arrPar['suma'] . '\'';
        }
        $sql .= " AS hora;";

        $this->query($sql);
        $hora = $this->result->fetch();

        return $hora->hora;
    }

    //metodo que retorna el id del primer elemento que encuentre segun el filtro
    function id_elemn($arrPar) {
        $id = $arrPar['id'];
        $tName = $arrPar['tb'];
        $sql = 'SELECT ' . $id . ' id FROM ' . $tName;

        if ($arrPar['filtro'] != '') {
            $sql .= ' WHERE ' . $arrPar['filtro'];
        }

        $sql .= ' limit 1;';
        $this->query($sql);
        $objId = $this->result->fetch();

        return (is_object($objId)) ? $objId->id : '';
    }

    function insert($tName, $arrData, $trc = false) {
        $sql = '';
        $sqlC = '';
        $sqlV = '';

        $sql .= 'INSERT INTO ' . $tName;

        foreach ($arrData as $cName => $cValue) {
            $sqlC .= ($sqlC ? ' ,' : ' ') . $cName;
            $sqlV .= ($sqlV ? ' ,' : ' ') . (($cValue != '' or $cValue == 0) ? "'" . $cValue . "'" : 'null');
        }

        $sql .= ' (' . $sqlC . ')values(' . $sqlV . ');';

        $this->sqlTransac .= ($trc == true or $this->transac == true) ? $sql : '';
        return ($trc == false) ? $this->query($sql) : $sql;
    }

    //metodo que realiza un update tb la bd
    //recibe: nombre de la tabla, array de datos, array del filtro
    function update($tName, $arrData, $arrIdentifier, $trc = false) {
        $sql = '';
        $sqlC = ''; //sql de los campos
        $sqlW = ''; //sql del where

        $sql .= 'UPDATE ' . $tName . ' SET ';

        foreach ($arrData as $cName => $cValue) {
            $sqlC .= ($sqlC ? ' ,' : ' ') . (($cValue != '' or $cValue == 0 or (is_numeric($cValue)) or $cValue != null or $cValue != NULL) ? $cName . '=\'' . $cValue . '\'' : $cName . '= null ');
        }

        $sql .= $sqlC; //
        $sql .= $this->identifier($arrIdentifier);
        $sql .= ';';

        $this->sqlTransac .= ($trc == true or $this->transac == true) ? $sql : '';
        return ($trc == false) ? $this->query($sql) : $sql;
    }

    //metodo que elimina
    function delete($tName, $arrIdentifier, $trc = false) {
        $sql = '';
        $sql .= 'DELETE FROM ' . $tName;
        $sql .= $this->identifier($arrIdentifier);
        $sql .= ';';

        $this->sqlTransac .= ($trc == true or $this->transac == true) ? $sql : '';
        return ($trc == false) ? $this->query($sql) : $sql;
    }

//    public function fetch_all($sql, $arrIdentifier = array(), $arrPar = array()) {
//        $sql .= $this->identifier($arrIdentifier);
//        if (isset($arrPar['groupBy']))
//            $sql .= ' GROUP BY ' . $arrPar['groupBy'];
//        if (isset($arrPar['orderBy']))
//            $sql .= ' ORDER BY ' . $arrPar['orderBy'];
//        if (isset($arrPar['limit']))
//            $sql .= ' LIMIT ' . $arrPar['limit'];
//        if (isset($arrPar['offset']))
//            $sql .= ' OFFSET ' . $arrPar['offset'];
//
//        $this->query($sql);
//
//        if ($this->result != null) {
//            return $this->result->mysqli_fetch_all();
//        }
//    }

    private function fetch_all() {
        $data = array();

        while ($row = mysqli_fetch_array($this->result, MYSQL_ASSOC)) {
            $data[] = $row;
        }
        $data["elementos"] = $data;
        $data["num"] = $this->num_registros();
        mysqli_free_result($this->result);
        return $data;
    }

    //ensambla el filtro de cualquier cosa
    private function identifier($arrIdentifier = array()) {
        $sql = '';
        $sqlFiltro = '';
        if (sizeof($arrIdentifier) > 0) {
            $strW = "";
            $arrTempFiltro = array();
            $arrFiltro = array();

            $arrFiltroSpecial = array(
                'like' => "like", //LIKE
                'dif' => "dif", //"<>"
                'menor' => 'menor', //"<",
                'menorI' => 'menorI', //,"<=",
                'mayor' => 'mayor', //">",
                'mayorI' => 'mayorI', //">=",
                'in' => 'in', //"IN",
                'notIn' => 'notIn', //"NOT IN",
                'isTrue' => 'isTrue', //"IS TRUE",
                'isNotTrue' => 'isNotTrue', //"IS NOT TRUE",
                'isNull' => 'isNull', //"IS NULL",
                'isNotNull' => 'isNotNull', //"IS NOT NOLL",
            );
            foreach ($arrIdentifier as $cName => $cValue) {
                if (!in_array($cName, $arrFiltroSpecial)) {
                    $str = $cName . "='" . $cValue . "'";
                    array_push($arrFiltro, $str);
                } else {
                    $arrTempFiltro[$cName] = $cValue;
                    unset($arrIdentifier[$cName]);
                }
                $str = "";
            }

            if (sizeof($arrTempFiltro) > 0)
                foreach ($arrTempFiltro as $sName => $sValue) {
                    if ($sName == "like")
                        foreach ($sValue as $cName => $cValue) {
                            array_push($arrFiltro, $cName . " LIKE '" . $cValue . "'");
                        } elseif ($sName == "dif")
                        foreach ($sValue as $cName => $cValue) {
                            array_push($arrFiltro, $cName . " <> '" . $cValue . "'");
                        } elseif ($sName == "menor")
                        foreach ($sValue as $cName => $cValue) {
                            array_push($arrFiltro, $cName . " < '" . $cValue . "'");
                        } elseif ($sName == "menorI")
                        foreach ($sValue as $cName => $cValue) {
                            array_push($arrFiltro, $cName . " <= '" . $cValue . "'");
                        } elseif ($sName == "mayor")
                        foreach ($sValue as $cName => $cValue) {
                            array_push($arrFiltro, $cName . " > '" . $cValue . "'");
                        } elseif ($sName == "mayorI")
                        foreach ($sValue as $cName => $cValue) {
                            array_push($arrFiltro, $cName . " >= '" . $cValue . "'");
                        } elseif ($sName == "in")
                        foreach ($sValue as $cName => $cValue) {
                            array_push($arrFiltro, $cName . " IN " . $cValue);
                        } elseif ($sName == "notIn")
                        foreach ($sValue as $cName => $cValue) {
                            array_push($arrFiltro, $cName . " NOT IN " . $cValue);
                        } elseif ($sName == "isTrue")
                        foreach ($sValue as $cName => $cValue) {
                            array_push($arrFiltro, $cName . " IS TRUE ");
                        } elseif ($sName == "isNotTrue")
                        foreach ($sValue as $cName => $cValue) {
                            array_push($arrFiltro, $cName . " IS NOT TRUE ");
                        } elseif ($sName == "isNull")
                        foreach ($sValue as $cName => $cValue) {
                            array_push($arrFiltro, $cName . " IS NULL ");
                        } elseif ($sName == "isNotNull")
                        foreach ($sValue as $cName => $cValue) {
                            array_push($arrFiltro, $cName . " IS NOT NULL ");
                        }
                }

            $strW = implode(" AND ", $arrFiltro);
            $sqlFiltro = ' WHERE ' . $strW;
        }

        return $sqlFiltro;
    }

    public function begin($trc = false) {
        $this->transac = true;
        $this->sqlTransac .= ($trc == false) ? 'BEGIN;' : '';
    }

    public function commit($trc = false) {
        $this->sqlTransac .= ($trc == false) ? 'COMMIT;' : '';
        return ($trc == false) ? $this->query($this->sqlTransac) : $this->sqlTransac;
    }

}
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
if (!function_exists('json_encode'))
{
  function json_encode($a=false)
  {
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a))
    {
      if (is_float($a))
      {
        // Always use "." for floats.
        return floatval(str_replace(",", ".", strval($a)));
      }
 
      if (is_string($a))
      {
        static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
        return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
      }
      else
        return $a;
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a))
    {
      if (key($a) !== $i)
      {
        $isList = false;
        break;
      }
    }
    $result = array();
    if ($isList)
    {
      foreach ($a as $v) $result[] = json_encode($v);
      return '[' . join(',', $result) . ']';
    }
    else
    {
      foreach ($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
      return '{' . join(',', $result) . '}';
    }
  }
}
?>