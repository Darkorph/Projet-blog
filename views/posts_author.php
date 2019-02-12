<main class="color1 main_edit my-1">
    <div class="container pt-5">
    <div class="row color2 py-3">
        <div class="col-3">
        <div class="w-75 h-75">
        <img class="w-100" src="<?php 
                            if(isset($posts_author['0']['avatar'])){
                                    echo $posts_author['0']['avatar'];
                            }else{echo 'img/avatar-1.jpg';}?>" alt="">
        
        </div>
        </div>
        <div class="col-9 h3">
            <div class="row">Nom : <?php echo $posts_author['0']['lastname']; ?></div>
            <div class="row">Prénom : <?php echo $posts_author['0']['firstname']; ?></div>
            <div class="row">Pseudo : <?php echo $posts_author['0']['username']; ?></div>
            <div class="row">Nombre d'articles : <?php echo count($posts_author); ?></div>
        </div>
    </div>
    <div class="row color2 mt-2">
       <div class="col-12">
       <h2 class="my-3 mb-4">La listes des articles publiés par <?php echo $posts_author['0']['username']; ?></h2>           

            <?php
            $i=1;
      foreach ($posts_author as $post) {
          echo "<div class='mt-3'><a class='text-white' href='post-".$post['id']."'>".$i." — ".$post['title']."</div>";
          $i++;
      }
    ?> 
 </div>
    </div>
     
    </div>
</main>
 
  
  

  



