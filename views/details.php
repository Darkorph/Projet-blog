<?php
    // header("Content-Type: text/html; charset=utf-8");

?>

<main class="color1 my-1">
    <div class="container py-5">
        <div class="row background_marron  color2 py-1">
            <div class="col-10 ">
               <div class="h4">
                
                    <?php echo $post_solo1['title']; ?> 
                       </div>
                       <div>
                       Publié par : <a class="text-white font-italic h3" href="Articles-de-l-auteur-<?php echo $post_solo1['id_aut'] ?>">
                        <?php echo $post_solo1['username']; ?></a>
                        </div>
            </div>
            <div class="col-2 justify-content-start">
                <?php
                        if (isset($_SESSION['id']) && isset($_SESSION['level']) && $_SESSION['level'] >= 2) {
                            echo '<a href="" class="" data-toggle="modal" data-target="#basicExampleModal"><i class="fas fa-trash-alt text-danger ml-2 h2" style="float:right;"></i></a>
                            
                            <a href="edit-post-'.$post_solo1['id'].'" class=""><i class="far fa-edit color3 h2" style="float:right;"></i></a>';
                         }
                         if (isset($_SESSION['id']) && $_SESSION['id'] == $post_solo1['id_aut'] && isset($_SESSION['level']) && $_SESSION['level'] < 2) {
                            echo '<a href="" class="" data-toggle="modal" data-target="#basicExampleModal"><i class="fas fa-trash-alt text-danger ml-2 h2" style="float:right;"></i></a>
                            
                            <a href="edit-post-'.$post_solo1['id'].'" class=""><i class="far fa-edit color3 h2" style="float:right;"></i></a>';
                         }
                    ?>

            </div>
            <div class="col-12"><img class="img-fluid" src="<?php  if ($post_solo1['file'] == 'img/' && empty($_POST['image'])) {echo "
                    img/Master-Chief-Halo.jpg";} else {echo $post_solo1['file'];}?>">
                <div class="col-12">

                    <p class="text-justify">
                        <?php
                        
                        //RECUPERATION EN PASSANT PAR UN TABLEAU DE TABLEAU PHP
                        // $json_posts_details = json_decode($posts, true);
                        //     echo $json_posts_details[$id_post -1]['body'];

                        // RECUPERATION EN PASSANT PAR UN TABLEAU D'OBJET

                        echo $post_solo1['content'];
                        
                        ?>
                    </p>
                </div>
            </div>
            <div class="row">


            </div>
        </div>
        <div class="row background_marron  color2 py-1">
            <form method="POST" action="index.php?page=home&action=insert_comment&post=<?php echo $post_solo1['id'] ?>"" class="col-12 py-1">
                <h2>Laissez votre commentaire !</h2>
                <textarea name="comment" id="comment" cols="30" rows="10" class="w-75 bg-color2 b-none"></textarea>
                <button type="submit" class="bg-color3 submit-edit">Valider</button>
            </form>

        </div>
        <div class="row background_marron  color2 py-1">
            <div class="col-12 py-1 ">
                <h2 class="">Lisez les commentaires des autres auteurs !</h2>
            
                <?php
               
                    foreach ($list_comment1 as $comment1) {
                        if ($comment1['id_post'] == $post_solo1['id']) {
                        echo '<div class=" row px-3 py-4 border-top border-white">
                                    <h3 class="col-10 px-0">'.$comment1['username'].'</h3>
                                    
                              ';
                              if (isset($_SESSION['id']) && isset($_SESSION['level']) && $_SESSION['level'] >= 2) {
                                echo '<a href="index.php?page=details&post='.$comment1['id_post'].'&id='.$comment1['id'].'&action=del_comment" class="col-2"><i class="fas fa-trash-alt text-danger ml-2 h3" style="float:right;"></i></a>';
                                
                                
                             }
                             if (isset($_SESSION['id']) && $_SESSION['id'] == $comment1['id_aut'] && isset($_SESSION['level']) && $_SESSION['level'] < 2) {
                                echo '<a href="index.php?page=details&post='.$comment1['id_post'].'&id='.$comment1['id'].'&action=del_comment" class="col-2"><i class="fas fa-trash-alt text-danger ml-2 h3" style="float:right;"></i></a>';
                                
                                
                             }; 
                             
        
                        echo '<p class="col-12 ">'.$comment1['comment'].'</p>';
                        echo '</div>';
                        
                        
                            
                              
                    }
                }
                        // var_dump($list_comment1[0]['id']);
                        
                        
                    
                ?>
                
                  
            </div>

        </div>
    </div>
    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color:#5D4037!important;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Suppression ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Etes-vous sur de vouloir supprimer cet article ?
                </div>
                <div class="modal-footer">
                    <a type="button" href="" class="btn btn-success" data-dismiss="modal" style="color:white!important">Annuler</a>
                    <a type="button" href="index.php?page=home&action=del&id=<?php echo $post_solo1['id']; ?>" class="btn btn-success"
                        style="color:white!important">Valider</a>
                </div>
            </div>
        </div>
    </div>
</main>