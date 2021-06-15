<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="<?= base_url('/assets/css/font-face.css') ?>" rel="stylesheet" media="all">
    <link href="<?= base_url('/assets/vendor/font-awesome-4.7/css/font-awesome.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= base_url('/assets/vendor/font-awesome-5/css/fontawesome-all.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= base_url('/assets/vendor/mdi-font/css/material-design-iconic-font.min.css') ?>" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?= base_url('/assets/vendor/bootstrap-4.1/bootstrap.min.css') ?>" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?= base_url('/assets/vendor/animsition/animsition.min.css') ?>" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?= base_url('/assets/css/theme.css') ?>" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="<?= base_url() ?>/assets/images/logo.png" width="200px">
                            </a>
                        </div>
                        <div class="text-center">
                            <p><b>Selamat Datang di Aplikasi Sistem Informasi E-Sensus Penduduk Desa Malimpung</b></p>
                        </div>
                        <br>
                        <div class="login-form">
                            <form id="formLogin" onsubmit="return false" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" required>
                                </div>
                                <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="<?= base_url('/assets/vendor/jquery-3.2.1.min.js') ?>"></script>
    <!-- Bootstrap JS-->
    <script src="<?= base_url('/assets/vendor/bootstrap-4.1/popper.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-4.1/bootstrap.min.js') ?>"></script>
    <!-- Vendor JS       -->
    <script src="<?= base_url('/assets/vendor/animsition/animsition.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/sweetalert/sweetalert.min.js') ?>"></script>

    <!-- Main JS-->
    <script src="<?= base_url('/assets/js/main.js') ?>"></script>

    <script>
        const $form = $('#formLogin')

        $form.on('submit', () => {
            const data = $form.serializeArray()

            $.ajax(`<?= base_url('api/login') ?>`, {
                method: 'post',
                dataType: 'json',
                data,
            }).then(res => {
                swal('Informasi', res.message, res.error ? 'error' : 'success', {
                    timer: 1500
                }).then(() => {
                    if (res.error) return
                    window.location = `${res.level}/`
                })
            }).catch(() => {
                swal('Gagal!', 'Terjadi masalah diserver', 'error')
            })
        })
    </script>
</body>

</html>
<!-- end document-->