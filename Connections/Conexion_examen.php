<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Conexion_examen = "localhost";
$database_Conexion_examen = "examen_2";
$username_Conexion_examen = "root";
$password_Conexion_examen = "";
$Conexion_examen = mysql_pconnect($hostname_Conexion_examen, $username_Conexion_examen, $password_Conexion_examen) or trigger_error(mysql_error(),E_USER_ERROR);

if(ISSET($_POST["submit"])){
			echo "</br> Se presionó un boton en un formulario POST </br>";
			
			$archivoOrigen = $_FILES["fileToUpload"]["tmp_name"];
			$archivoDestino = "fotos/".$_FILES["fileToUpload"]["name"];
			echo "El archivo transferido es: ".$archivoDestino;
			echo "</br>";
			
		}
		
		//PARTE 2.

		//Variable que extraiga la extencion del archivo

		$gifFileType = pathinfo($archivoDestino, PATHINFO_EXTENSION) ;

		//Variable que valida que el archivo es tipo imagen
		//$check = getimagesize($archivoOrigen);
		
		ECHO "Extencion del archivo: ".$gifFileType."</BR>";
		
		
		if($gifFileType=="gif"){
		//si encontroalgo, un archivo de tipo imagen
			echo "El archivo es un archivo git </BR>";
			//Transfiriendo el archivo
			move_uploaded_file($archivoOrigen,$archivoDestino);

			//TRANSFIRIENDO LA URL A LA BD

			ECHO "Query a ejecutar ".$insertSQL."</BR>";

			//EJECUTANDO QUERY DE INSERCIC/DN

			if($query_a_ejecutar = mysql_query($insertSQL, $Conexion_examen)){
				ECHO "Query ejecutando correctamente</br>";
				HEADER("Refresh:5; url=insertar.php");
			} else {
				ECHO "Query no ejecutando</br>";
			}
		}else{
			echo "El archivo NO es un archivo gif </BR>";
		}

?>