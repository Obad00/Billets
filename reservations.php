<?php
require_once "conn.php";

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// SQL query pour récupérer tous les billets avec les détails du client
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
ORDER BY billet.id ASC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de réservation</title>
    <style>
    body {
      font-family: 'Roboto', sans-serif;
      font-size: 16px;
      line-height: 1.5;
      color: #333;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }

    h1, h2, h3, h4, h5, h6 {
      font-weight: normal;
      margin-bottom: 1rem;
    }

    a {
      color: #007bff;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 0.5rem;
      text-align: left;
    }

    th {
      background-color: #003087;
      color: #fff;
      font-weight: bold;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #ddd;
    }

    .actions {
      text-align: center;
    }

    .actions a {
      margin-right: 0.5rem;
    }

    @media screen and (max-width: 768px) {
      table {
        display: block;
        overflow-x: auto;
      }

      th, td {
        white-space: nowrap;
      }
    }
  </style>
</head>
<body>
    <h1>Liste des billets</h1>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date de réservation</th>
                <th>Heure de réservation</th>
                <th>Prix</th>
                <th>Statut</th>
                <th>Date de départ</th>
                <th>Heure de départ</th>
                <th>Ville de départ</th>
                <th>Ville d'arrivée</th>
                <th>Nom du client</th>
                <th>Email du client</th>
                <th>Téléphone du client</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["date_reservation"] ?></td>
                    <td><?php echo $row["heure_reservation"] ?></td>
                    <td><?php echo $row["prix"] ?></td>
                    <td><?php echo $row["statut"] ?></td>
                    <td><?php echo $row["date_depart"] ?></td>
                    <td><?php echo $row["heure_depart"] ?></td>
                    <td><?php echo $row["ville_depart"] ?></td>
                    <td><?php echo $row["ville_arrivee"] ?></td>
                    <td><?php echo $row["nom"] . " " . $row["prenom"]; ?></td>
                    <td><?php echo $row["email"] ?></td>
                    <td><?php echo $row["telephone"] ?></td>
                    <td><a href='details_reservation.php?id=<?php echo $row["id"];?>'>Voir détails</a>
                    <a href='modifier_reservation.php?id=<?php echo $row["id"];?> '>Modifier</a>
                    <a href='annuler_reservation.php?id=<?php echo $row["id"];?>  '>Supprimer</a></td>
                    </tr>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </body>
</html>

