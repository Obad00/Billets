<!DOCTYPE html>
<html>
<head>
	<title>Supprimer une réservation</title>
	<style>
		.message {
			background-color: #f2f2f2;
			padding: 20px;
			border: 1px solid #ccc;
			margin-bottom: 20px;
		}
		.confirmation-link {
			color: #f00;
			text-decoration: none;
		}
		.success-message {
			background-color: #dff0d8;
			padding: 20px;
			border: 1px solid #c3e6cb;
		}
	</style>
</head>
<body>
	<div class="message">
		<?php
		require_once "conn.php";

		if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
			$id = $_GET["id"];

			// Afficher un message de confirmation avec un lien pour confirmer la suppression
			echo "Voulez-vous vraiment supprimer cette réservation ? <a href='confirmer_suppression.php?id=$id' class='confirmation-link'> Oui</a> | <a href='index.php'>Non</a>";
		} else {
			echo "ID de réservation non spécifié";
		}
		?>
	</div>

	<?php
	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
		$id = $_GET["id"];

		// Supprimer la réservation de la base de données
		$sql = "DELETE FROM billet WHERE id = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$stmt->close();

		echo "<div class='success-message'>La réservation a été annulée avec succès</div>";
	} else {
		echo "<div class='message'>ID de réservation non spécifié</div>";
	}
	?>
</body>
</html>