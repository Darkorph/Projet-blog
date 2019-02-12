<?php if(isset($_SESSION['id']))  { ?>
<main class="color1 main_edit my-1">
    <div class="container py-5 ">
        <form method="post" action="<?php if(isset($_GET['action']) && $_GET['action']== 'edit') {echo 'index.php?page=home&action=update&image='.$post_solo1['file'].'&id='.$post_solo1['id'].'';} else { echo "index.php?page=home&action=insert";} ?>" enctype="multipart/form-data">
            <div class="row background_marron justify-content-center  color2 py-1 mb-3 title_edit">
                <input name='title' type="text" placeholder="Titre" class="w-75 bg-color2 b-none" value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit') { echo $post_solo1['title'];} ?>">
            </div>
            
            <div class="row background_marron justify-content-center  color2 py-1 mb-3 title_edit">
                <!-- <input name='category' type="select" placeholder="Categorie" class="w-75 bg-color2 b-none" value=""> -->
                <select name="categories_select" class="browser-default custom-select w-75 bg-color2i b-nonei ">
                    <option value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit'){echo $post_solo1['id_cat'];}  ?>" selected><?php if(isset($_GET['action']) && $_GET['action'] == 'edit') { echo $post_solo1['name'];} else { echo "Selectionnez la catégorie";} ?></option>
                    <?php
                        foreach ($all_categories as $value) {
                            echo '<option name="" value="'.$value['id'].'">'.$value['name'].'</option>';
                        }
                    ?>
                </select>

            </div>
            <div class="row background_marron justify-content-center color2 py-1 content_edit">
                <textarea name="content" id="content" rows="20" class="w-75 bg-color2 b-none" placeholder="Le contenu de l'article..." value=""><?php if(isset($_GET['action']) && $_GET['action'] == 'edit') { echo $post_solo1['content'];} ?></textarea>
            </div>
            <div class="row background_marron justify-content-center  color2 py-1 my-3">
                <input type="file" name="avatar" id="avatar" value="img/551179.jpg">
                <label name="avatar"><?php  if(isset($_GET['action']) && $_GET['action'] == 'edit') {echo $post_solo1['file'];} ?></label>

                <button type="submit" class="bg-color3 submit-edit">Valider</button>
            </div>
            <div class="row">
            </div>
        </form>

    </div>
</main>
<?php } ?>
