 <?php
 if(isset($_GET['id'])){
    $level = 1;
    $id = $_GET['id'];
    update_level($bdd,$level,$id);

    header('location:Compte-de-'.$_GET['name-session']);
 }
?>