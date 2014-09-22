<?php
require_once("class.php");
require_once("resize.php");

class Cuentas {

    //Atributos
    private $cuentas;

    public function __construct() {
        $this->cuentas = array();
    }
//////////////////////////////////////////////////////////////
//LISTA PARA EL ALTA DE CUENTAS ARCH(alta_cuentas.php)
    public function Lista_cuentas() {
        $sql = "SELECT a.id, b.servicio saf, d.sector sector, a.denominacion denominacion, c.nombre banco, DATE_FORMAT(a.fecha, '%d/%m/%Y') AS fecha
                FROM cuentas a, saf b, banco c, sector d
                WHERE a.cerrada = 0
                AND b.servicio = a.saf
                AND c.nombre = a.banco
                AND d.id = a.sector_id
                ORDER BY a.id DESC";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->cuentas[] = $reg;
        }
        return $this->cuentas;
    }

    public function idCuenta($id) {
        $sql = "SELECT a.id, b.servicio saf, d.sector sector, a.denominacion denominacion, c.nombre banco
                FROM cuentas a, saf b, banco c, sector d
                WHERE a.id = '$id'
                AND b.servicio = a.saf
                AND c.nombre = a.banco
                AND d.id = a.sector_id";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->cuentas[] = $reg;
        }
        return $this->cuentas;
        
    }
      
    public function altaCuenta($id, $tipo, $cta, $actoadm, $fecha, $obs) {
        
        if (empty($id) or empty($cta) or empty($actoadm) or empty($fecha)) {
           // header("Location: a_cuenta.php?error=1");
        }  else {
                    $sql = "SELECT cta FROM cuentas WHERE cta='$cta'";
                    $res = mysql_query($sql, Conectar::con());
                    if ($reg = mysql_fetch_assoc($res)) {
                        $this->cuentas[] = $reg;
                        header("Location: a_cuenta.php?error=2&&id=$id&&cta=$cta&&aa=$actoadm&&fa=$fecha");
                        exit;
                    }
                    else
                    {
                         $sql = "UPDATE cuentas 
                                INNER JOIN saf ON saf.servicio = cuentas.saf
                                INNER JOIN sector ON sector.id = cuentas.sector_id
                                INNER JOIN banco ON banco.nombre = cuentas.banco
                                SET cuentas.cta = '$cta', cuentas.actoadm = '$actoadm', cuentas.fechaini = '$fecha', cuentas.observaciones = '$obs', cuentas.cerrada = '1', cuentas.fdopropio = '$tipo' 
                                WHERE cuentas.id = '$id'";
                        $res = mysql_query($sql, Conectar::con());
                        echo "<script type='text/javascript'>
                            alert ('Cuenta Registrada Correctamente.');
                            window.location = 'alta_cuentas.php';
                            </script>";
                    }
                    
                }
       
        
    }
    
    public function idCuentaEdit($id) {
        $sql = "SELECT b.nombre, b.cod_ser, b.servicio, c.id, c.nombre banco, d.sector, d.id idsector, a.denominacion
                FROM cuentas a, saf b, banco c, sector d
                WHERE a.id = '$id'
                AND b.servicio = a.saf
                AND c.nombre = a.banco
                AND d.id = a.sector_id";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->cuentas[] = $reg;
        }
        return $this->cuentas;
        
    }

     public function idCuentaEdit_2($id) {
        $sql = "SELECT a.id idcta, b.nombre, b.cod_ser, b.servicio, c.id, c.nombre banco, d.sector, d.id idsector, a.denominacion, a.fdopropio fdopropio, a.cta cta, a.actoadm actoadm, a.fecha fecha, a.observaciones obs
                FROM cuentas a
                LEFT JOIN saf b ON b.servicio = a.saf
                LEFT JOIN banco c ON c.nombre = a.banco
                LEFT JOIN sector d ON d.id = a.sector_id
                WHERE a.id = '$id'";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->cuentas[] = $reg;
        }
        return $this->cuentas;
        
    }
