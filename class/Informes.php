<?php

require_once("class.php");

class Informes {

	private $informes;

	public function __construct() {
		$this->informes = array();
	}

	public function cantidadPorSaf(){
		$sql = "SELECT saf, saf.nombre nombre, COUNT(cta) cantidad 
				FROM cuentas, saf 
				WHERE saf.servicio = cuentas.saf
				AND cuentas.baja = 0
				AND cuentas.cerrada = 1
				GROUP BY saf";
		$res = mysql_query($sql, Conectar::con());
		 while ($reg = mysql_fetch_assoc($res)) {
            $this->informes[] = $reg;
        }
        return $this->informes;
	}

	public function cantidadPorBanco(){
		$sql = "SELECT cuentas.banco nombre, COUNT(cuentas.id) AS cantidad FROM banco, cuentas 
				WHERE cuentas.banco = banco.nombre
				AND cuentas.baja = 0
				AND cuentas.cerrada = 1
				GROUP BY cuentas.banco";
		$res = mysql_query($sql, Conectar::con());
		 while ($reg = mysql_fetch_assoc($res)) {
            $this->informes[] = $reg;
        }
        return $this->informes;
	}

	public function bancosCuentasSimple($banco){
		$sql = "SELECT banco, cta, denominacion, saf 
				FROM cuentas 
				WHERE banco='$banco'
				AND cerrada = 1
				AND baja = 0";
		$res = mysql_query($sql, Conectar::con());
		 while ($reg = mysql_fetch_assoc($res)) {
            $this->informes[] = $reg;
        }
        return $this->informes;
	}	
}

?>