<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=projet-blog', 'root', '');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

$title = $_POST["title"];
$content = $_POST["content"];
$upload = $_FILES["image1"];
$reponse = $bdd->prepare('insert into posts 
        (`title`, `content`, `id_cat`, `id_aut`,`file`) 
        values ("'.$title.'", "'.$content.'", 4, 1, "'.$upload['name'].'") ');
        $reponse->execute();
        var_dump($reponse);


?>