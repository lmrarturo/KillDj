<!DOCTYPE html>
<?php
	include("config.php");
?>
<html lang="en">
<head>	

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>KillDJ - Music for Real People</title>
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/styles.css">
	<script type="text/javascript" src="js/archivo.js"></script>

</head>
<body>
	<header class="header relative border-bottom">
		<a href="" class="button-menu icon-menu"></a>
		<nav class="menu">
			<ul class="list">
				<li class="item">
					<a href="#">New</a>
				</li>
				<li class="item">
					<a href="#">Change</a>
				</li>
				<li class="item">
					<a href="#">Delete</a>
				</li>
			</ul>
		</nav>
		<div class="title">
			<span>
				New
			</span>
		</div>
	</header>
<form action="alta.php?type=alta" method="post" enctype="multipart/form-data" name="formulario" onsubmit="return validaFormulario()">
	<div class="tabla">
		  <label>ID</label>
			<input name="id" type="text" id="id" size="25" maxlength="10"  title="Remember the ID's standard: 4 Characters, 6 Numbers"/>
	      <label>Band/Artist</label>
			<input name="band" type="text" id="band" size="25" maxlength="100" required>
			<br>
	       <label>Album</label>
			<input name="album" type="text" id="album" size="25" maxlength="100" required>
	      	<label>Year of Release</label>
	      	<br>
			<select name="year" id="year">
				<?php 


					for($i=2014;$i>=1930;$i--){
				?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php } ?>
			</select>
				<p><label>Género(s)</label></p>
				<br>
				<br>
				<p><label>País</label></p>

				<select name="pais" id="pais">
					<?php 
						$sql = mysql_query("SELECT * FROM paises");
						while($row = mysql_fetch_object($sql)){
					?>
					<option value="<?php echo $row->pais; ?>"><?php echo utf8_encode($row->pais); ?></option>
					<?php } ?>
				</select>
				<p><label>Precio</label></p>
				<input type="text" name="precio"/>
				<br>
	      		<label>Album Artwork</label>
	      		<input type="file" name="artwork" id="artwork" /><!-- Change type for "file" -->
	      		<!-- <input type="submit" name ="enviar" id="enviar" value="Enviar" class="boton"/> -->
	      		<br>
	      		<button id = "boton" name="enviar">New</button>
	</div>
</form>
<?php
if (isset($_POST['enviar'])){
	$id = $_POST['id'];
	$band = $_POST['band'];
	$album = $_POST['album'];
	$year = $_POST['year'];
	$genero ='rock';
	$pais = $_POST['pais'];
	$precio = $_POST['precio'];

	$archivo = $_FILES['artwork']['name']; //Nombre del archivo
	$temporal = $_FILES['artwork']['tmp_name']; //Archivo

	move_uploaded_file($temporal,"images/".$archivo);

	mysql_query("INSERT INTO discos
				VALUES ('$id','$band','$album','$archivo','$year','$genero','$pais','$precio')");	

?>
<p>
	Datos insertados
</p>
<?php }	?>
</body>
</html>