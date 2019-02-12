<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
    crossorigin="anonymous">
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector: 'textarea' });</script>
  <title>
    <?php echo $title; ?>
  </title>
</head>

<body class="">
  <header>
    <nav class="navbar w-100 navbar-expand-md navbar-light bg-color1">
      <a class="navbar-brand" href="home">
        <div><img src="img/logo2.png" alt=""></div>
      </a>
      <a class="navbar-brand" href="home">
        <div><img src="img/home3.png" alt=""></div>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end " id="navbarSupportedContent">
        <?php 
    if (isset($_SESSION['id'])) {
      echo '<div id="" class="row w-70">
                <div class="col-lg-11 bg-color1 b-none shadow-box">
                    <div class="row pl-2">Bonjour '.$_SESSION['username'].'
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="mt-3 col-4">
                                <div class="row"><a class="px-2  bg-color3 b-none shadow-box" style="color:white!important;" href="logout">Déconnexion</a></div>
                        </div>
                        <div class="mt-3 col-7 offset-1">
                            <div class="row">
                                <a class="px-2 bg-color3 b-none shadow-box ml-5" style="color:white!important;" href="Compte-de-'.$_SESSION['username'].'">Mon compte
                                ';
            if ($_SESSION['level']>=2 && count(search_user_level0($bdd))>0){
                    echo  '<span class="badge badge-danger b-nonei">'.count(search_user_level0($bdd)).'</span>';
                        }              
                               
                  
                           
            echo        '</a></div>
                        </div>   
        
                    </div>
                </div>';
        if (isset($_SESSION['level']) && $_SESSION['level'] > 0) {
                
    echo    '<div class="mt-3 col-5">

                    <div class="row">
                        <div class=""><a class="p-2 bg-color3 b-none shadow-box" style="color:white!important;" href="new-post">Nouvel article</a></div>
                    </div>     
                </div>
                
                

      
            </div>';}
        
    } else {
      echo '<form class="row" action="index.php" method="post">
      <div class="color2 col-lg-8 offset-lg-3 py-1">
          <input class="col-lg-5 mb-1 bg-color2 b-none " name="username" placeholder="Pseudo" type="text">
          <input class="col-lg-5 offset-lg-1 mb-1 bg-color2 b-none" name="password" placeholder="Mot de passe" type="password">
    
          <button class="col-lg-5 h4 bg-color3i b-none" type="submit">Se connecter</button>
          <a href="Nouvel-utilisateur" class="col-lg-5 offset-lg-1 h4 bg-color3i b-none" style="color:white!important;">Nouveau compte</a>
          

      </div>
        
    </form>';
    }

    
    ?>



      </div>
    </nav>
  </header>
