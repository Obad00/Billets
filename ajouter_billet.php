<?php
// Database connection details
require_once "conn.php";

// Variables to store form data
$date_reservation = "date_reservation";  // Assign an empty string as a default value
$heure_reservation = "heure_reservation";
$prix = "prix";
$statut = "statut";
$nom = "nom";
$prenom = "prenom";
$email = "email";
$telephone = "telephone";

// Error messages (empty initially)
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Use the correct keys for form data
  $date_reservation = test_input($_POST["date_reservation"]);
  $heure_reservation = test_input($_POST["heure_reservation"]);
  $prix = test_input($_POST["prix"]);
  $statut = test_input($_POST["statut"]);
  $date_depart = test_input($_POST["date_depart"]);
  $heure_depart = test_input($_POST["heure_depart"]);
  $heure_arrivee = test_input($_POST["heure_arrivee"]);
  $ville_depart = test_input($_POST["ville_depart"]);
  $ville_arrivee = test_input($_POST["ville_arrivee"]);
  $nom = test_input($_POST["nom"]);
  $prenom = test_input($_POST["prenom"]);
  $email = test_input($_POST["email"]);
  $telephone = test_input($_POST["telephone"]);

  // Validate form data (expand on this for more comprehensive validation)
  if (empty($date_reservation)) {
    $errors[] = "Date de réservation requise";
  }
  if (empty($heure_reservation)) {
    $errors[] = "Heure de réservation requise";
  }
  // ... other validation checks

  if (empty($errors)) {
    // Insert ticket and client data into the database
    $sql_client = "INSERT INTO client (nom, prenom, email, telephone) VALUES (?, ?, ?, ?)";
    $stmt_client = $conn->prepare($sql_client);

    // Check if client data insertion was successful
    if ($stmt_client) {
      $stmt_client->bind_param("ssss", $nom, $prenom, $email, $telephone);
      $stmt_client->execute();
      $id_client = $stmt_client->insert_id; // Get the ID of the inserted client
      $stmt_client->close();

      // Insert ticket data
      $sql_billet = "INSERT INTO billet (date_reservation, heure_reservation, prix, statut, date_depart, heure_depart, heure_arrivee, ville_depart, ville_arrivee, id_client) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt_billet = $conn->prepare($sql_billet);

      // Check if ticket data insertion was successful
      if ($stmt_billet) {
        $stmt_billet->bind_param("sssssssssi", $date_reservation, $heure_reservation, $prix, $statut, $date_depart, $heure_depart, $heure_arrivee, $ville_depart,$ville_arrivee, $id_client);
        $stmt_billet->execute();
        $stmt_billet->close();
        header("Location: liste_reservation.php"); 
        exit();
      } else {
        $errors[] = "Erreur d'ajout du billet";
      }
    } else {
      $errors[] = "Erreur d'ajout du client";
    }
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réservation de billet</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
     background-image: url(img/14430-1552044335-shutterstock-515243494.jpg);
     background-size: cover; /* Ensure the image covers the content area */
     background-clip: content-box;
    }
    
    form {
      width: 500px;
      margin: 20px auto;
      padding: 20px;
      background-color: transparent;
      border: 1px solid #ddd;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 5px;
    }
    
    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: white;
    }
    
    label {
      display: block;
      margin-top: 20px;
      font-size: 14px;
    }
    
    input, select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-sizing: border-box;
    }
    
    button {
  font-family: inherit;
  font-size: 20px;
  background: #212121;
  color: white;
  fill: rgb(155, 153, 153);
  padding: 0.7em 1em;
  padding-left: 0.9em;
  display: flex;
  align-items: center;
  cursor: pointer;
  border: none;
  border-radius: 15px;
  font-weight: 1000;
}

button span {
  display: block;
  margin-left: 0.3em;
  transition: all 0.3s ease-in-out;
}

button svg {
  display: block;
  transform-origin: center center;
  transition: transform 0.3s ease-in-out;
}

button:hover {
  background: #000;
}

button:hover .svg-wrapper {
  transform: scale(1.25);
  transition: 0.5s linear;
}

