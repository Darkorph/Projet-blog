<?php
class PostQuery 
{
    private $_bdd;

    public function __construct()
    {
        // $this->_bdd = $_bdd;
    }

    public static function search_all_posts($bdd)
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
    public static function search_all_authors($bdd)
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
    //RECHERCHE DES NOUVEAUX INSCRITS
    public static function search_user_level0($bdd)
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
    //recupere pour afficher toute les catégories
    public static function search_all_categories($bdd)
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
    public static function search_solo_user($bdd,$id)  /// Permet de cibler un seul auteur (pour pouvoir recuperer ces infos)
    {
        $id = $_SESSION['id'];
        $reponse = $bdd->prepare('select username, firstname, lastname, email, password, apropos, id 
        from authors
        where id=?');
         
        $reponse->execute(array($id));

       $user = $reponse->fetch();
      
        return $user;
    }
    //Permet de supprimer un commentaire dans la bdd
    public static function delete_solo_comment($bdd, $id)
    {
        $reponse = $bdd->prepare('delete from comments
        where id=?');
        $reponse->execute(array($id));
    }
    // permet de supprimer un post de la bdd
    public static function delete_solo_post($bdd)
    {
        $id = $_GET['id'];
        
        $reponse = $bdd->prepare('delete from posts
        where id=?');
        $reponse->execute(array($id));
    }

    //DELETE USER PAR L'ADMIN
    public static function delete_user($bdd, $id)
    {
        $reponse = $bdd->prepare('delete from authors
        where id=?');
        $reponse->execute(array($id));
    }
    // On RECUPERE UN SEUL POST POUR LE VOIR EN DETAIL
    public static function search_solo_posts($bdd)
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
    //permet d'inserer un commentaire dans la bdd
    public static function insert_comment($bdd,$comment,$id_author,$id_post)
    {
                
        $reponse = $bdd->prepare('insert into comments 
        (`comment`, `id_aut`, `id_post`) 
        values (?, ?, ?)');
        $reponse->execute(array($comment,$id_author,$id_post));
    }
    // recherche les information sur l'utilisateur pour comparer les information saisie pour valider la connexion
    public static function search_user($bdd,$username,$password)
    {
        $reponse = $bdd->prepare('select  a.firstname, a.lastname, a.id, a.username, a.email, a.level, a.avatar, a.apropos, a.password
         from authors as a
         where a.username=? and a.password=?');
         
        $reponse->execute(array($username, MD5($password)));
        
       $user = $reponse->fetch();
       
        return $user;
        
    }
    //INSERER UN AUTEUR
    public static function insert_author($bdd,$firstname,$lastname,$username,$email,$password,$level,$apropos,$avatar)
    {      
        $reponse = $bdd->prepare('insert into authors 
        (firstname, lastname, username, email, password, level, apropos, avatar) 
        values (?, ?, ?, ?, ?, ?, ?, ?)');
        $reponse->execute(array($firstname, $lastname, $username,$email, $password,$level,$apropos,$avatar));
    }
}


?>