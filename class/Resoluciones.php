<?php
require_once("class.php");
require_once("resize.php");

class Resoluciones {

	private $resolucion;

	public function __construct() {
		$this->resolucion = array();
	}

	public function listResoluciones($id){
		$sql = "SELECT * FROM resoluciones WHERE id_cuenta='$id'";
		$res = mysql_query($sql, Conectar::con());
		 while ($reg = mysql_fetch_assoc($res)) {
            $this->resolucion[] = $reg;
        }
        return $this->resolucion;
	}

    public function guardarResolucionNueva(){        
                $x = 1; 
                $tipo_archivo = $_FILES["foto".$x]["type"];
                $tamano_archivo = $_FILES["foto".$x]["size"];
                                
                $tamano_limite = 3072000;

                 $cant = $_POST["cant"]; 
                         
                 $cta = $_POST["id_cta"];
                 $id_cta = $_POST["id"];
                 $motivo = $_POST["motivo"];

                 $no_sub = 0; 
                 $sub = 0;   


                if ($tamano_limite < $tamano_archivo){
                    echo "<script type='text/javascript'>
                    alert ('La imagen no puede superar los 3Mb de tamaño.');
                    window.location = 'resoluciones.php?id=$id_cta';
                    </script>";
                }else{
                        if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")))) {
                            echo "<script type='text/javascript'>
                            alert ('La imagen solo puede ser de formato JPEG, JPG o PNG.');
                            window.location = 'resoluciones.php?id=$id_cta';
                            </script>";  
                        }else{

                                while($x <= $cant)
                                { 

                                    $aleatorio1 = date("d-m-y");
                                    $aleatorio2 = rand();
                                    
                                    $aleatorio = $aleatorio1.$aleatorio2; 
                                    
                                        if(is_uploaded_file($_FILES["foto".$x]['tmp_name'])){ 
                                            
                                                copy($_FILES["foto".$x]["tmp_name"],"resoluciones/".$_FILES["foto".$x]["name"]);
                                                $thumb=new thumbnail("resoluciones/".$_FILES["foto".$x]["name"]);    
                                                $thumb->size_width(600);//setea el ancho de la copia
                                                $thumb->size_height(500);//setea el alto de la copia
                                                $thumb->jpeg_quality(150);//setea la calidad jpg
                                                $nom=$aleatorio.".jpg";
                                                $thumb->save("resoluciones/$nom");    //guardarla en el servidor
                                                unlink("resoluciones/".$_FILES["foto".$x]["name"]);
                                                $sub++; 
                                            }
                                                else{
                                                    $no_sub++;
                                                }
                                
                                    $sql="INSERT INTO resoluciones(id, id_cuenta, cuenta, direccion, motivo) 
                                          VALUES (null,'$id_cta', '$cta', '$aleatorio', '$motivo')";
                                    $res=mysql_query($sql,Conectar::con());
                   
                                    echo "<script type='text/javascript'>
                                    alert ('Resolucion de Cuenta Almacenada Correctamente.');
                                    window.location = 'resoluciones.php?id=$id_cta';
                                    </script>";

                                    $x++;
                                }
                            }
                    }
        }

	public function guardarResolucionModificacion(){        
                $x = 1; 
                $tipo_archivo = $_FILES["foto".$x]["type"];
                $tamano_archivo = $_FILES["foto".$x]["size"];
                                
                $tamano_limite = 3072000;

                 $cant = $_POST["cant"]; 
                         
                 $cta = $_POST["nro_cta"];
                 $id_cta = $_POST["id"];

                 $no_sub = 0; 
                 $sub = 0;   
                
                if ($tamano_limite < $tamano_archivo){
                    echo "<script type='text/javascript'>
                    alert ('La imagen no puede superar los 3Mb de tamaño.');
                    window.location = 'modificar_cuenta.php?id=$id_cta';
                    </script>";
                }else{
                    if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")))) {
                        echo "<script type='text/javascript'>
                        alert ('La imagen solo puede ser de formato JPEG, JPG o PNG.');
                        window.location = 'modificar_cuenta.php?id=$id_cta';
                        </script>";  
                    }else{

                         while($x <= $cant)
                                { 
                                    $aleatorio1 = date("d-m-y");
                                    $aleatorio2 = rand();
                                    
                                    $aleatorio = $aleatorio1.$aleatorio2;   
                                    
                                    if(is_uploaded_file($_FILES["foto".$x]['tmp_name'])){ 
                                            
                                                copy($_FILES["foto".$x]["tmp_name"],"resoluciones/".$_FILES["foto".$x]["name"]);
                                                $thumb=new thumbnail("resoluciones/".$_FILES["foto".$x]["name"]);    
                                                $thumb->size_width(600);//setea el ancho de la copia
                                                $thumb->size_height(500);//setea el alto de la copia
                                                $thumb->jpeg_quality(150);//setea la calidad jpg
                                                $nom=$aleatorio.".jpg";
                                                $thumb->save("resoluciones/$nom");    //guardarla en el servidor
                                                unlink("resoluciones/".$_FILES["foto".$x]["name"]);
                                                $sub++; 
                                            }
                                                else{
                                                    $no_sub++;
                                                }
                                       
                                
                                    $sql="INSERT INTO resoluciones(id, id_cuenta, cuenta, direccion, motivo) 
                                          VALUES (null,'$id_cta','$cta','$aleatorio', 'MODIFICACION')";
                                    $res=mysql_query($sql,Conectar::con());
                   
                                    echo "<script type='text/javascript'>
                                    alert ('Resolucion de Cuenta Almacenada Correctamente.');
                                    window.location = 'edit_cuentas1.php?$id_cta';
                                    </script>";
                                    
                                    $x++;
                                 }
                     
                         }
                }
            }

    public function guardarResolucionBaja(){        
                $x = 1; 
                $tipo_archivo = $_FILES["foto".$x]["type"];
                $tamano_archivo = $_FILES["foto".$x]["size"];
                                
                $tamano_limite = 3072000;

                 $cant = $_POST["cant"]; 
                         
                 $cta = $_POST["nro_cta"];
                 $id_cta = $_POST["id"];

                 $no_sub = 0; 
                 $sub = 0;   
                
                if ($tamano_limite < $tamano_archivo){
                    echo "<script type='text/javascript'>
                    alert ('La imagen no puede superar los 3Mb de tamaño.');
                    window.location = 'baja_cuenta_definitiva.php?id=$id_cta';
                    </script>";
                }else{
                    if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")))) {
                        echo "<script type='text/javascript'>
                        alert ('La imagen solo puede ser de formato JPEG, JPG o PNG.');
                        window.location = 'baja_cuenta_definitiva.php?id=$id_cta';
                        </script>";  
                    }else{
                        while($x <= $cant)
                                { 
                                    $aleatorio1 = date("d-m-y");
                                    $aleatorio2 = rand();
                                    
                                    $aleatorio = $aleatorio1.$aleatorio2;   
                                    
                                    if(is_uploaded_file($_FILES["foto".$x]['tmp_name'])){ 
                                            
                                                copy($_FILES["foto".$x]["tmp_name"],"resoluciones/".$_FILES["foto".$x]["name"]);
                                                $thumb=new thumbnail("resoluciones/".$_FILES["foto".$x]["name"]);    
                                                $thumb->size_width(600);//setea el ancho de la copia
                                                $thumb->size_height(500);//setea el alto de la copia
                                                $thumb->jpeg_quality(150);//setea la calidad jpg
                                                $nom=$aleatorio.".jpg";
                                                $thumb->save("resoluciones/$nom");    //guardarla en el servidor
                                                unlink("resoluciones/".$_FILES["foto".$x]["name"]);
                                                $sub++; 
                                            }
                                                else{
                                                    $no_sub++;
                                                }
                                       
                                
                                            
                                    $sql="INSERT INTO resoluciones(id, id_cuenta, cuenta, direccion, motivo) 
                                          VALUES (null,'$id_cta','$cta','$aleatorio', 'BAJA')";
                                    $res=mysql_query($sql,Conectar::con());
                   
                                    echo "<script type='text/javascript'>
                                    alert ('Resolucion de Cuenta Almacenada Correctamente.');
                                    window.location = 'edit_cuentas.php';
                                    </script>";
                                    
                                $x++;
                                }
                     
                    }
                }
            }

    public function guardarResolucionFirmante($id_cta, $cta){        
                $x = 1; 
                $tipo_archivo = $_FILES["foto".$x]["type"];
                $tamano_archivo = $_FILES["foto".$x]["size"];
                                
                $tamano_limite = 3072000;

                 $cant = $_POST["cant"]; 

                 $no_sub = 0; 
                 $sub = 0;   
                
                if ($tamano_limite < $tamano_archivo){
                    echo "<script type='text/javascript'>
                    alert ('La imagen no puede superar los 3Mb de tamaño.');
                    window.location = 'modificar_cuenta.php?id=$id_cta';
                    </script>";
                }else{
                    if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")))) {
                        echo "<script type='text/javascript'>
                        alert ('La imagen solo puede ser de formato JPEG, JPG o PNG.');
                        window.location = 'modificar_cuenta.php?id=$id_cta';
                        </script>";  
                    }else{

                         while($x <= $cant)
                                { 
                                    $aleatorio1 = date("d-m-y");
                                    $aleatorio2 = rand();
                                    
                                    $aleatorio = $aleatorio1.$aleatorio2;   
                                    
                                    if(is_uploaded_file($_FILES["foto".$x]['tmp_name'])){ 
                                            
                                                copy($_FILES["foto".$x]["tmp_name"],"resoluciones/".$_FILES["foto".$x]["name"]);
                                                $thumb=new thumbnail("resoluciones/".$_FILES["foto".$x]["name"]);    
                                                $thumb->size_width(600);//setea el ancho de la copia
                                                $thumb->size_height(500);//setea el alto de la copia
                                                $thumb->jpeg_quality(150);//setea la calidad jpg
                                                $nom=$aleatorio.".jpg";
                                                $thumb->save("resoluciones/$nom");    //guardarla en el servidor
                                                unlink("resoluciones/".$_FILES["foto".$x]["name"]);
                                                $sub++; 
                                            }
                                                else{
                                                    $no_sub++;
                                                }
                                       
                                    $sql="INSERT INTO resoluciones(id, id_cuenta, cuenta, direccion, motivo) 
                                          VALUES (null,'$id_cta','$cta','$aleatorio', 'ASOCIAR FIRMANTE')";
                                    $res=mysql_query($sql,Conectar::con());
                   
                                    echo "<script type='text/javascript'>
                                    alert ('Resolucion de Cuenta Almacenada Correctamente.');
                                    window.location = 'modificar_firmante.php?id=$id_cta';
                                    </script>";

                                    $x++;
                                 }
                     
                    }
                }
            }

     public function eliminarResoluciones($id, $id_cta) {
        $sql = "DELETE FROM resoluciones WHERE id = '$id' AND id_cuenta = '$id_cta'";
        $res = mysql_query($sql, Conectar::con());


        echo "<script type='text/javascript'>
              alert ('Resolucion Eliminada Correctamente.');
              window.location = 'resoluciones.php?id=$id_cta';
              </script>";
    }


}

?>