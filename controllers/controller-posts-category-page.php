<?php              
                 $title = 'Liste des articles de la catégorie';
                 $CURRENT_PAGE = 'Liste des articles de la catégorie';
                 $content = 'views/posts_category.php';
                 $id_category = $_GET['id'];
                 $posts_category = posts_category($bdd,$id_category);

?>