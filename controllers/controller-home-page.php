<?php              
                 $title = 'Accueil'; // MA METHODE
                 $CURRENT_PAGE = 'Index';
                //  $all_posts = search_all_posts($bdd);   // RECUPERATION DES DONNEE DE LA BASE DANS UNE VARIABLE '$all_posts'
                
                // $postQuery = new PostQuery();
                // $all_posts = $postQuery->search_all_posts($bdd);

                $all_posts = PostQuery::search_all_posts($bdd);
                
                 
                 $content =  'views/home.php'; // MA VUE

?>