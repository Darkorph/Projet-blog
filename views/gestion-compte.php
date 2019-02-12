<?php if(isset($_SESSION['id']))  { ?>
<main class="color1 main_edit my-1">
    <div class="container pt-5 ">
        <div class="row background_marron color2 py-1 mb-3">
            <div class="col-12 text-center">
                <h2>Mon compte</h2>
            </div>
        </div>
        <div class="row background_marron color2 py-1">


            <form class="p-5 col-12" enctype="multipart/form-data" method="post" action="index.php?page=home&action=update_user">
                <div class="row pb-5">
                    <div class="col-3">
                        <img src="https://via.placeholder.com/600" class="shadow-box" alt="" style="width: 100%;">
                        <button class="btn btn-info btn-block b-nonei b-radiusi shadow-box">Modifier Photo</button>
                    </div>
                    <div class="col-9">

                        <input type="text" name="pseudo" id="pseudo" class="form-control mb-4 b-nonei b-radiusi shadow-box" placeholder="Pseudo" value="<?php echo $solo_user['username'] ?>">

                        <input type="text" name="firstname" id="firstname" class="form-control mb-4 b-nonei b-radiusi shadow-box" placeholder="Firstname" value="<?php echo $solo_user['firstname'] ?>">
                        <input type="text" name="lastname" id="lastname" class="form-control mb-4 b-nonei b-radiusi shadow-box" placeholder="Lastname" value="<?php echo $solo_user['lastname'] ?>">

                        <input type="email" name="email" id="email" class="form-control mb-4 b-nonei b-radiusi shadow-box" placeholder="Email" value="<?php echo $solo_user['email'] ?>">
                        <input type="password" name="password" id="password" class="form-control mb-4 b-nonei b-radiusi shadow-box" placeholder="Mot de passe" value="<?php echo $solo_user['password']; ?>">

                    </div>
                </div>
                
        <!-- LISTE DES NOUVEAUX UTILISATEURS -->
        <?php if (isset($_SESSION['id']) && isset($_SESSION['level']) && $_SESSION['level'] >= 2) {
            echo'<h3>Il y a '.count($search_user_level0).' nouveaux utilisateurs</h3>
            <ul class="list-group">';
                              
       foreach ($search_user_level0 as $user){ 
           
  echo '<li class="list-group-item d-flex bg-color1i"><span class="w-50">'.$user["firstname"].'</span><a class="w-25" href="index.php?page=gestion-compte&id='.$user['id'].'&action=add-level&name-session='.$_SESSION['firstname'].'">Ajouter level</a><a class="w-25" href="index.php?page=gestion-compte&id='.$user['id'].'&action=supp-user&name-session='.$_SESSION['firstname'].'">Supprimer l\'utilisateur</a></li>';  
      }
echo '</ul>';
           
    }  ?>
    
    <!-- LISTE DES ANCIENS UTILISATEURS -->    
    <?php if (isset($_SESSION['id']) && isset($_SESSION['level']) && $_SESSION['level'] >= 2) {
            echo'<h3>Il y a '.count(search_all_user($bdd)).' anciens utilisateurs</h3>
            <ul class="list-group">';
                              
       foreach (search_all_user($bdd) as $user){ 
           
  echo '<li class="list-group-item d-flex bg-color1i"><span class="w-75">'.$user["firstname"].'</span><a class="w-25" href="index.php?page=gestion-compte&id='.$user['id'].'&action=supp-user&name-session='.$_SESSION['firstname'].'">Supprimer l\'utilisateur</a></li>';  
      }
echo '</ul>';
           
    }  ?>
    
                
                <div class="row">
                    <textarea rows="10" name="about" id="about" class="form-control mb-4 col-12 b-nonei b-radiusi shadow-box" placeholder="A propos de vous!"><?php  echo $solo_user['apropos']?></textarea>
                    <div class="my-4 col-3 offset-3">
                        <button class="btn btn-info btn-block b-nonei b-radiusi shadow-box" type="submit">Valider</button>
                    </div>
                    <div class="my-4 col-3">
                        <button class="btn btn-info btn-block b-nonei b-radiusi shadow-box" type="">Annuler</button>
                    </div>
                </div>
                <div class="custom-file">
            <input type="file" name="avatar" class="custom-file-input" id="fileInput" aria-describedby="fileInput">
            <label class="custom-file-label" for="fileInput">Monimage</label>
        </div>
                
            </form>
        </div>

    </div>



</main>
<?php } ?>