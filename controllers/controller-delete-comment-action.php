<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //Permet de supprimer un commentaire dans la bdd
    // delete_solo_comment($bdd, $id);
    PostQuery::delete_solo_comment($bdd, $id);

    header('location: post-'.$_GET['post']);
}
    
?>