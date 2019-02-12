<?php
if(isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])){
control_file();

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


if (isset($counted) && $counted == 0) {
    //INSERER UN AUTEUR
    // insert_author($bdd,$firstname,$lastname,$username,$email,$password,$level,$apropos,$avatar);
    PostQuery::insert_author($bdd,$firstname,$lastname,$username,$email,$password,$level,$apropos,$avatar);

    //-----------------------------------------------------------------------
       header('location: home');
} else {
    
    header('location: Nouvel-utilisateur');
}
}
else if (isset($_POST["username"]) && isset($_POST["password"])) 
{
    // recherche les information sur l'utilisateur pour comparer les information saisie pour valider la connexion
    // $user = search_user($bdd,$_POST["username"],$_POST["password"]);
    $user = PostQuery::search_user($bdd,$_POST["username"],$_POST["password"]);
    //-----------------------------------------------------------------------
    
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




?>