<?php
session_start();
// CONNEXION A LA BASE DE DONNEE 
 require ('config/connexion.php');
 require ('model/functions.php');
 require ('model/class_PostQuery.php');

   
 if (isset($_GET['action'])&& $_GET['action'] == 'new-user') {
    require('controllers/controller-insert-new-user-action.php');          

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
        if (isset($_GET['action'])){

            switch ($_GET['action']) {
        
                case 'insert':
                    require('controllers/controller-insert-post-action.php');
                    break;
                case 'edit':
                    require('controllers/controller-read-solo-post-action.php');
                    break;
                case 'insert_comment':
                    require('controllers/controller-insert-comment-action.php');
                    break;
                case 'del_comment':
                    require('controllers/controller-delete-comment-action.php');
                    break;
                case 'update_user':
                    require('controllers/controller-update-user-action.php');
                    break;
                case 'update':
                    require('controllers/controller-update-post-action.php');
                    break;
                case 'del':
                    require('controllers/controller-delete-post-action.php');
                    break;
                case 'add-level':
                    require('controllers/controller-update-level-new-user.php');
                    break;
                case 'supp-user':
                    require('controllers/controller-delete-user-action.php');
                    break;
                
                
                    
              
            }
        }
    }

   

   





    require ('inc/header.php');
   
    require ($content);
 
    require ('inc/footer.php');
?>