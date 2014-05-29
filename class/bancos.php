<?php

require_once("class.php");

class Bancos {

    //Atributos
    private $banco;

    public function __construct() {
        $this->banco = array();
    }

     public function Alta_Banco($saf, $sector, $denominacion, $banco) {
    
       $sql_2 = "INSERT INTO cuentas (id, sector_id, cta, saf, organismo, fecha, denominacion, banco, 
                 actoadm, fechaini, cerrada, actobaja, fecbaja, observaciones, baja, fecbajainicio, 
                 inibaj, fdopropio, iconofp) VALUES (NULL, '$sector',NULL, '$saf', NULL, NOW(), "
               . "'$denominacion', '$banco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL )";
       $res_2 = mysql_query($sql_2, Conectar::con());
        echo "<script type='text/javascript'>
                alert ('Cuenta Registrada Correctamente.');
                window.location = 'apertura_cta.php';
                </script>";
    }


  
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
 
    public function Ordenar_Banco(){
    
    
	 $sql = "SELECT id,nombre FROM banco ORDER BY nombre" ;
         $res = mysql_query($sql, Conectar::con());
         while ($reg= mysql_fetch_assoc($res)) {
             $this->banco[] = $reg;
             
         }
         return $this->banco;
  
    }
    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
	

}

?>
