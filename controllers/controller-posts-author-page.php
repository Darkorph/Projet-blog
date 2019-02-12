<?php              
                 $title = 'Liste des articles';
                 $CURRENT_PAGE = 'Liste des articles';
                 $content = 'views/posts_author.php';
                 $id_author = $_GET['id'];
                 $posts_author = posts_author($bdd,$id_author);

?>