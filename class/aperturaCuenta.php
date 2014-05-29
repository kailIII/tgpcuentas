<?php

require_once("class.php");

class AperturaCta {

    //Atributos
    private $aper_cta;

    public function __construct() {
        $this->aper_cta = array();
    }

//ALTA DE APERTURA DE CUENTAS - ARCHIVO (apertura_cta.php)
    public function idActa($saf) {
        $sql = "SELECT servicio FROM saf WHERE cod_ser = '$saf'";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->aper_cta[] = $reg;
        }
        return $this->aper_cta;
    }
     public function idBanco($banco) {
        $sql = "SELECT nombre FROM banco WHERE id = '$banco'";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->aper_cta[] = $reg;
        }
        return $this->aper_cta;
    }
    public function idSector($nombre_sector) {
        $sql = "SELECT sector FROM sector WHERE id = '$nombre_sector'";
         $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->aper_cta[] = $reg;
        }
        return $this->aper_cta;
    }
    public function Alta_Acta($saf, $nombre_sector, $sector, $denominacion, $banco) {
    
       $sql_2 = "INSERT INTO cuentas (id, sector_id, cta, saf, organismo, fecha, denominacion, banco, 
                 actoadm, fechaini, cerrada, actobaja, fecbaja, observaciones, baja, fecbajainicio, 
                 inibaj, fdopropio, iconofp) VALUES (NULL, '$sector',NULL, '$saf', '$nombre_sector', NOW(), "
               . "'$denominacion', '$banco', NULL, NULL, '0', NULL, NULL, NULL, '0', NULL, '0', NULL, NULL)";
       $res_2 = mysql_query($sql_2, Conectar::con());
        echo "<script type='text/javascript'>
                alert ('Cuenta Registrada Correctamente.');
                window.location = 'apertura_cta.php';
                </script>";
    }


    public function Eliminar_Acta($id) {


        $sql = "DELETE FROM usuarios WHERE id_usu = $id";
        $res = mysql_query($sql, Conectar::con());


        echo "<script type='text/javascript'>
              alert ('Usuario Eliminado Correctamente.');
              window.location = 'a_usuarios.php';
              </script>";
    }


    public function Id_Usuario($id) {
        $sql = "SELECT * FROM usuarios WHERE usuarios.id_usu = '$id'";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->aper_cta[] = $reg;
        }
        return $this->aper_cta;
    }

  
    public function Editar_Acta($id, $ape_nom, $correo, $tel, $user, $pass) {
        $sql = "UPDATE usuarios SET ape_nom = '$ape_nom', correo = '$correo', telefono = '$tel', user = '$user', pass = '$pass' WHERE id_usu = '$id'";
        $res = mysql_query($sql, Conectar::con());

        echo "<script type='text/javascript'>
            alert ('Usuario Editado Correctamente.');
            window.location = 'a_usuarios.php';
            </script>";
    }

   
}


?>
