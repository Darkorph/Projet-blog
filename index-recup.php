<?php
session_start();
// CONNEXION A LA BASE DE DONNEE 
 require ('config/connexion.php');
 require ('model/functions.php');

//NOUVEL UTILISATEUR
if (isset($_GET['action'])&& $_GET['action'] == 'new-user') {
    /* CONTROLE DE L'AVATAR */
    
    $size_max = 1000000000000000000000000000000000000000;
    $extensions = array('jpg', 'jpeg', 'gif', 'png');
    $extension_upload = strtolower(  substr(  strrchr($_FILES['avatar']['name'], '.')  ,1)  );

    // echo count($extensions);

    //---------------------------------------------------------------------------------------------------------------------
    if ($_FILES['avatar']['error'] > 0) {
        $erreur = "Erreur lors du transfert";

    }
    else {
        
        if ($_FILES['avatar']['size'] > $size_max) {
            $erreur = "Le fichier est trop volumineux";
            echo $erreur;
            echo $_FILES['avatar']['error'];
        }
        else {        

            if (!in_array($extension_upload,$extensions) ) {
                echo "Extension incorrecte";
            }
            else {

                echo "Vous avez téléchargé le fichier " . $_FILES['avatar']['name'] . " de type" . $_FILES['avatar']['type'] . "et de taille" . $_FILES['avatar']['size'];

    //mkdir('fichier/', 0777, true);
                $nom = "img/{$_FILES['avatar']['name']}";

                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$nom);
                if ($resultat) {echo "Transfert réussi";}


            }
        }
    }
    
    /* FIN CONTROLE DE L'AVATAR */
    $level = 0;
    $avatar = "img/".$_FILES['avatar']['name'];
    $apropos = $_POST['apropos'];
   $username = $_POST['username']; 
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $counted = (int)count_user($bdd,$username)['count(*)'];


    ///// la fonction count_user() renvoie un tableau avec "count(*)" comme clé sous forme de STRING, $counted est la valeur entiere(int) de count(*)
    // var_dump($counted);

    if (isset($counted) && $counted == 0) {
        insert_author($bdd,$firstname,$lastname,$username,$email,$password,$level,$apropos,$avatar);
           header('location: home');
    } else {
        // print '<script>alert("cet username existe deja");</script>';
        header('location: Nouvel-utilisateur');
    }

}

// VERIFICATION POUR CONNEXION DE L'UTILISATEUR

else if (isset($_POST["username"]) && isset($_POST["password"])) 
{
    
    $user = search_user($bdd,$_POST["username"],$_POST["password"]);
    
    if ($user) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] =$user['username'];
        $_SESSION['level'] =$user['level'];
        $_SESSION['apropos'] =$user['apropos'];
        $_SESSION['avatar'] =$user['avatar'];
        $_SESSION['password'] =$user['password'];
    } else {
        print 
        '<script>
            alert ("Mot de passe ou Login incorrect");
        </script>';
    }
}

if (isset($_GET['stopsession']) && $_GET['stopsession'] == 'yes') {
    unset($_SESSION['id']);
    unset($_SESSION['firstname']);
    unset($_SESSION['lastname']);
    unset($_SESSION['email']);
    unset($_SESSION['username']);
    unset($_SESSION['level']);
    unset($_SESSION['apropos']);
    unset($_SESSION['avatar']);
    unset($_SESSION['password']);
    session_destroy();
} 



