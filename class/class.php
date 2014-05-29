<?php
session_start();

class Conectar
	{
		//Método
		public static function con()
			{
				$conexion = mysql_connect("localhost","root","");
				mysql_query("SET NAMES 'utf8'");
				mysql_select_db("cuentas");
				return $conexion;
			}
		public function fecha ()  
			{  
    			$week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");  
    			$months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
   			 	$year_now = date ("Y");  
    			$month_now = date ("n");  
				$day_now = date ("j");  
				$week_day_now = date ("w");  
				$date = $week_days[$week_day_now] . ", " . $day_now . " de " . $months[$month_now] . " de " . $year_now . ".";   
				return $date;    
			}
                        
	}

?>
