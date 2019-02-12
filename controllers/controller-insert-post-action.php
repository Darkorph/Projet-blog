<?php
if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_SESSION['id']) && isset($_POST['categories_select'])) {

        control_file();
        $title = $_POST["title"];
        $content = $_POST["content"];
        $id_author = $_SESSION['id'];
        $id_category = $_POST['categories_select'];
        $nom = "img/".$_FILES['avatar']['name'];
    //---------------------------------------------------------------------------------------------------------
    insert_solo_post($bdd,$title,$content,$id_category,$id_author,$nom);
    
    header('location: home');
}
    ?>