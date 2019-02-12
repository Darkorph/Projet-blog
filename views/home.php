<main class="color1 my-1 py-5 ">
    <!-- Section: Blog v.2 -->
    <!-- Section: Blog v.2 -->

    <section class=" mx-5 text-center color2 py-3 px-5 ">

        <!-- Section heading -->
        <div  class="shadow-box px-4 mb-5 py-2">
        <h2 class="h1-responsive font-weight-bold">Mes articles</h2>
        <!-- Section description -->
        
            <p class="dark-grey-text w-responsive mx-auto mb-5">Le marché du jeu vidéo s’est beaucoup développé depuis
            l’arrivée de l’ancêtre Pong ou du célèbre Tetris. On joue aujourd’hui à des jeux de plus en plus beaux,
            demandant de plus en plus de ressources à nos machines. Mais on voit aussi d’autres utilisations du jeu
            vidéo arriver : le Serious Gaming, par exemple, est une branche en pleine expansion en ce moment. Le Social
            Gaming également, représenté activement par les nombreux jeux basés sur Facebook et ses possibilités en
            terme de diffusion.

            Si on s’essayait à une catégorisation rapide des jeux vidéo, voici ce qui pourrait ressortir : les jeux
            consoles, les jeux PC “classiques”, les jeux en ligne (MMO en tous genres compris). Dans cette dernière
            catégorie, on trouve beaucoup de types de jeux différents : les MMO dans le genre de World of Warcraft, les
            jeux multijoueur comme Counter Strike ou Team Fortress, les modes multi des jeux principalement solo, et
            les jeux par navigateur.</p>
        </div>
        

        <!-- Grid row -->
        <div class="row">
            <?php
                // AFFICHAGE AVEC RECUPERATION DANS LE FICHIER JSON
                    // foreach ($json_posts as $value) {

                    //     echo '<div class="col-lg-4 col-md-12 mb-5">

                    //     <!-- Featured image -->
                    //     <div class="view overlay rounded z-depth-2 mb-4">
                    //         <a href="index.php?page=home&action=del" class=""><i class="fas fa-trash-alt text-danger ml-2 h4" style="float:right;"></i></a>
                    //         <a href="index.php?page=edit-new" class=""><i class="far fa-edit color3 h4" style="float:right;"></i></a>
                    //         <img class="img-fluid" src="img/Master-Chief-Halo.jpg" alt="Sample image">
                    //         <a>
                    //             <div class="mask rgba-white-slight"></div>
                    //         </a>
                    //     </div>
    
                    //     <!-- Category -->
                    //     <a href="#!" class="pink-text">
                    //         <h6 class="font-weight-bold mb-3"><i class="fas fa-map pr-2"></i>'.$value->category.'</h6>
                    //     </a>
                    //     <!-- Post title -->
                    //     <h4 class="font-weight-bold mb-3"><strong>'.substr($value->title,0,20).'...</strong></h4>
                    //     <!-- Post data -->
                    //     <p>by <a class="font-weight-bold">'.$value->userId.'</a>, 15/07/2018</p>
                    //     <!-- Excerpt -->
                    //     <p class="dark-grey-text">'.substr($value->body,0,50).'...</p>
                    //     <!-- Read more button -->
                    //     <a href="index.php?page=details&amp='.$value->id.'" class="">Read more</a>
    
                    // </div>';
                    
                    
                    // }
                    foreach ($all_posts as $value) {
                            // AFFICHAGE AVEC RECUPERATION DANS LA BASE DE DONNEE SQL
                        echo '<div class="col-lg-4 col-md-12 mb-5 px-5 py-2 shadow-box" >

                        <!-- Featured image -->
                        <div class="view overlay rounded z-depth-2 mb-4">';

                            // ON AFFICHE LES BOUTONS POUR LES UTILISATEURS CONNECTES DE NIVEAU 2 OU PLUS
                        if (isset($_SESSION['id']) && isset($_SESSION['level']) && $_SESSION['level'] >= 2) {
                            
                             echo '<a href="index.php?page=home&action=del&id='.$value['id'].'" class=""  >
                             <i class="fas fa-trash-alt text-danger ml-2 h4" style="float:right;"></i></a>

                            
                            <a href="edit-post-'.$value['id'].'" class="">
                            <i class="far fa-edit color3 h4" style="float:right;"></i></a>';
                        }

                            // ON AFFICHE LES BOUTONS POUR LES ARTICLES LIEE A L'AUTEUR ET SI IL EST CONNECTE PEU IMPORTE SON NIVEAU (en comparant l'"id" de l'utilisateur avec son "id d'auteur")
                        if (isset($_SESSION['id']) && $_SESSION['id'] == $value['id_aut'] && isset($_SESSION['level']) && $_SESSION['level'] < 2 ) {
                            
                            echo '<a href="index.php?page=home&action=del&id='.$value['id'].'" class=""  >
                            <i class="fas fa-trash-alt text-danger ml-2 h4" style="float:right;"></i></a>

                           
                           <a href="edit-post-'.$value['id'].'" class="">
                           <i class="far fa-edit color3 h4" style="float:right;"></i></a>';
                       } else {
                           echo '<a href="" class="" style="visibility:hidden;" >
                           <i class="far fa-edit color3 h4" style="float:right;"></i></a>';
                       }
                           echo' <img class="img-fluid" src="';if ($value['file'] == 'img/' && empty($_POST['image'])) {echo "img/Master-Chief-Halo.jpg";} else {echo $value['file'];}

                        //    echo $_POST['image'];
                           
                           echo'" alt="Sample image" style="width:100%; height:200px;">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
    
                        <!-- Category -->
                        <a href="Articles-de-la-categorie-'.$value['id_cat'].'" class="pink-text">
                            <h6 class="font-weight-bold mb-3"><i class="fas fa-map pr-2"></i>'.$value['name'].'</h6>
                        </a>
                        <!-- Post title -->
                        <h4 class="font-weight-bold mb-3"><strong>'.mb_substr($value['title'],0,20).'...</strong></h4>
                        <!-- Post data -->
                        <p>by <a href="Articles-de-l-auteur-'.$value['id_aut'].'" class="font-weight-bold">'.$value['username'].'</a>, '.$value['created_date'].'</p>
                        <!-- Excerpt -->
                        <p class="dark-grey-text">'.mb_substr($value['content'],0,50).'...</p>
                        <!-- Read more button -->
                        <!-- <a href="index.php?page=details&id='.$value['id'].'" class="">Lire plus</a> -->
                        <a href="post-'.$value['id'].'" class="">Lire plus</a>
    
                    </div>
                    '
                    ;
                    
                    
                    }

                    
                
                ?>



            <!-- POPUP MODAL POUR VALIDER LA SUPPRESSION D'UN POST -->




            <!-- Grid column -->
            <!-- <div class="col-lg-4 col-md-12 mb-lg-0 mb-4"> -->

            <!-- Featured image -->
            <!-- <div class="view overlay rounded z-depth-2 mb-4">
                        <img class="img-fluid" src="img/Master-Chief-Halo.jpg" alt="Sample image">
                        <a>
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div> -->

            <!-- Category -->
            <!-- <a href="#!" class="pink-text">
                        <h6 class="font-weight-bold mb-3"><i class="fas fa-map pr-2"></i>Adventure</h6>
                    </a> -->
            <!-- Post title -->
            <!-- <h4 class="font-weight-bold mb-3"><strong>Title of the news</strong></h4> -->
            <!-- Post data -->
            <!-- <p>by <a class="font-weight-bold">Billy Forester</a>, 15/07/2018</p> -->
            <!-- Excerpt -->
            <!-- <p class="dark-grey-text">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil
                        impedit
                        quo minus id quod maxime placeat facere possimus voluptas.</p> -->
            <!-- Read more button -->
            <!-- <a href="index.php?page=details" class="">Read more</a>

                </div> -->
            <!-- Grid column -->



        </div>
        <!-- Grid row -->

    </section>

    <!-- Section: Blog v.2 -->
    <!-- Section: Blog v.2 -->
</main>