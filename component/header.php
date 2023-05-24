<header>
    <a class="logo" href="https://iapau.org/">
        <img src="http://iapau.org/wp-content/uploads/2021/05/iapau_round.png" alt="Association IA Pau" id="logo">
    </a>
	<div id="nav">
        <ul>
            <li>
                <a href="/?page=accueil">Accueil</a>
            </li>
            <li>
                <a href="/?page=contact">Contact</a>
            </li>
        <?php if (isset($_SESSION['email'])) { ?>
            <li><a href="/?page=profil">Mon Profil </a></li>
            <li><a href="../action/logout.php">Déconnexion </a> </li>
        <?php } else { ?>
            <li><a href="/?page=connexion">Connexion</a></li>
            <li><a href="/?page=inscription">S'inscrire</a></li>
        <?php } ?>            
        </ul>
    </div>
</header>