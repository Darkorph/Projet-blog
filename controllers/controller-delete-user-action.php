<?php
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    
    //DELETE USER PAR L'ADMIN
    // delete_user($bdd, $id);
    PostQuery::delete_user($bdd, $id);

    header('location:Compte-de-'.$_GET['name-session']);
}
?>