// INSERTION D'UN NOUVEL ARTICLE DANS LA BDD VIA L'ACTION 'insert'
if (isset($_GET['action'])&& $_GET['action'] == 'insert') {
    $size_max = 1000000000000000000000000000000000000000;
    $extensions = array('jpg', 'jpeg', 'gif', 'png');
    $extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );

    // echo count($extensions);

    //---------------------------------------------------------------------------------------------------------------------
    if ($_FILES['image']['error'] > 0) {
        $erreur = "Erreur lors du transfert";

    }
    else {
        
        if ($_FILES['image']['size'] > $size_max) {
            $erreur = "Le fichier est trop volumineux";
            echo $erreur;
            echo $_FILES['image']['error'];
        }
        else {        

            if (!in_array($extension_upload,$extensions) ) {
                echo "Extension incorrecte";
            }
            else {

                echo "Vous avez téléchargé le fichier " . $_FILES['image']['name'] . " de type" . $_FILES['image']['type'] . "et de taille" . $_FILES['image']['size'];

    //mkdir('fichier/', 0777, true);
                $nom = "img/{$_FILES['image']['name']}";

                $resultat = move_uploaded_file($_FILES['image']['tmp_name'],$nom);
                if ($resultat) {echo "Transfert réussi";}


            }
        }
    }
    //---------------------------------------------------------------------------------------------------------
    insert_solo_post($bdd,"img/".$_FILES['image']['name']);
    
    header('location: home');
    print 
    "<script>
       alert('Votre article a bien été ajouté');
    </script>";
}


// CHERCHE ET RECUPERE L'ARTICLE QU'ON VEUT MODIFIER VIA L'ACTION 'edit'
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    search_solo_posts($bdd);
    
}

// INSERT UN COMMENTAIRE DANS LA TABLE "comments" via l'action "insert_comment"
if (isset($_GET['action']) && $_GET['action'] == 'insert_comment') {
    $comment = $_POST['comment'];
    $id_author = $_SESSION['id'];
    $id_post = $_GET['post'];
    insert_comment($bdd,$comment,(int)$id_author,(int)$id_post);
    header('location: post-'.$_GET['post']);
    
}
if (isset($_GET['action'])&& $_GET['action'] == 'del_comment') {
    $id = $_GET['id'];
    delete_solo_comment($bdd, $id);
    header('location: post-'.$_GET['post']);
}

if (isset($_GET['action'])&& $_GET['action'] == 'update_user') {
    $size_max = 1000000000000000000000000000000000000000;
    $extensions = array('jpg', 'jpeg', 'gif', 'png');
    $extension_upload = strtolower(  substr(  strrchr($_FILES['avatar']['name'], '.')  ,1)  );

    // echo count($extensions);

    //---------------------------------------------------------------------------------------------------------------------
    if ($_FILES['avatar']['error'] > 0) {
        $erreur = "Erreur lors du transfert";

    }
    else {
        
        if ($_FILES['avatar']['size'] > $size_max) {
            $erreur = "Le fichier est trop volumineux";
            echo $erreur;
            echo $_FILES['avatar']['error'];
        }
        else {        

            if (!in_array($extension_upload,$extensions) ) {
                echo "Extension incorrecte";
            }
            else {

                echo "Vous avez téléchargé le fichier " . $_FILES['avatar']['name'] . " de type" . $_FILES['avatar']['type'] . "et de taille" . $_FILES['avatar']['size'];

    //mkdir('fichier/', 0777, true);
                $nom = "img/{$_FILES['avatar']['name']}";

                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$nom);
                if ($resultat) {echo "Transfert réussi";}


            }
        }
    }




/*---------UPDATE FILE----------------*/
        $avatar = "img/".$_FILES['avatar']['name'];
/*---------------------------------------- */
        $username = $_POST['pseudo'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $apropos = $_POST['about'];
        $id =  $_SESSION['id'];
        $counted = (int)count_user($bdd,$username)['count(*)'];

        /// Dans ce IF on verifie que le mdp de la session est identique au mdp entré dans le formulaire;
        //// si ils sont identique alors on n'encrypt pas le mdp entré dans le formulaire avant de l'envoyer pour eviter un double encryptage
        if(isset($_SESSION['password']) && $_SESSION['password'] == $_POST['password']) {
            $password = $_POST['password'];
            
        } else {
            // Sinon c'est que un nouveau mdp a été entré et donc il faut l'encrypter, on en profite au passage pour redonner la valeur du nouveau mdp a la valeur "Session" du mdp [que l'on ecrypte sinon le "if" ne sera jamais vrai] au cas ou il remodifie son mdp dans la meme session.
            $password = md5($_POST['password']);
            $_SESSION['password'] = md5($_POST['password']);
        }
        
        
    if (isset($counted) && $counted == 0 || $_SESSION['username']== $username) {

        update_user($bdd,$username,$firstname,$lastname,$email,$password,$apropos,$avatar,$id);
        
        var_dump($_SESSION['password']);

        
        
    } else {
        // header('location: index.php?page=gestion-compte');
        
        
    }
    
    
}

