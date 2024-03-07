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
    /* Couleurs principales */

body {
 background-color: #000000;
   background-size: cover; /* Ensure the image covers the content area */
   background-clip: content-box;
   background-position: center 10px;
  
}

h1, h2 {
    color: whitesmoke;
    text-align: center;
    background-color: #3011BC;
}

ul li {
    color: white;
}

a {
    color: #000000;
}

a:hover {
    color: #ff0000;
}

/* Structure */

.liste-billets {
    margin: 0 auto;
    max-width: 960px;
    padding: 20px;
    text-align: center;
}

.billet {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
}

.actions {
    text-align: right;
}

.actions a {
    margin-right: 10px;
}

.readmore-btn {
  width: fit-contentd;
  height: 55px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  background-color:#3011BC;
  border: none;
  border-radius: 10px;
  padding: 0px 15px;
  gap: 0px;
  transition: all 0.4s;
}
.book-wrapper {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  position: relative;
  width: 45px;
  height: 100%;
}
.book-wrapper .book-page {
  width: 50%;
  height: auto;
  position: absolute;
}
.readmore-btn:hover .book-page {
  animation: paging 0.4s linear infinite;
  transform-origin: left;
}
.readmore-btn:hover {
  background-color: rgb(254, 122, 21);
}
@keyframes paging {
  0% {
    transform: rotateY(0deg) skewY(0deg);
  }
  50% {
    transform: rotateY(90deg) skewY(-20deg);
  }
  100% {
    transform: rotateY(180deg) skewY(0deg);
  }
}
.text {
  width: 105px;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 15px;
  color: rgb(255, 255, 255);
}

.fancy {
 background-color: transparent;
 border: 2px solid #000;
 border-radius: 0;
 box-sizing: border-box;
 color: #fff;
 cursor: pointer;
 display: inline-block;
 font-weight: 700;
 letter-spacing: 0.05em;
 margin: 0;
 outline: none;
 overflow: visible;
 padding: 1.25em 2em;
 position: relative;
 text-align: center;
 text-decoration: none;
 text-transform: none;
 transition: all 0.3s ease-in-out;
 user-select: none;
 font-size: 13px;
}

.fancy::before {
 content: " ";
 width: 1.5625rem;
 height: 2px;
 background: black;
 top: 50%;
 left: 1.5em;
 position: absolute;
 transform: translateY(-50%);
 transform-origin: center;
 
}

.fancy .text {
 font-size: 1.125em;
 line-height: 1.33333em;
 padding-left: 2em;
 display: block;
 text-align: left;
 transition: all 0.3s ease-in-out;
 text-transform: uppercase;
 text-decoration: none;
 color: white;
}

.fancy .top-key {
 height: 2px;
 width: 1.5625rem;
 top: -2px;
 left: 0.625rem;
 position: absolute;
 background: #e8e8e8;
 transition: width 0.5s ease-out, left 0.3s ease-out;
}

.fancy .bottom-key-1 {
 height: 2px;
 width: 1.5625rem;
 right: 1.875rem;
 bottom: -2px;
 position: absolute;
 background: #e8e8e8;
 transition: width 0.5s ease-out, right 0.3s ease-out;
}

.fancy .bottom-key-2 {
 height: 2px;
 width: 0.625rem;
 right: 0.625rem;
 bottom: -2px;
 position: absolute;
 background: #e8e8e8;
 transition: width 0.5s ease-out, right 0.3s ease-out;
}

.fancy:hover {
 color: white;
 background: rgb(254, 122, 21);
}

.fancy:hover::before {
 width: 0.9375rem;
 background: white;
}

.fancy:hover .text {
 color: white;
 padding-left: 1.5em;
}

.fancy:hover .top-key {
 left: -2px;
 width: 0px;
}

.fancy:hover .bottom-key-1,
 .fancy:hover .bottom-key-2 {
 right: 0;
 width: 0;
}
button {
 position: relative;
 border: none;
 background: transparent;
 padding: 0;
 cursor: pointer;
 outline-offset: 4px;
 transition: filter 250ms;
 user-select: none;
 touch-action: manipulation;
}

.shadow {
 position: absolute;
 top: 0;
 left: 0;
 width: 100%;
 height: 100%;
 border-radius: 12px;
 background: hsl(0deg 0% 0% / 0.25);
 will-change: transform;
 transform: translateY(2px);
 transition: transform
    600ms
    cubic-bezier(.3, .7, .4, 1);
}

