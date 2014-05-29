<?php

require_once("class.php");

class Sectores {

    //Atributos
    private $sector;

    public function __construct() {
        $this->sector = array();
    }

////////////////////////////////////////////ALTA DE SECTORES
    public function Alta_Sector($saf) {
    
       $sql_1 = "INSERT INTO sector(saf, cod_saf) SELECT servicio, cod_ser FROM saf WHERE cod_ser = '$saf'";
       $res_1 = mysql_query($sql_1, Conectar::con());
       
    }
    
    public function Alta_Sector1($sector) {
        
        $sql_2 = "UPDATE sector SET sector = '$sector' WHERE id = LAST_INSERT_ID()";
        $res_2 = mysql_query($sql_2, Conectar::con());
         echo "<script type='text/javascript'>
                alert ('Sector Registrado Correctamente.');
                window.location = 'alta_sectores.php';
                </script>";
    }
////////////////////////////////////////////ALTA DE SECTORES
//
////////////////////////////////////////////ELIMINAR SECTOR    
    public function Eliminar_Sector($saf, $sector) {

        $sql = "UPDATE sector SET baja = '1' WHERE id = '$sector' AND cod_saf = '$saf'";
        $res = mysql_query($sql, Conectar::con());
       
         echo "<script type='text/javascript'>
              alert ('Sector dado de Baja Correctamente.');
              window.location = 'baja_sectores.php';
              </script>";
    }


    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
     
     public function Ordenar_Sector(){
    
    
	 $sql = "SELECT * FROM sector WHERE baja = '0' ORDER BY cod_saf,sector" ;
         $res = mysql_query($sql, Conectar::con());
         while ($reg= mysql_fetch_assoc($res)) {
             $this->sector[] = $reg;
             
         }
         return $this->sector;
  
    }
    
   
    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function Nombre_Sector($idSector) {
        $sql = "SELECT sector.sector FROM sector, cuentas WHERE sector.id = cuentas.sector_id 
                AND cuentas.sector_id = '$idSector'";
         $res = mysql_query($sql, Conectar::con());
         while ($reg= mysql_fetch_assoc($res)) {
             $this->sector[] = $reg;
             
         }
         return $this->sector;
    }
}

?>