// MODIFICATION DE L'ARTICLE DANS LA BDD VIA L'ACTION 'update'
if (isset($_GET['action']) && $_GET['action'] == 'update') {
    $id = $_GET['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

/*----------UPDATE FILE----------------*/

$size_max = 1000000000000000000000000000000000000000;
    $extensions = array('jpg', 'jpeg', 'gif', 'png');
    $extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );

    // echo count($extensions);

    //---------------------------------------------------------------------------------------------------------------------
    if ($_FILES['image']['error'] > 0) {
        $erreur = "Erreur lors du transfert";

    }
    else {
        
        if ($_FILES['image']['size'] > $size_max) {
            $erreur = "Le fichier est trop volumineux";
            echo $erreur;
            echo $_FILES['image']['error'];
        }
        else {        

            if (!in_array($extension_upload,$extensions) ) {
                echo "Extension incorrecte";
            }
            else {

                echo "Vous avez téléchargé le fichier " . $_FILES['image']['name'] . " de type" . $_FILES['image']['type'] . "et de taille" . $_FILES['image']['size'];

    //mkdir('fichier/', 0777, true);
                $nom = "img/{$_FILES['image']['name']}";

                $resultat = move_uploaded_file($_FILES['image']['tmp_name'],$nom);
                if ($resultat) {echo "Transfert réussi";}


            }
        }
    }




/*---------UPDATE FILE----------------*/
$file = "img/".$_FILES['image']['name'];
$id_category = $_POST['categories_select'];
$id_author = $_POST['authors_select'];
    update_post($bdd,$title,$content,$id_category,$id_author,$file,$id);

    print 
    "<script>
       alert('Votre article a bien été modifié');
    </script>";
    header('location: home');
}

//SUPPRESSION DE L'ARTICLE SELECTIONNER VIA L'ACTION 'del'
if (isset($_GET['action'])&& $_GET['action'] == 'del') {
    delete_solo_post($bdd);
    header('location: home');
}

//AUGMENTER LE LEVEL D'UN NOUVEL UTILISATEUR

if (isset($_GET['action'])&& $_GET['action'] == 'add-level') {
    $level = 1;
    $id = $_GET['id'];
    update_level($bdd,$level,$id);

    header('location:Compte-de-'.$_GET['name-session']);

}

//SUPPRIMER UN UTILISATEUR
if (isset($_GET['action'])&& $_GET['action'] == 'supp-user') {
    $id=$_GET['id'];
    delete_user($bdd, $id);
    header('location:Compte-de-'.$_GET['name-session']);
}


    // ON VERIFIE SI LA PAGE N'EXISTE PAS, 
     if (!isset($_GET['page'])){
        require('controllers/controller-home-page.php');
       
    }
    

    // LA PAGE N'EXISTE PAS DONC ELLE PASSE DANS LE SWITCH
    else {
        switch ($_GET['page']) {
    
            case 'details':
               require('controllers/controller-details-page.php');
                break;
            case 'contact':
               require('controllers/controller-form-contact-page.php');
                break;
            case 'edit-new':
            require('controllers/controller-form-edit-new-post-page.php');
                break;
            case 'gestion-compte':
            require('controllers/controller-form-gestion-compte-page.php');
                break;
            case 'new-user':
            require('controllers/controller-form-new-user-page.php');
                break;
            case 'posts_author':
            require('controllers/controller-posts-author-page.php');
                break;
            case 'posts_category':
            require('controllers/controller-posts-category-page.php');
                break;

            default:
            require('controllers/controller-home-page.php');
                break;
        }
    }

    require ('inc/header.php');
   
    require ($content);
 
    require ('inc/footer.php');
?>