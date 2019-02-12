<main class="color1 main_edit my-1">
    <div class="container pt-5 ">
        <!-- Default form register -->
        <form class="text-center p-5 background_marron  color2" action="index.php?page=home&action=new-user" method="post" enctype="multipart/form-data">

            <p class="h4 mb-4">S'enregistrer</p>

            <div class="form-row mb-4">
                <div class="col">
                    <!-- First name -->
                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Prénom" autocomplete="off" required minlength="3" maxlength="15">
                </div>
                <div class="col">
                    <!-- Last name -->
                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Nom" autocomplete="off" required minlength="3" maxlength="15">
                </div>
            </div>


            <!-- E-mail -->
            <div class="form-row mb-4">
                <div class="col">
                    <!-- Last name -->
                    <input type="text" id="username" name="username" class="form-control" placeholder="Pseudo" required  autocomplete="off" minlength="3" maxlength="12" >
                </div>
                <div class="col">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" autocomplete="off" required pattern="(?!(^[.-].*|[^@]*[.-]@|.*\.{2,}.*)|^.{254}.)([a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@)(?!-.*|.*-\.)([a-zA-Z0-9-]{1,63}\.)+[a-zA-Z]{2,5}">
                </div>
            </div>

            <!-- Password -->
            <input type="password" id="password" name="password" value="" class="form-control mb-4" placeholder="Entrez votre mot de passe" aria-describedby="defaultRegisterFormPasswordHelpBlock" autocomplete="off" required>

            <!---Re-password ---->
            <input type="password" id="repeat-password" name="repeat-password" class="form-control mb-4" placeholder="Répétez votre mot de passe" aria-describedby="defaultRegisterFormPasswordHelpBlock" autocomplete="off" required>


            <!-- Phone number -->
            <!--
    <input type="text" id="defaultRegisterPhonePassword" class="form-control" placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock">
 --->
           <textarea rows="10" name="apropos" id="apropos" class="form-control mb-4 col-12 b-nonei b-radiusi shadow-box" placeholder="A propos de vous!"></textarea>
           
            <div class="custom-file">
                <input type="file" name="avatar" class="custom-file-input" id="avatar" aria-describedby="fileInput">
                <label class="custom-file-label" for="fileInput">Votre avatar</label>
            </div>



            <!-- Sign up button -->
            <button class="btn btn-info my-4 btn-block w-25 mx-auto" type="submit">S'inscrire</button>

            <!-- Social register -->
            <!--
    <p>or sign up with:</p>

    <a type="button" class="light-blue-text mx-2">
        <i class="fab fa-facebook-f"></i>
    </a>
    <a type="button" class="light-blue-text mx-2">
        <i class="fab fa-twitter"></i>
    </a>
    <a type="button" class="light-blue-text mx-2">
        <i class="fab fa-linkedin-in"></i>
    </a>
    <a type="button" class="light-blue-text mx-2">
        <i class="fab fa-github"></i>
    </a>

    <hr>
-->

            <!-- Terms of service -->
            <!--
    <p>By clicking
        <em>Sign up</em> you agree to our
        <a href="" target="_blank">terms of service</a>
-->

        </form>
        <!-- Default form register -->
    </div>
</main>
