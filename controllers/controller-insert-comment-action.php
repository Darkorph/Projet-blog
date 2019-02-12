<?php
if(isset($_POST['comment']) && isset($_SESSION['id']) && isset($_GET['post']) ) {
$comment = $_POST['comment'];
$id_author = $_SESSION['id'];
$id_post = $_GET['post'];

//permet d'inserer un commentaire dans la bdd
// insert_comment($bdd,$comment,(int)$id_author,(int)$id_post);
PostQuery::insert_comment($bdd,$comment,(int)$id_author,(int)$id_post);
//-----------------------------------------------------------------------

header('location: post-'.$_GET['post']);
}

?>