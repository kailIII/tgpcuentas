<?php
require_once("class.php");
class Usuarios 
{
	private $perfil=array();
	
	public function loguin()
	{
                $contrasena = md5($_POST['contrasena']);
		
		if (empty($_POST["usuario"]) or empty($contrasena))
		{
			header("Location: index.php?error=1");
		}else
		{
	
			$sql="SELECT id, ape_nom, user, pass FROM usuarios WHERE user ='".$_POST["usuario"]."' AND pass='".$contrasena."'";
			$res=mysql_query($sql,Conectar::con());	
			if (mysql_num_rows($res)==0)
			{
				header("Location: index.php?error=2");
			}else
			{
				if ($reg=mysql_fetch_array($res))
				{
					$_SESSION["session_user"]=$reg["ape_nom"];
					$_SESSION["session_perfil"]=$reg["id"];
					header("Location: home.php");
				}
			}
		}
		
	} 
	

	public function get_permisos_por_id()
	{
		$sql="SELECT id FROM permisos WHERE id='".$_SESSION["session_perfil"]."'";
		$res=mysql_query($sql,Conectar::con());
		if ($reg = mysql_fetch_assoc($res))
			{
				$this->perfil[]=$reg;
			}
				return $this->perfil;
                                
	}
}


