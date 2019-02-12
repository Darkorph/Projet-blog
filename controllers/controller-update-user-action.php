<?php
if(isset($_SESSION['id'])) {
    control_file();




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
        header('location: index.php?page=gestion-compte');
        
        
    }
}
?>