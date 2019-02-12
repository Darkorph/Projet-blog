<?php
// permet de supprimer un post de la bdd
    delete_solo_post($bdd);
    PostQuery::delete_solo_post($bdd);
    header('location: home');
?>