<!DOCTYPE html>
<html>
<head>
  <title>Détails de la réservation</title>
  <style>
    /* Couleurs principales */

    body {
    margin: 0;
    padding: 0;
    background-color: #3011BC ;
    
}

.container {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}


h1, h2 {
    color: white;
    text-align: center;
    background-color: #FE7A15 ;
    width: 1000px;
    height: 90px;
    font-size: 60px;
    margin-left: 120px;
}

table {
    border-color: #ddd;
}

th {
    background-color: #e6e6e6;
    color: black;
}
@media screen and (min-width: 600px) { 
.h1, h2{ width: 1000px; height: 90px; font-size: 60px; margin-left: 120px; } }



  </style>
</head>
<body>
    <h1>Détails de la réservation</h1>
<div class="container">
<?php
require_once "conn.php";

// Récupérer l'ID de la réservation
$id = $_GET["id"];

// Requête SQL pour récupérer les détails de la réservation
$sql = "SELECT
    billet.id,
    date_reservation,
    heure_reservation,
    prix,
    statut,
    billet.date_depart,
    billet.heure_depart,
    billet.ville_depart,
    billet.ville_arrivee,
    client.nom,
    client.prenom,
    client.email,
    client.telephone
FROM billet
INNER JOIN client ON billet.id_client = client.id
WHERE billet.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    // Afficher les détails de la réservation dans un tableau
    echo "<table border='1' cellpadding='5'>" .
         "<tr><th>ID</th><td>" . $row["id"] . "</td></tr>" .
         "<tr><th>Date de réservation</th><td>" . $row["date_reservation"] . "</td></tr>" .
         "<tr><th>Heure de réservation</th><td>" . $row["heure_reservation"] . "</td></tr>" .
         "<tr><th>Prix</th><td>" . $row["prix"] . "</td></tr>" .
         "<tr><th>Statut</th><td>" . $row["statut"] . "</td></tr>" .
         "<tr><th>Date de départ</th><td>" . $row["date_depart"] . "</td></tr>" .
         "<tr><th>Heure de départ</th><td>" . $row["heure_depart"] . "</td></tr>" .
         "<tr><th>Ville de départ</th><td>" . $row["ville_depart"] . "</td></tr>" .
         "<tr><th>Ville d'arrivée</th><td>" . $row["ville_arrivee"] . "</td></tr>" .
         "<tr><th>Nom du client</th><td>" . implode(" ", array($row["nom"], $row["prenom"])) . "</td></tr>" .
         "<tr><th>Email</th><td>" . $row["email"] . "</td></tr>" .
         "<tr><th>Téléphone</th><td>" . $row["telephone"] . "</td></tr>" .
         "</table>";
} else {
    
    echo "<p>Aucune réservation trouvée avec l'ID " . $id . "</p>";
}

$conn->close();
?>
</div>
</body>
</html>
