<?php
    if($_POST["nbrMembre"] >= 8){
        echo '<p style="color: red;">Vous ne pouvez pas rajouter de nouveaux membre (limite: 8)</p>';
    }
    else {
        echo '
        <div id="searchMember">
            <input type="text" id="memberSearchInput" onkeyup="suggestMembers()" placeholder="Rechercher un membre">
            <div id="memberSuggestions"></div>
        </div>';
    }
    
?>