button:hover svg {
  transform: translateX(1.2em) scale(1.1);
  fill: #fff;
}

button:hover span {
  opacity: 0;
  transition: 0.5s linear;
}

button:active {
  transform: scale(0.95);
}

  </style>
</head>
<body>
  <h1>Réserver un billet</h1>
  <form action="ajouter_billet.php" method="post">
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" required><br><br>

    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" id="prenom" required><br><br>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="telephone">Téléphone</label>
    <input type="tel" name="telephone" id="telephone" required><br><br>

    <label for="date_reservation">Date de réservation</label>
    <input type="date" name="date_reservation" id="date_reservation" required><br><br>

    <label for="heure_reservation">Heure de réservation</label>
    <input type="time" name="heure_reservation" id="heure_reservation" required><br><br>

    <label for="prix">Prix</label>
    <input type="number" name="prix" id="prix" required><br><br>

    <label for="statut">Statut</label>
    <select name="statut" id="statut" required>
      <option value="En attente">En attente</option>
      <option value="Confirmé">Confirmé</option>
      <option value="Annulé">Annulé</option>
    </select><br><br>

    <label for="date_depart">Date de départ</label>
    <input type="date" name="date_depart" id="date_depart" required><br><br>

    <label for="heure_depart">Heure de départ</label>
    <input type="time" name="heure_depart" id="heure_depart" required><br><br>

    <label for="heure_arrivee">Heure d'arrivée</label>
    <input type="time" name="heure_arrivee" id="heure_arrivee" required><br><br>

    <label for="ville_depart">Ville de départ:</label>
  <select id="ville_depart" name="ville_depart" required>
    <option value="">Sélectionner une ville</option>
    <option value="dakar">Dakar (Sénégal)</option>
    <option value="paris">Paris (France)</option>
    <option value="lyon">Lyon (France)</option>
    <option value="marseille">Marseille (France)</option>
    <option value="bordeaux">Bordeaux (France)</option>
    <option value="lille">Lille (France)</option>
    <option value="berlin">Berlin (Allemagne)</option>
    <option value="rome">Rome (Italie)</option>
    <option value="madrid">Madrid (Espagne)</option>
    <option value="londres">Londres (Royaume-Uni)</option>
    <option value="amsterdam">Amsterdam (Pays-Bas)</option>
  </select><br><br>

  <label for="ville_arrivee">Ville d'arrivée:</label>
  <select id="ville_arrivee" name="ville_arrivee" required>
    <option value="">Sélectionner une ville</option>
    <option value="berlin">Berlin (Allemagne)</option>
    <option value="rome">Rome (Italie)</option>
    <option value="madrid">Madrid (Espagne)</option>
    <option value="londres">Londres (Royaume-Uni)</option>
    <option value="amsterdam">Amsterdam (Pays-Bas)</option>
    <option value="dakar">Dakar (Sénégal)</option>
    <option value="paris">Paris (France)</option>
    <option value="lyon">Lyon (France)</option>
    <option value="marseille">Marseille (France)</option>
    <option value="bordeaux">Bordeaux (France)</option>
    <option value="lille">Lille (France)</option>
  </select><br><br>

  <button>
  <div class="svg-wrapper-1">
    <div class="svg-wrapper">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        width="30"
        height="30"
        class="icon"
      >
        <path
          d="M22,15.04C22,17.23 20.24,19 18.07,19H5.93C3.76,19 2,17.23 2,15.04C2,13.07 3.43,11.44 5.31,11.14C5.28,11 5.27,10.86 5.27,10.71C5.27,9.33 6.38,8.2 7.76,8.2C8.37,8.2 8.94,8.43 9.37,8.8C10.14,7.05 11.13,5.44 13.91,5.44C17.28,5.44 18.87,8.06 18.87,10.83C18.87,10.94 18.87,11.06 18.86,11.17C20.65,11.54 22,13.13 22,15.04Z">
        </path>
      </svg>
    </div>
  </div>
  <span>Réserver</span>
</button>

  </form>
</body>
</html>
