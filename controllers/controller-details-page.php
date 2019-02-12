<?php              
                 $title = 'Détails';
                 $CURRENT_PAGE = 'Détails';

                 // On RECUPERE UN SEUL POST POUR LE VOIR EN DETAIL
                //  $post_solo1 = search_solo_posts($bdd);
                 $post_solo1 = PostQuery::search_solo_posts($bdd);
                 //-----------------------------------------------------------------------

                 // on recupere les commentaires pour les afficher sous le post "en détail"
                //  $list_comment1 = search_comments($bdd);
                 $list_comment1 = PostQuery::search_comments($bdd);
                 //-----------------------------------------------------------------------

                 $content = 'views/details.php';

?>