.edge {
 position: absolute;
 top: 0;
 left: 0;
 width: 100%;
 height: 100%;
 border-radius: 12px;
 background: linear-gradient(
    to left,
    hsl(340deg 100% 16%) 0%,
    hsl(340deg 100% 32%) 8%,
    hsl(340deg 100% 32%) 92%,
    hsl(340deg 100% 16%) 100%
  );
}

.front {
 display: block;
 position: relative;
 padding: 12px 27px;
 border-radius: 12px;
 font-size: 1.1rem;
 color: white;
 background: hsl(345deg 100% 47%);
 transform: translateY(-4px);
}

button:hover {
 filter: brightness(110%);
}

button:hover .front {
  color: white;
 transform: translateY(-6px);
 transition: transform
    250ms
    cubic-bezier(.3, .7, .4, 1.5);
}

button:active .front {
 transform: translateY(-2px);
 transition: transform 34ms;
}

button:hover .shadow {
 transform: translateY(4px);
 transition: transform
    250ms
    cubic-bezier(.3, .7, .4, 1.5);
}

button:active .shadow {
 transform: translateY(1px);
 transition: transform 34ms;
}

button:focus:not(:focus-visible) {
 outline: none;
}

  </style>
</head>
<body>
    <header>
        <h1>Liste des billets</h1>
    </header>
    <main>
        <section class="liste-billets">
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <article class="billet">
                    <h2>Billet n°<?php echo $row["id"] ?></h2>
                    <ul>
                        <li>Date de réservation: <?php echo $row["date_reservation"] ?></li>
                        <li>Heure de réservation: <?php echo $row["heure_reservation"] ?></li>
                        <li>Prix: <?php echo $row["prix"] ?></li>
                        <li>Statut: <?php echo $row["statut"] ?></li>
                        <li>Date de départ: <?php echo $row["date_depart"] ?></li>
                        <li>Heure de départ: <?php echo $row["heure_depart"] ?></li>
                        <li>Ville de départ: <?php echo $row["ville_depart"] ?></li>
                        <li>Ville d'arrivée: <?php echo $row["ville_arrivee"] ?></li>
                        <li>Nom du client: <?php echo $row["nom"] . " " . $row["prenom"]; ?></li>
                        <li>Email du client: <?php echo $row["email"] ?></li>
                        <li>Téléphone du client: <?php echo $row["telephone"] ?></li>
                    </ul>
                    <div class="actions">
                    <button  class="readmore-btn">
                    <span class="book-wrapper">
                    <svg
                     xmlns="http://www.w3.org/2000/svg"
                    fill="rgb(86, 69, 117)"
                    viewBox="0 0 126 75"
                    class="book"
                    >
                    <rect
                    stroke-width="3"
        stroke="#fff"
        rx="7.5"
        height="70"
        width="121"
        y="2.5"
        x="2.5"
      ></rect>
      <line stroke-width="3" stroke="#fff" y2="75" x2="63.5" x1="63.5"></line>
      <path
        stroke-linecap="round"
        stroke-width="4"
        stroke="#fff"
        d="M25 20H50"
      ></path>
      <path
        stroke-linecap="round"
        stroke-width="4"
        stroke="#fff"
        d="M101 20H76"
      ></path>
      <path
        stroke-linecap="round"
        stroke-width="4"
        stroke="#fff"
        d="M16 30L50 30"
      ></path>
      <path
        stroke-linecap="round"
        stroke-width="4"
        stroke="#fff"
        d="M110 30L76 30"
      ></path>
    </svg>

    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 65 75"
      class="book-page"
    >
      <path
        stroke-linecap="round"
        stroke-width="4"
        stroke="#fff"
        d="M40 20H15"
      ></path>
      <path
        stroke-linecap="round"
        stroke-width="4"
        stroke="#fff"
        d="M49 30L15 30"
      ></path>
      <path
        stroke-width="3"
        stroke="#fff"
        d="M2.5 2.5H55C59.1421 2.5 62.5 5.85786 62.5 10V65C62.5 69.1421 59.1421 72.5 55 72.5H2.5V2.5Z"
      ></path>
    </svg>
  </span>
  <a href="details_reservation.php?id=<?php echo $row["id"];?>" class="text"> Voir details </a>
</button>

<a class="fancy" href="modifier_reservation.php?id=<?php echo $row["id"];?> ">
  <span class="top-key"></span>
  <span class="text">Modifer le billet</span>
  <span class="bottom-key-1"></span>
  <span class="bottom-key-2"></span>
</a>
<button>
  <span class="shadow"></span>
  <span class="edge"></span>
  <a href="annuler_reservation.php?id=<?php echo $row["id"];?>" class="front text">Annuler le billet</a>
</button>
                       
                    </div>
                </article>
            <?php
            }
            ?>
        </section>
    </main>
</body>
</html>
