<main class="color1 main_edit my-1">
    <div class="container pt-5">        
        <div class="row color2 mt-2">
            <div class="col-12">
                <h2 class="my-3 mb-4">La listes des articles publiés dans la catégorie : <?php echo $posts_category['0']['name']  ?></h2>
            </div>
            <div class="col-12 mb-3">
                   <?php
            $i=1;
      foreach ($posts_category as $post) {
          echo "<div class='mt-2'><a class='text-white' href='post-".$post['id']."'>".$i." — ".$post['title']."</div>";         
          $i++;      }
    ?> 
            </div>
        </div>
    </div>
</main>
