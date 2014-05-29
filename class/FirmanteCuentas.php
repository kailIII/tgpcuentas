<?php

require_once("class.php");

class FirmanteCuentas {

	private $firmanteCuenta;

	public function __construct() {
		$this->firmanteCuenta = array();
	}

	public function addFirmanteCuentas($cta, $dni, $fechaalta, $idcuenta, $resolucion){
		$sql = "INSERT INTO firm_ctas (id, cta, dni, resalta, fechaalta, resbaja, fechabaja, idcuenta, baja, fechareg)
				VALUES (NULL, '$cta', '$dni', '$resolucion', '$fechaalta', NULL, NULL, '$idcuenta', 0, NOW())";
		$res = mysql_query($sql, Conectar::con());
           
        echo "<script type='text/javascript'>
        alert ('Firmante Asociado a la Cuenta Correctamente.');
        window.location = 'alta_cuentas.php';
        </script>";
	}

	public function listFirmantesCuenta($id){
		$sql = "SELECT a.id id, b.dni dni, b.nombre nombre, b.domicilio domicilio, b.cargo cargo, DATE_FORMAT(a.fechaalta, '%d/%m/%Y') as fechaalta, a.resalta resalta 
				FROM firm_ctas a, firm_datos b
				WHERE b.dni = a.dni
				AND a.idcuenta = '$id'
				AND  a.baja = 0
				ORDER BY b.nombre";
		$res = mysql_query($sql, Conectar::con());
		 while ($reg = mysql_fetch_assoc($res)) {
            $this->firmanteCuenta[] = $reg;
        }
        return $this->firmanteCuenta;
	}

	public function firmanteCuenta($firm){
		$sql = "SELECT a.id id, b.dni dni, b.nombre nombre, b.domicilio domicilio, b.cargo cargo, a.fechaalta fecha, c.actoadm actoadm, a.resalta resalta 
				FROM firm_ctas a, firm_datos b, cuentas c 
				WHERE a.id = '$firm'
				AND a.cta = c.cta
				AND a.dni = b.dni";
		$res = mysql_query($sql, Conectar::con());
		 while ($reg = mysql_fetch_assoc($res)) {
            $this->firmanteCuenta[] = $reg;
        }
        return $this->firmanteCuenta;
	}

	public function modificarResolucionFirmante($id, $idCta, $fecha_alta, $resolucion_alta){
		$sql = "UPDATE firm_ctas SET fechaalta = '$fecha_alta', resalta = '$resolucion_alta' WHERE id = '$id'";
		$res = mysql_query($sql, Conectar::con());

		echo "<script type='text/javascript'>
            alert ('Resolucion de Alta Editada Correctamente.');
            window.location = 'modificar_firmante.php?id=$idCta';
            </script>";
	}

	public function bajaResolucionFirmante($id, $idCta, $fecha_baja, $resolucion_baja){
		$sql = "UPDATE firm_ctas SET fechabaja = '$fecha_baja', resbaja = '$resolucion_baja', baja = 1 WHERE id = '$id'";
		$res = mysql_query($sql, Conectar::con());

		echo "<script type='text/javascript'>
            alert ('Baja de Firmante Correctamente.');
            window.location = 'modificar_firmante.php?id=$idCta';
            </script>";
	}
}

?>