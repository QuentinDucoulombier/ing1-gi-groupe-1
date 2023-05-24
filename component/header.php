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
            <li>
                <div class="MonCompte">
                    <h3 id="buttonC2">Mon Compte</h3>
                    <ul id="MonCompteMenu" class="MonCompteMenu">
                    <?php if (isset($_SESSION['email'])) { ?>
                        <li class="buttonC"><a href="/?page=profil">Mon Profil </a></li>
                        <li class="buttonC"><a href="../action/logout.php">Déconnexion </a> </li>
                    <?php } else { ?>
                        <li class="buttonC" ><a href="/?page=connexion">Connexion</a></li>
                        <li class="buttonC" ><a href="/?page=inscription">S'inscrire</a></li>
                    <?php } ?>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</header>