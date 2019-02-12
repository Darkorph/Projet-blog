<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');
try{
    $bdd = new PDO('mysql:host=localhost;dbname=projet-blog', 'root', '');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
};
function search_all_posts_json($bdd)
{
   $reponse = $bdd->prepare('select p.id, p.title, p.content, p.id_aut, p.id_cat, a.firstname,  a.username, c.name, p.created_date, p.file
   from posts as p 
   inner join authors as a on p.id_aut = a.id 
   inner join categories as c on p.id_cat =c.id');
   $reponse->execute();
   $list_post = array();
   $one_post = array();
   while ($post = $reponse->fetch()) {
       $one_post = ['id' => $post['id'], 'title' => utf8_encode($post['title']), 'content' => utf8_encode($post['content']), 'id_cat' => $post['id_cat'],'id_aut' => $post['id_aut'],'created_date' => $post['created_date'],'file' => $post['file'],'firstname' => utf8_encode($post['firstname']),'name' => utf8_encode($post['name']),'username' => utf8_encode($post['username'])];
        $list_post[] = $one_post;
   }
   $reponse->closeCursor();
   return $list_post;
}
echo json_encode(search_all_posts_json($bdd));
?>