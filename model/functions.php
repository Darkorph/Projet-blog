<?php 

function control_file()
{
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
}

// ON RECUPERE TOUT LES POSTS
    function search_all_posts($bdd)
    {
        $reponse = $bdd->prepare('select p.title, p.content, p.id, p.id_aut, p.id_cat, a.firstname,  a.username, c.name, p.created_date, p.file
         from posts as p 
         inner join authors as a on p.id_aut = a.id 
         inner join categories as c on p.id_cat =c.id');
        $reponse->execute();
        $list_post = array();
        while ($post = $reponse->fetch()) {
         
            $list_post[] = $post;
        }
        $reponse->closeCursor();
        return $list_post;
    
    }
    
    // On utilise cette fonction pour chercher tout les auteurs et les informations les concernant
    function search_all_authors($bdd)
    {
        $reponse = $bdd->prepare('select a.firstname, a.username, a.id, a.email, a.apropos, a.avatar
         from authors as a ');
        $reponse->execute();
        $list_authors = array();
        while ($author = $reponse->fetch()) {
         
            $list_authors[] = $author;
        }
        $reponse->closeCursor();
        return $list_authors;
    
    }
    //recupere pour afficher toute les catégories
    function search_all_categories($bdd)
    {
        $reponse = $bdd->prepare('select c.name, c.id
         from categories as c ');
        $reponse->execute();
        $list_categories = array();
        while ($category = $reponse->fetch()) {
         
            $list_categories[] = $category;
        }
        $reponse->closeCursor();
        return $list_categories;
    
    }

    // On RECUPERE UN SEUL POST POUR LE VOIR EN DETAIL
    function search_solo_posts($bdd)
    {
        
        $id = $_GET['id'];
        $reponse = $bdd->prepare('select p.title, p.content, p.id, p.id_aut, p.id_cat, a.firstname, a.username, c.name, p.file
         from posts as p 
         inner join authors as a on p.id_aut = a.id 
         inner join categories as c on p.id_cat =c.id
         where p.id=?');
         
        $reponse->execute(array($id));
        
        
       $post_solo = $reponse->fetch();
       
       $reponse->closeCursor();
       
        return $post_solo;
        
    
    }

    function insert_solo_post($bdd,$title,$content,$id_category,$id_author,$nom)
    {
        
        // $nom = "localhost/projet_blog/upload/{$_FILES['image']['name']}";
                
        $reponse = $bdd->prepare('insert into posts 
        (`title`, `content`, `id_cat`, `id_aut`, `file`) 
        values (?, ?, ?, ?, ?)');
        $reponse->execute(array($title, $content, $id_category, $id_author, $nom));
    }

//INSERER UN AUTEUR

function insert_author($bdd,$firstname,$lastname,$username,$email,$password,$level,$apropos,$avatar)
    {      
        $reponse = $bdd->prepare('insert into authors 
        (firstname, lastname, username, email, password, level, apropos, avatar) 
        values (?, ?, ?, ?, ?, ?, ?, ?)');
        $reponse->execute(array($firstname, $lastname, $username,$email, $password,$level,$apropos,$avatar));
    }

    function count_user($bdd,$username)
    {
        $reponse = $bdd->prepare('select count(*) 
         from authors
         where username = ?');
         
        $reponse->execute(array($username));
        
        $counted = $reponse->fetch();
       
        return $counted;
        
    }
   

    // permet de supprimer un post de la bdd
    function delete_solo_post($bdd)
    {
        $id = $_GET['id'];
        
        $reponse = $bdd->prepare('delete from posts
        where id=?');
        $reponse->execute(array($id));
    }
    // recherche les information sur l'utilisateur pour comparer les information saisie pour valider la connexion
    function search_user($bdd,$username,$password)
    {
        $reponse = $bdd->prepare('select  a.firstname, a.lastname, a.id, a.username, a.email, a.level, a.avatar, a.apropos, a.password
         from authors as a
         where a.username=? and a.password=?');
         
        $reponse->execute(array($username, MD5($password)));
        
       $user = $reponse->fetch();
       
        return $user;
        
    }

    // function update_post($bdd,$title,$content,$id_category,$id_author,$nom,$id)
   
    function update_post($bdd,$title,$content,$id_category,$id_author,$file,$id)
    {
        $reponse = $bdd->prepare('update posts
        set title = ?, content = ?, id_cat = ?, id_aut = ?,file = ?
         where posts.id=?');
         
        $reponse->execute(array($title,$content,(int)$id_category,(int)$id_author,$file,$id));

       $user = $reponse->fetch();
      
        return $user;
        
    }
    //permet d'inserer un commentaire dans la bdd
    function insert_comment($bdd,$comment,$id_author,$id_post)
    {
                
        $reponse = $bdd->prepare('insert into comments 
        (`comment`, `id_aut`, `id_post`) 
        values (?, ?, ?)');
        $reponse->execute(array($comment,$id_author,$id_post));
    }
    // on recupere les commentaires pour les afficher sous le post "en détail"
    function search_comments($bdd)
    {
        $reponse = $bdd->prepare('select com.id, com.comment, com.id_aut, com.id_post, a.username
         from comments as com
         inner join authors as a on com.id_aut = a.id ');
        $reponse->execute();
        $list_comment = array();
        while ($comment = $reponse->fetch()) {
         
            $list_comment[] = $comment;
        }
        $reponse->closeCursor();
        return $list_comment;
    
    }
    //Permet de supprimer un commentaire dans la bdd
    function delete_solo_comment($bdd, $id)
    {
        $reponse = $bdd->prepare('delete from comments
        where id=?');
        $reponse->execute(array($id));
    }

// UPDATE UN UTILISATEUR
   

    function update_user($bdd,$username,$firstname,$lastname,$email,$password,$apropos,$avatar,$id)

    {
        $reponse = $bdd->prepare('update authors
        set username = ?, firstname = ?, lastname = ?, email = ?, password = ?, apropos = ?, avatar = ?
         where authors.id=?');
         
        $reponse->execute(array($username,$firstname,$lastname,$email,$password,$apropos,$avatar,$id));

       $user = $reponse->fetch();
      
        return $user;
        
    }
    /// Permet de cibler un seul auteur (pour pouvoir recuperer ces infos)
    function search_solo_user($bdd,$id) 
    {
        $id = $_SESSION['id'];
        $reponse = $bdd->prepare('select username, firstname, lastname, email, password, apropos, id 
        from authors
        where id=?');
         
        $reponse->execute(array($id));

       $user = $reponse->fetch();
      
        return $user;
    }
        

//AFFICHER LE PROFIL ET LES ARTICLES D'UN AUTEUR
function posts_author($bdd,$id_author) {
    $reponse=$bdd->prepare('select p.id, p.title, p.content, p.id_cat, p.id_aut, p.file, p.created_date, p.updated_date, a.firstname, a.lastname, a.username, a.email, a.password, a.level, a.apropos, a.avatar, c.name from posts as p 
         inner join authors as a on p.id_aut = a.id 
         inner join categories as c on p.id_cat =c.id where id_aut = ?');
    $reponse->execute(array($id_author));
    $list_posts_author = array();
    while ($post = $reponse->fetch()) {        
   
    $list_posts_author[] = $post;
         }
    $reponse->closeCursor();
    return $list_posts_author;
}


//AFFICHER LE PROFIL ET LES ARTICLES D'UNE CATEGORIE
function posts_category($bdd,$id_category) {
    $reponse=$bdd->prepare('select p.id, p.title, p.content, p.id_cat, p.id_aut, p.file, p.created_date, p.updated_date, a.firstname, a.lastname, a.username, a.email, a.password, a.level, a.apropos, a.avatar, c.name from posts as p 
         inner join authors as a on p.id_aut = a.id 
         inner join categories as c on p.id_cat =c.id where id_cat = ?');
    $reponse->execute(array($id_category));
    $list_posts_category = array();
    while ($post = $reponse->fetch()) {        
   
    $list_posts_category[] = $post;
         }
    $reponse->closeCursor();
    return $list_posts_category;
}

//RECHERCHE DES NOUVEAUX INSCRITS
function search_user_level0($bdd)
    {
//        $level = 0;
        $reponse = $bdd->prepare('select *
         from authors as a where level =0');
        $reponse->execute();
        $list_user = array();
        while ($user = $reponse->fetch()) {
         
            $list_user[] = $user;
        }
        $reponse->closeCursor();
        return $list_user;
        
    }
//RECHERCHE DE TOUS LES UTILISATEURS

function search_all_user($bdd)
    {
//        $level = 0;
        $reponse = $bdd->prepare('select *
         from authors as a where level !=0 and level!=2');
        $reponse->execute();
        $list_user = array();
        while ($user = $reponse->fetch()) {
         
            $list_user[] = $user;
        }
        $reponse->closeCursor();
        return $list_user;
        
    }


//UPDATE LE LEVEL D'UN UTILISATEUR-NOUVEAU

 function update_level($bdd,$level,$id)
    {
        $reponse = $bdd->prepare('update authors
        set level = ?
         where authors.id=?');
         
        $reponse->execute(array($level,$id));

       $user = $reponse->fetch();
      
        return $user;
        
    }

//DELETE USER PAR L'ADMIN

  function delete_user($bdd, $id)
    {
        $reponse = $bdd->prepare('delete from authors
        where id=?');
        $reponse->execute(array($id));
    }

?>






