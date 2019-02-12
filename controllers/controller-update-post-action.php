<?php  
$id = $_GET['id'];
$title = $_POST['title'];
$content = $_POST['content'];
    control_file();

    


/*---------UPDATE FILE----------------*/
$file = "img/".$_FILES['avatar']['name'];
$id_category = $_POST['categories_select'];
$id_author = $_SESSION['id'];
    update_post($bdd,$title,$content,$id_category,$id_author,$file,$id);

    print 
    "<script>
       alert('Votre article a bien été modifié');
    </script>";
    header('location: home');
?>