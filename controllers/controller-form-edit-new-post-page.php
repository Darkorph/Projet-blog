<?php            
                
                 $CURRENT_PAGE = 'Nouvel Article';
                 // $insert_post = insert_solo_post($bdd);
                 // On utilise cette fonction pour chercher tout les auteurs et les informations les concernant
                //  $all_authors = search_all_authors($bdd);
                 $all_authors = PostQuery::search_all_authors($bdd);

                //recupere pour afficher toute les catégories
                // $all_categories = search_all_categories($bdd);
                 $all_categories = PostQuery::search_all_categories($bdd);

                 if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                     // On RECUPERE UN SEUL POST POUR LE VOIR EN DETAIL
                    // $post_solo1 = search_solo_posts($bdd);
                     $post_solo1 = PostQuery::search_solo_posts($bdd); 
                 
                     $title = 'Modification de l\'article';
                 } else {$title = 'Nouvel Article';}
                 
                 $content = 'views/edit-new.php';
                

?>