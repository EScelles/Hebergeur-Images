<?php
//VERIFIER SI IMAGE BIEN RECU

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

	//VARIABLE
	$error = 1;

	//TAILLE
	if ($_FILES['image']['size'] <= 3000000) {

		//EXTENSION
		$informationsImage = pathinfo($_FILES['image']['name']);

		$extensionImage = $informationsImage['extension'];

		$extensionArray = array('jpg', 'png', 'jpeg', 'gif');

		if (in_array($extensionImage, $extensionArray)) {

			$address = 'uploads/' . time() . rand() . rand();
			move_uploaded_file($_FILES['image']['tmp_name'], $address);

			$error = 0;
		}
	}
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hébergeur d'Images</title>
</head>
<style type="text/css">
	html,
	body {
		margin: 0;
		font-family: georgia;
	}

	header {
		text-align: center;
		background: blue;
		color: white;
	}

	article {
		margin-top: 50px;
		background: #f7f7f7;
		padding: 10px;
	}

	button {
		margin-top: 10px;
	}

	h1 {
		margin-top: 0;
		text-align: center;
	}

	#presentation-picture {
		text-align: center;
	}

	#image {
		max-width: 400px;
	}

	.contener {
		width: 1000px;
		margin: auto;
		text-align: center;
	}
</style>

<body>
	<header>

		<!-- header -->
		<h2>PHOTOSHOOT</h2>
	</header>

	<div class="contener">
		<article>
			<h1>Hébergez une image</h1>

			<?php
			if (isset($error) && $error == 0) {

				echo'<div id="presentation-picture"><img src="' . $address . '" id="image" /><br />
						<input type="text" value="http://localhost/' . $address . '" />
					</div>';
			} 	else if (isset($error) && $error == 1) {

					echo 'Votre image ne peut pas être envoyé, veuillez vérifier son extension et sa taille (maximum 3mo).';
			}
			?>

			<form method="post" action="index.php" enctype="multipart/form-data">
				<p>
					<input type="file" required name="image" /><br />
					<div style="text-align: center;">
						<button type="submit">Héberger</button>
					</div>
				</p>
			</form>
		</article>
	</div>
</body>

</html>