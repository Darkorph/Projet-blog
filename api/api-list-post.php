
<?php

header('Access-Control-Allow-Origin: *'); // pour autoriser l'utilisation de l'api, 
// si on veut limit a certains sites on entrera a la place de "*", le ou les liens des sites que l'on veut autoriser

require('../config/connexion.php');
require('../model/functions.php');
header('Content-type: application/json');



echo json_encode(search_all_posts($bdd));
    

?>