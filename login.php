<?php require_once('inc/header.php'); ?>

<section class="login container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-5">

            <form action="userarea_ajax.php" id="login" method="POST">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" name="email" placeholder="Your E-mail">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Your Password">
                </div>
                <div id="messages">
                    <p class="text-danger error"></p>
                    <p class="text-success success"></p>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="LOGIN">
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('inc/footer.php'); ?>