/////////////////////////////////////////////////////////////////////////////////////    
//IDENTIFICA LA CUENTA PRIMERO CON EL SAF PARA GUARDAR EL ID - ARCHIVO (e_cuenta.php)
    public function idCta($saf) {
        $sql = "SELECT servicio FROM saf WHERE cod_ser = '$saf'";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->cuentas[] = $reg;
        }
        return $this->cuentas;
    }

    public function idBanco($banco) {
        $sql = "SELECT id, nombre FROM banco WHERE id = '$banco'";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->cuentas[] = $reg;
        }
        return $this->cuentas;
    }
  
    public function editarCuenta($id, $saf, $sector, $denominacion, $banco) {
        $sql = "UPDATE cuentas SET saf = '$saf', sector_id = '$sector', denominacion = '$denominacion', banco = '$banco' WHERE id = '$id'";
        $res = mysql_query($sql, Conectar::con());

        echo "<script type='text/javascript'>
            alert ('Cuenta Editada Correctamente.');
            window.location = 'alta_cuentas.php';
            </script>";
    }

    public function editarCuenta_2($id, $saf, $sector, $denominacion, $banco, $tipo, $cta, $acto, $fecha, $obs) {
        $sql = "UPDATE cuentas SET saf = '$saf', sector_id = '$sector', denominacion = '$denominacion', banco = '$banco',
                cta = '$cta', actoadm = '$acto', fecha = '$fecha', observaciones = '$obs', fdopropio = '$tipo'
                WHERE id = '$id'";
        $res = mysql_query($sql, Conectar::con());

        echo "<script type='text/javascript'>
            alert ('Cuenta Editada Correctamente.');
            window.location = 'edit_cuentas1.php?cta=$cta&&saf=';
            </script>";
    }
    
