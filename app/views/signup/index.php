<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Disqes | <?= $data['title']; ?> Page</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="<?= BASEURL; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>css/style.css">
    <!-- END STYLE CSS -->

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="d-none d-lg-inline-block col-lg-7 col-xl-8 p-0 background-image" style="height: 100vh;"></div>
            <div class="col p-0">
                <div class="card-login w-100 d-flex flex-column align-items-center">
                    <div class="flasher-wrap w-100">
                        <?php Flasher::flash(); ?>
                    </div>
                    <img src="<?= BASEURL; ?>img/brand-logo/brand-logo.svg" alt="Brand Logo" style="margin-bottom: 48px;">
                    <form action="<?= BASEURL; ?>signup/signUpAction" method="post" style="width: 100%; gap: 24px;" class="d-flex flex-column">
                        <div class="wrapper d-flex flex-column" style="gap: 16px;">
                            <div class="input-wrapper w-100 position-relative">
                                <p class="caption-input">Username</p>
                                <input type="text" class="input position-relative" name="username" autocomplete="off">
                            </div>
                            <div class="input-wrapper w-100 position-relative">
                                <p class="caption-input">Email</p>
                                <input type="email" class="input position-relative" name="email" autocomplete="off">
                            </div>
                            <div class="input-wrapper w-100 position-relative">
                                <p class="caption-input">Password</p>
                                <input type="password" class="input position-relative" name="password" autocomplete="off">
                            </div>
                        </div>
                        <div class="wrapper d-flex gap-3">
                            <div class="input-radio d-flex align-items-center">
                                <input type="radio" id="admin" name="role" value="super_admin">
                                <label for="admin">Super Admin</label>
                            </div>
                            <div class="input-radio d-flex align-items-center">
                                <input type="radio" id="member" name="role" value="member">
                                <label for="member">Member</label>
                            </div>
                        </div>
                        <button type="submit" class="button-login text-center">Sign up</button>
                    </form>
                    <p class="caption-login" style="margin-top: 12px;">This site is protected by reCAPTCHA and the Google <a href="#">Privacy Policy</a> and <a href="#">Terms of Service</a> apply.</p>
                    <span class="caption-redirect" style="margin-top: 48px;">Already have’an account? <a href="<?= BASEURL; ?>signin" class="link-redirect">Sign in</a></span>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT JS -->
    <script src="<?= BASEURL; ?>js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASEURL; ?>js/script.js"></script>
    <!-- END SCRIPT JS -->
</body>

</html>