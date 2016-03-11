<?php
session_start();
$idusuario=$_SESSION['id_usu'];
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	if(isset($_GET["delete"]) && $_GET["delete"] == true)
	{
		$name = $_POST["filename"];
		if(file_exists('uploadsperfil/'.$name))
		{
			unlink('uploadsperfil/'.$name);
			$link = mysql_connect("localhost", "root", "");
			mysql_select_db("bdhaycasa", $link);
			mysql_query("DELETE FROM uploadsperfil WHERE name = '$name' and idusuario='$idusuario'", $link);
			mysql_close($link);
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
			$link = mysql_connect("localhost", "root", "");
			mysql_select_db("bdbalancedscore", $link);
			mysql_query("INSERT INTO uploadsperfil VALUES(null, '$file','$filetype','$filesize','$idusuario')", $link);
			mysql_close($link);
			//echo "<META http-equiv='refresh' content='0; url=intranet.php'>";
		}
	}
}