<?php              
                 $title = 'Gerer mon compte';
                 $CURRENT_PAGE = 'Gerer mon compte';

                 // On utilise cette fonction pour chercher tout les auteurs et les informations les concernant
                //  $all_authors = search_all_authors($bdd);
                $all_authors = PostQuery::search_all_authors($bdd);


                //RECHERCHE DES NOUVEAUX INSCRITS
                //  $search_user_level0 = search_user_level0($bdd);
                 $search_user_level0 = PostQuery::search_user_level0($bdd);
 
                 $id = $_SESSION['id'];

                 /// Permet de cibler un seul auteur (pour pouvoir recuperer ces infos)
                //  $solo_user = search_solo_user($bdd,$id);
                 $solo_user = PostQuery::search_solo_user($bdd,$id);
 
                 $content = 'views/gestion-compte.php';

?>