<?php
require_once "conn.php";
// Fetch existing reservation data
$id = $_GET["id"]; // Assuming the reservation ID is passed in the URL
$sql = "SELECT * FROM billet WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST["id"];
    $date_reservation = $_POST["date_reservation"];
    $heure_reservation = $_POST["heure_reservation"];
    $prix = $_POST["prix"];
    $statut = $_POST["statut"];
    $date_depart = $_POST["date_depart"];
    $heure_depart = $_POST["heure_depart"];
    $ville_depart = $_POST["ville_depart"];
    $ville_arrivee = $_POST["ville_arrivee"];

    // SQL query to update the reservation
    $sql = "UPDATE billet SET date_reservation=?, heure_reservation=?, prix=?, statut=?, date_depart=?, heure_depart=?, ville_depart=?, ville_arrivee=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsssssi", $date_reservation, $heure_reservation, $prix, $statut, $date_depart, $heure_depart, $ville_depart, $ville_arrivee, $id);

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: liste_reservation.php');
        echo "Réservation mise à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de la réservation: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modification d'une réservation</title>
  <style>
  body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url(img/mj-jo-gqbQyHEEJww-unsplash.jpg);
      background-size: cover; /* Ensure the image covers the content area */
      background-clip: content-box;
    }
    
    h1 {
      background-color: #3011BC;
      color: white;
      padding: 10px 20px;
      margin: 0;
      text-align: center;
    }
    
    form {
      width: 500px;
      margin: 20px auto;
      padding: 20px;
      background-color: transparent;
      border: 1px solid #ddd;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    
    label {
      display: block;
      margin-top: 20px;
      font-size: 14px;
      color: aliceblue;
    }
    
    input, select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ddd;
    }
    
    input[type="submit"] {
      background-color: #3011BC;
      color: white;
      cursor: pointer;
    }
    
    input[type="submit"]:hover {
      background-color: #FE7A15;
    }
  </style>
</head>
<body>
 
<h1>Modifier une réservation</h1>
<form method="post" action="modifier_reservation.php">
    <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
    
    <label for="date_reservation">Date de réservation</label>
    <input type="date" name="date_reservation" value="<?php echo $row["date_reservation"] ?>"><br>
    
    <label for="heure_reservation">Heure de réservation</label>
    <input type="time" name="heure_reservation" value="<?php echo $row["heure_reservation"] ?>"><br>
    
    <label for="prix">Prix:</label>
    <input type="number" name="prix" value="<?php echo $row["prix"] ?>"><br>
    
    <label for="statut">Statut</label>
    <select name="statut" id="statut" required>
      <option value="En attente">En attente</option>
      <option value="Confirmé">Confirmé</option>
      <option value="Annulé">Annulé</option>
    </select><br><br>
    
    <label for="date_depart">Date de départ</label>
    <input type="date" name="date_depart" value="<?php echo $row["date_depart"] ?>"><br>
    
    <label for="heure_depart">Heure de départ</label>
    <input type="time" name="heure_depart" value="<?php echo $row["heure_depart"] ?>"><br>
    
    <label for="ville_depart">Ville de départ</label>
  <select id="ville_depart" name="ville_depart" required>
    <option value="">Sélectionner une ville</option>
    <option value="dakar">Dakar (Sénégal)</option>
    <option value="paris">Paris (France)</option>
    <option value="lyon">Lyon (France)</option>
    <option value="marseille">Marseille (France)</option>
    <option value="bordeaux">Bordeaux (France)</option>
    <option value="lille">Lille (France)</option>
  </select><br><br>
    
  <label for="ville_arrivee">Ville d'arrivée</label>
  <select id="ville_arrivee" name="ville_arrivee" required>
    <option value="">Sélectionner une ville</option>
    <option value="berlin">Berlin (Allemagne)</option>
    <option value="rome">Rome (Italie)</option>
    <option value="madrid">Madrid (Espagne)</option>
    <option value="londres">Londres (Royaume-Uni)</option>
    <option value="amsterdam">Amsterdam (Pays-Bas)</option>
  </select><br><br>

    <input type="submit" value="Modifier la réservation">
</form>

</body>
</html>
