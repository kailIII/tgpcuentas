<?php

require_once("class.php");

class Saf {

    //Atributos
    private $saf;

    public function __construct() {
        $this->saf = array();
    }

    
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    public function Ordenar_Saf() {
    
	 $sql = "SELECT * FROM saf ORDER BY servicio" ;
         $res = mysql_query($sql, Conectar::con());
         while ($reg= mysql_fetch_assoc($res)) {
             $this->saf[] = $reg;
             
         }
         return $this->saf;
  
    }
    
     //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////

   
}

?>
