<?php virtual('/examen2/Connections/Conexion_examen.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO viajeros (id_viajero, nombre_viajero, fecha_viaje, url_boleto_avion) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_viajero'], "int"),
                       GetSQLValueString($_POST['nombre_viajero'], "text"),
                       GetSQLValueString($_POST['fecha_viaje'], "date"),
                       GetSQLValueString($_POST['url_boleto_avion'], "text"));

  mysql_select_db($database_Conexion_examen, $Conexion_examen);
  $Result1 = mysql_query($insertSQL, $Conexion_examen) or die(mysql_error());

  $insertGoTo = "/examen2/formulario_examen.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $insertGoTo));
	echo "<script language=javaScript> window.location='/examen2/formulario_examen.php' </script>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="dropzone.js"></script>
<title>Untitled Document</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" enctype = 'multipart/form-data'>>
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nombre_viajero:</td>
      <td><input type="text" name="nombre_viajero" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fecha_viaje:</td>
      <td><input type="text" name="fecha_viaje" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Url_boleto_avion:</td>
      <td><input type="text" name="url_boleto_avion" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="id_viajero" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
  <input type ="file" name ="fileToUpload" id = "fileToUpload" />
  <input type ="submit" value = "Enviar git" name = "submit" />
</form>
<p>&nbsp;</p>

</body>
</html>