//////////////////////////////////////////////////////////////
//LISTA PARA LA MODIFICACION DE CUENTAS - ARCH(edit_cuentas.php)
    public function rCuenta($saf, $cta) {
        $sql = "SELECT a.id id, a.cta, a.saf saf, sector.sector sector, denominacion, banco, actoadm, 
                DATE_FORMAT(fecha, '%d/%m/%Y') as fecha, observaciones, actobaja, 
                DATE_FORMAT(fecbaja, '%d/%m/%Y') as fecbaja
                FROM cuentas a
                INNER JOIN saf ON saf.servicio = a.saf
                INNER JOIN sector ON sector.id = a.sector_id
                WHERE a.saf = trim('$saf')
                OR a.cta = trim('$cta')
                AND a.cerrada = 1
                AND a.inibaj = 0
                AND a.baja = 0";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_array($res)) {
            $this->cuentas[]=$reg;                    
        }
        return $this->cuentas;
        
    }

    public function rCuenta_2($firmante){
         $sql = "SELECT a.id id, a.cta, a.saf saf, sector.sector sector, denominacion, banco, actoadm, 
                    DATE_FORMAT(fecha, '%d/%m/%Y') as fecha, observaciones, actobaja, 
                    DATE_FORMAT(fecbaja, '%d/%m/%Y') as fecbaja, firm_datos.nombre nombre, firm_datos.dni dni
                    FROM cuentas a
                    INNER JOIN saf ON saf.servicio = a.saf
                    INNER JOIN sector ON sector.id = a.sector_id
                    INNER JOIN firm_ctas ON firm_ctas.cta = a.cta
                    INNER JOIN firm_datos ON firm_datos.dni = firm_ctas.dni
                    WHERE firm_datos.dni = '$firmante'
                    AND a.cerrada = 1
                    AND a.inibaj = 0
                    AND a.baja = 0
                    ORDER BY a.cta";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_array($res)) {
            $this->cuentas[]=$reg;                    
        }
        return $this->cuentas;
    }

    public function listaCuentas(){
         $sql = "SELECT cuentas.id id, cta, cuentas.saf saf, cuentas.organismo sector, denominacion, banco, actoadm, DATE_FORMAT(fecha, '%d/%m/%Y') as fecha, observaciones, actobaja, DATE_FORMAT(fecbaja, '%d/%m/%Y') as fecbaja, fdopropio
                 FROM cuentas
                 WHERE cuentas.cerrada = 1
                 AND cuentas.inibaj = 0 
                 AND cuentas.baja = 0
                 AND cuentas.inibaj = 0";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_array($res)) {
            $this->cuentas[]=$reg;                    
        }
        return $this->cuentas;
    }

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//IDENTIFICA AL SAF - ARCHIVO (cambiar_saf.php)
    public function idCambiarSaf($id) {
        $sql = "SELECT a.id idCta, saf.nombre, saf.cod_ser, saf.servicio, banco.id, banco.nombre banco, sector.sector, sector.id idsector, a.id idcta, a.cta, a.denominacion, a.actoadm, DATE_FORMAT(a.fecha, '%d/%m/%Y') as fecha, a.observaciones, a.fdopropio
                FROM cuentas a
                LEFT JOIN saf ON saf.servicio = a.saf
                LEFT JOIN banco ON banco.nombre = a.banco
                LEFT JOIN sector ON sector.id = a.sector_id
                WHERE a.id = '$id'";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->cuentas[] = $reg;
        }
        return $this->cuentas;
        
    }
    
    public function cambiarSaf($id, $saf, $sector) {
        $sql = "UPDATE cuentas SET saf = '$saf', sector_id = '$sector' WHERE id = '$id'";
        $res = mysql_query($sql, Conectar::con());

        echo "<script type='text/javascript'>
            alert ('Cuenta Editada Correctamente.');
            window.location = 'edit_cuentas.php';
            </script>";
    }
    
    public function bajaCta($id, $fecha) {
        $sql = "UPDATE cuentas SET fecbajainicio = '$fecha', inibaj = 1 WHERE id = '$id'";
        $res = mysql_query($sql, Conectar::con());

        echo "<script type='text/javascript'>
            alert ('Cuenta dada de Baja');
            window.location = 'edit_cuentas.php';
            </script>";
    }
    
    /////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////
    //ELIMINAR CUENTA DE (alta_cuentas.php)
    public function eliminarCuenta($id) {
        $sql = "DELETE FROM cuentas WHERE id = '$id'";
        $res = mysql_query($sql, Conectar::con());


        echo "<script type='text/javascript'>
              alert ('Cuenta Eliminada Correctamente.');
              window.location = 'alta_cuentas.php';
              </script>";
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////
    // TRAE LA ULTIMA CUENTA INGRESADA (add_firmante_cta.php)
    public function ultimaCuentaIngresada() {
        $sql = "SELECT * FROM cuentas ORDER BY id DESC";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->cuentas[] = $reg;
        }
        return $this->cuentas;
        
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    // LISTADO DE CUENTAS QUE SE LES INICIO LA BAJA. (bajas_cuentas.php)
    public function inicioBajaCuentas(){
        $sql = "SELECT id, cta, saf, organismo, denominacion, banco, DATE_FORMAT(fecbajainicio, '%d/%m/%Y') AS fecbajainicio 
                FROM cuentas 
                WHERE inibaj = 1 
                AND baja = 0 
                AND fecbajainicio IS NOT NULL";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->cuentas[] = $reg;
        }
        return $this->cuentas;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    // LISTADO DE CUENTAS QUE SE LES INICIO LA BAJA. (baja_cuenta_definotiva.php)
    public function bajaCuentaDefinitiva($id, $fecha, $acto) {
        $sql = "UPDATE cuentas SET fecbaja = '$fecha', actobaja = '$acto', inibaj = 0, fecbajainicio = NULL 
                WHERE id = '$id'";
        $res = mysql_query($sql, Conectar::con());

        echo "<script type='text/javascript'>
            alert ('Cuenta dada de Baja Definitivamente');
            window.location = 'edit_cuentas.php';
            </script>";
    }

    public function guardarFirmanteResolucion($cta, $dni, $fechaalta, $idcuenta, $resolucion, $id_cta, $cta, $foto, $firm){        
                $tipo_archivo = $_FILES["foto"]["type"];
                $tamano_archivo = $_FILES["foto"]["size"];
                
                $tamano_limite = 3072000;
                
                if ($tamano_limite < $tamano_archivo){
                    echo "<script type='text/javascript'>
                    alert ('La imagen no puede superar los 3Mb de tamaño.');
                    window.location = 'add_firmante_cta.php?firm=$firm';
                    </script>";
                }else{
                    if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")))) {
                        echo "<script type='text/javascript'>
                        alert ('La imagen sólo puede ser de formato JPEG, JPG o PNG.');
                        window.location = 'add_firmante_cta.php?firm=$firm';
                        </script>";  
                    }else{
                        $aleatorio1 = date("d-m-y");
                        $aleatorio2 = rand();
                        
                        $aleatorio = $aleatorio1.$aleatorio2;   
                        
                        copy($_FILES["foto"]["tmp_name"],"resoluciones/".$_FILES["foto"]["name"]);
                        $thumb=new thumbnail("resoluciones/".$_FILES["foto"]["name"]);    
                        $thumb->size_width(600);//setea el ancho de la copia
                        $thumb->size_height(500);//setea el alto de la copia
                        $thumb->jpeg_quality(150);//setea la calidad jpg
                        $nom=$aleatorio.".jpg";
                        $thumb->save("resoluciones/$nom");    //guardarla en el servidor
                        unlink("resoluciones/".$_FILES["foto"]["name"]);
                                
                        $sql="INSERT INTO resoluciones(id, id_cuenta, cuenta, direccion, motivo) 
                              VALUES (null,'$id_cta','$cta','$aleatorio', 'CREACION')";
                        $res=mysql_query($sql,Conectar::con());

                        $sql1 = "INSERT INTO firm_ctas (id, cta, dni, resalta, fechaalta, resbaja, fechabaja, idcuenta, baja, fechareg)
                                VALUES (NULL, '$cta', '$dni', '$resolucion', '$fechaalta', NULL, NULL, '$idcuenta', 0, NOW())";
                        $res1 = mysql_query($sql1, Conectar::con());
                           
                        echo "<script type='text/javascript'>
                        alert ('Firmante y Resolucion Asociado a la Cuenta Correctamente.');
                        window.location = 'alta_cuentas.php';
                        </script>";
                     
                    }
                }
            }
}

?>
