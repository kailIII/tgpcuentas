<?php

require_once("class.php");

class Firmantes {

    //Atributos
    private $firmantes;

    public function __construct() {
        $this->firmantes = array();
    }

////////////////////////////////////////////ALTA DE FIRMANTES - ARCHIVO (alta_firmantes.php)
////////////////////////////////////////////////////////////////////////////////////////////
    
    public function idSaf($saf) {//Funcion para guardar el SAF en la Tabla "firm_datos"
        $sql = "SELECT servicio FROM saf WHERE cod_ser = '$saf'";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->firmantes[] = $reg;
        }
        return $this->firmantes;
    }
       
    public function altaFirmante($saf, $dni, $ape_nom, $domicilio, $cargo) 
      {
        
       if (empty($saf) or empty($dni) or empty($ape_nom) or empty($domicilio) or empty($cargo)) 
        {
           header("Location: alta_firmantes.php?error=1");
        }else
            {
                $sql = "SELECT dni FROM firm_datos WHERE dni = trim('$dni')";
                $res = mysql_query($sql, Conectar::con());
                if ($reg = mysql_fetch_assoc($res)) {
                    $this->firmantes[] = $reg;
                    
                    header("Location: alta_firmantes.php?error=2&&dni=$dni&&an=$ape_nom&&do=$domicilio&&ca=$cargo");
                }
                                
                else
                    {
                    $sql = "INSERT INTO firm_datos(dni, nombre, saf, domicilio, cargo) VALUES ('$dni', '$ape_nom', '$saf', '$domicilio', '$cargo')";
                    $res = mysql_query($sql, Conectar::con());
                    echo "<script type='text/javascript'>
                             alert ('Firmante Registrado Correctamente.');
                             window.location = 'alta_firmantes.php';
                             </script>";
                    }
            }
    
       
    }
    
    public function altaFirmante_2($saf, $dni, $ape_nom, $domicilio, $cargo) 
      {
        
       if (empty($saf) or empty($dni) or empty($ape_nom) or empty($domicilio) or empty($cargo)) 
        {
           header("Location: alta_firmantes.php?error=1");
        }else
            {
                $sql = "SELECT dni FROM firm_datos WHERE dni = trim('$dni')";
                $res = mysql_query($sql, Conectar::con());
                if ($reg = mysql_fetch_assoc($res)) {
                    $this->firmantes[] = $reg;
                    
                    header("Location: alta_firmantes.php?error=2&&dni=$dni&&an=$ape_nom&&do=$domicilio&&ca=$cargo");
                }
                                
                else
                    {
                    $sql = "INSERT INTO firm_datos(dni, nombre, saf, domicilio, cargo) VALUES ('$dni', '$ape_nom', '$saf', '$domicilio', '$cargo')";
                    $res = mysql_query($sql, Conectar::con());
                    echo "<script type='text/javascript'>
                             alert ('Firmante Asociado Correctamente.');
                             window.location = 'add_firmante_cta.php?firm=$dni';
                             </script>";
                    }
            }
    
       
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////RESULTADO DE BUSQUEDA - ARCHIVO (buscar_firmante1.php)
    public function rFirmante() {
        $sql = "SELECT dni, nombre, saf, id, domicilio, cargo
                FROM firm_datos
                WHERE saf = '".$_POST['saf']."'
                OR dni = '".$_POST['dni']."' ORDER BY nombre";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_array($res)) {
            $this->firmantes[] = $reg;           
        }
        return $this->firmantes; 
    }
    
    public function rFirmante1() {
          $sql = "SELECT dni, nombre, saf, id, domicilio, cargo
                    FROM firm_datos
                    WHERE INSTR(nombre, '".$_POST['ape_nom']."') ORDER BY nombre";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_array($res)) {
            $this->firmantes[] = $reg;           
        }
        return $this->firmantes; 
    }

    public function listaFirmante() {
        $sql = "SELECT *
                FROM firm_datos
                ORDER BY nombre";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_array($res)) {
            $this->firmantes[] = $reg;           
        }
        return $this->firmantes; 
    }
////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////FUNCION QUE IDENTIFICA FIRMANTE PARA MODIFICARLO - ARCHIVO (edit_firmante.php, add_firmante_cta.php)    
    public function idFirmante($id) {
        $sql = "SELECT id, dni, saf, cargo, domicilio, nombre FROM firm_datos WHERE id = '$id' OR dni = '$id'";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_array($res)) {
            $this->firmantes[] = $reg;
        }
        return $this->firmantes;
    }
    
    public function updateFirmante($id, $saf, $dni, $ape_nom, $domicilio, $cargo) {
        $sql = "UPDATE firm_datos SET saf = '$saf', dni = '$dni', nombre = '$ape_nom', domicilio = '$domicilio', cargo = '$cargo'
                WHERE id = '$id'";
        $res = mysql_query($sql, Conectar::con());
        echo "<script type='text/javascript'>
                alert ('Firmante Modificado Correctamente.');
                window.location = 'buscar_firmantes.php';
                </script>";
    }
    
}

?>
