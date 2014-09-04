<?php

require_once("class.php");

class Administradores {

    //Atributos
    private $admin;

    public function __construct() {
        $this->admin = array();
    }

    /*     * ********Start Paginación Administradores********* */

    public function Lista_Usuarios() {
        $sql = "SELECT usuarios.id idu, user, ape_nom, perfil FROM usuarios, permisos WHERE permisos.id = usuarios.id_perfil";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->admin[] = $reg;
        }
        return $this->admin;
    }

    /*     * ********End Paginación Administradores********* */
    /*     * ********Start Add Administradores********* */

    public function Alta_Usuario($ape_nom, $user, $per, $pass1) {

        $sql = "SELECT user FROM usuarios WHERE user = '$user'";
        $query = mysql_query($sql, Conectar::con());
         if ($reg = mysql_fetch_assoc($query)) 
            {
                $this->admin[] = $reg;
                header("Location: alta_usuarios.php?error=$user");
                exit;

            }else{

                 $sql_u = "INSERT INTO usuarios(id, id_perfil, ape_nom, user, pass) VALUES(null, '$per', '$ape_nom', '$user', md5('$pass1'))";
                 $res_u = mysql_query($sql_u, Conectar::con());

                echo "<script type='text/javascript'>
                        alert ('Usuario Registrado Correctamente.');
                        window.location = 'alta_usuarios.php';
                        </script>";

            }

           
    }

    /*     * ********End Add Administradores********* */

    /*     * ********Start Eliminar Administrador********* */

    public function Eliminar_Usuario($id) {


        $sql = "DELETE FROM usuarios WHERE id_usu = $id";
        $res = mysql_query($sql, Conectar::con());


        echo "<script type='text/javascript'>
              alert ('Usuario Eliminado Correctamente.');
              window.location = 'a_usuarios.php';
              </script>";
    }

    /*     * ********End Eliminar Administrador********* */

    /*     * ********Start Administrador Id********* */

    public function Id_Usuario($id) {
        $sql = "SELECT * FROM usuarios WHERE usuarios.id_usu = '$id'";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->admin[] = $reg;
        }
        return $this->admin;
    }

    /*     * ********End Administrador Id********* */

    /*     * ********Start Editar Administrador********* */

    public function Editar_Usuario($id, $ape_nom, $correo, $tel, $user, $pass) {
        $sql = "UPDATE usuarios SET ape_nom = '$ape_nom', correo = '$correo', telefono = '$tel', user = '$user', pass = '$pass' WHERE id_usu = '$id'";
        $res = mysql_query($sql, Conectar::con());

        echo "<script type='text/javascript'>
            alert ('Usuario Editado Correctamente.');
            window.location = 'a_usuarios.php';
            </script>";
    }

    /*     * ********End Editar Administrador********* */
}

/* * ****************End Administrador**************** */
?>
