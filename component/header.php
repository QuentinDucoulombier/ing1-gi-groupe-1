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
                <a href="/?page=evenements">Evenements</a>
            </li>
            <li>
            
        <?php if (isset($_SESSION['email'])) { 
            $infos = getUser($_SESSION['email']);
            
            if ($infos[0]['type'] == "Etudiant") {
            ?>
            
            <li class="buttonC"><a href="/?page=profilEtudiant">Mon Profil </a></li>
            <?php
            } else if ($infos[0]['type'] == "Gestionnaire") {
            ?>
            <li class="buttonC"><a href="/?page=profilGestionnaire">Mon Profil </a></li>
            <?php
            } else if ($infos[0]['type'] == "Administrateur") {
            ?>
            <li class="buttonC"><a href="/?page=profilAdmin">Mon Profil </a></li>
            <?php } ?>
            <li class="buttonC"><a href="../action/logout.php">Déconnexion </a> </li>
        <?php } else { ?>
            <li class="buttonC" ><a href="/?page=connexion">Connexion</a></li>
            <li class="buttonC" ><a href="/?page=inscription">S'inscrire</a></li>
        <?php } ?>
                    
            </li>
        </ul>
    </div>
</header>