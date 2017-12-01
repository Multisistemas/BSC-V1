<?php
include_once(dirname(__FILE__).'/../../config.php');
//include('config.php');
global $CFG;
$idusuario=$_SESSION['id_usu'];
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
	if(isset($_GET["delete"]) && $_GET["delete"] == true)
	{
		$name = $_POST["filename"];
		if(file_exists('uploadsperfil/'.$name))
		{
			unlink('uploadsperfil/'.$name);
			$DB = mysqli_connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass);
			mysqli_select_db($DB, $CFG->dbpass);
			mysqli_query($DB, "DELETE FROM uploadsperfil WHERE name = '$name' and idusuario='$idusuario'");
			mysqli_close($DB);
			echo json_encode(array("res" => true));
		}
		else
		{
			echo json_encode(array("res" => false));
		}
	}
	else
	{
		$file = $_FILES["file"]["name"];
		$filetype = $_FILES["file"]["type"];
		$filesize = $_FILES["file"]["size"];

		if(!is_dir("uploadsperfil/"))
			mkdir("uploadsperfil/", 0777);

		if($file && move_uploaded_file($_FILES["file"]["tmp_name"], "uploadsperfil/".$file))
		{
			$DB = mysqli_connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass);
			mysqli_select_db($DB, $CFG->dbpass);
			mysqli_query($DB, "INSERT INTO uploadsperfil VALUES(null, '$file','$filetype','$filesize','$idusuario')");
			mysqli_close($DB);
			//echo "<META http-equiv='refresh' content='0; url=intranet.php'>";
		}
	}
}
