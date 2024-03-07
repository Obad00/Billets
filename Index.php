<?php
//Connexion à la base de données
require_once"conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<title>Ma page d'accueil</title>
  <style>
 body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f2f2f2;
}

.navbar {
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 30px;
    position: relative;
  }

  .navbar-brand {
    font-size: 2rem;
    font-weight: bold;
    color: #003087;
    text-decoration: none;
  }

  .navbar-nav {
    display: flex;
    align-items: center;
    list-style: none;
    margin-right: 200px;
  }

  .nav-link {
    color: #333;
    padding: 0 1rem;
    font-size: 10px;
    text-transform: uppercase;
    border-bottom: 2px solid transparent;
    transition: border-bottom 0.3s ease;
    
  }

  .nav-link:hover {
    border-bottom-color: #003087;
  }

.container {
  margin: 2rem auto;
  padding: 2rem;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  text-align: center;
}

h1 {
  color: #3011BC;
  margin-bottom: 2rem;
  text-align: center;
}

p {
  color: #607080;
  text-align: center;
}

.row {
  display: flex;
  flex-wrap: wrap;
  margin: 2rem 0;
}

.col-md-4 {
  flex: 1 0 33.33333%;
  margin-bottom: 2rem;
}

.col-md-4:hover {
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

.img-fluid {
  width: 100%;
  height: auto;
  border-radius: 5px;
}

footer {
  background-color: #3011BC;
  
  padding: 2rem;
  margin-top: 2rem;
}


footer ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

footer li {
  margin-bottom: 0.5rem;
}



footer form {
  margin-top: 2rem;
}

.input-group {
  margin-bottom: 1rem;
}

.form-control {
  border-radius: 5px 0 0 5px;
}

.btn {
  border-radius: 0 5px 5px 0;
}

.fo {
  display: flex;
  gap: 100px;
}
button{
  color: white;
  background-color: #FE7A15;
  border: #FE7A15;
}
</style>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">OBAD FLIGHT</a>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item ">
					<a class="nav-link" href="index.php">Accueil </a>
				</li>
				<li class="nav-item ">
					<a class="nav-link" href="userinfo.php">Informations personnels</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="liste_reservation.php">Mes réservations</a>
				</li>
        <li class="nav-item">
         <a class="nav-link" href="ajouter_billet.php">Faire une réservation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sign in</a>
        </li>
			</ul>
		</div>
	</nav>
  <body>
  <div class="container">
    <h1>Bienvenue sur notre site web de réservation de vols !</h1>
    <p>Veuillez sélectionner une option dans la barre de navigation pour commencer.</p>
    <p> Ou vous pouvez appuyer sur l'une des images de ville pour entammer un voyage innoubliable.</p>
    <div class="row">
      <div class="col-md-4">
        <a href="ajouter_billet.php"><img src="img/EZ7lbGcWoAITQPM.jpg_large.jpg" alt="" class="img-fluid"></a>
        <p>Dakar</p>
      </div>
      <div class="col-md-4">
        <a href="ajouter_billet.php"><img src="img/calitore-D-EzZ1zSolM-unsplash.jpg" alt="" class="img-fluid"></a>
        <p>Paris</p>
      </div>
      <div class="col-md-4">
        <a href="ajouter_billet.php"><img src="img/charles-postiaux-Q6UehpkBSnQ-unsplash.jpg" alt="" class="img-fluid"></a>
        <p>Londre</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <a href="ajouter_billet.php"><img src="img/florian-wehde-WBGjg0DsO_g-unsplash.jpg" alt="Faire une réservation" class="img-fluid"></a>
        <p>Madrid</p>
      </div>
      <div class="col-md-4">
        <a href="ajouter_billet"><img src="img/florian-wehde-FbVA6hdYgr8-unsplash.jpg" alt="Sign in" class="img-fluid"></a>
        <p>Berlin</p>
      </div>
      <div class="col-md-4">
        <a href="ajouter_billet"><img src="img/nastya-dulhiier-3Ze88tZX-p0-unsplash.jpg" alt="Sign in" class="img-fluid"></a>
        <p>Amsterdam</p>
      </div>
    </div>
  </div>
</body>
<footer style="background-image: url(img/footer-bg.jpg);">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h2>Newsletter</h2>
        <p>Abonnez-vous pour recevoir nos dernières offres et actualités.</p>
        <form action="#">
          <input type="email" placeholder="Votre adresse e-mail">
          <button type="submit">Envoyer</button>
        </form>
      </div>
      <div class="col-md-4">
        <h2>Contact</h2>
        <p>Téléphone: +0021 77 123 45 67</p>
        <p>Email: contact@monentreprise.com</p>
      </div>
      <div class="col-md-4">
         <h2>Suivez-nous sur les réseaux sociaux</h2>
      <div class="social-icons">
         <a href="https://www.facebook.com/monentreprise" target="_blank"><i class="fab fa-facebook-f"></i></a>
         <a href="https://www.twitter.com/monentreprise" target="_blank"><i class="fab fa-twitter"></i></a>
         <a href="https://www.instagram.com/monentreprise" target="_blank"><i class="fab fa-instagram"></i></a>
         </div>
      </div>
    </div>
<div class="fo">
<div class=col-md-4>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.93509603392!2d-17.480243526024726!3d14.716261474236745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xec173298a5209b1%3A0xb55d772a577eb89c!2sOuakam%20cit%C3%A9%20Batrain!5e0!3m2!1sfr!2ssn!4v1709814514593!5m2!1sfr!2ssn" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="col-md-4">
        <h2>Liens utiles</h2>
        <ul>
          <li><a href="#">Conditions générales</a></li>
          <li><a href="#">Politique de confidentialité</a></li>
          <li><a href="#">Mentions légales</a></li>
        </ul>
      </div>
</div>
  </div>
</footer>



</html>