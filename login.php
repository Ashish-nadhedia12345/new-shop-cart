<?php
include './config.php';
$user = new User();
if (User::checkLogin()) {
    header('location:' . SITE_WS_PATH . '/dashboard.php');
    exit;
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($user->login($email, $password)) {
        if ($_SESSION['isAdmin']) {
            header('location:' . SITE_WS_PATH . '/admin/index.php');
        } else {
            header('location:' . SITE_WS_PATH . '/dashboard.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</head>

<body>
    <?php include './templates/header.php' ?>
    <div class="w-25 mx-auto mt-4">
        <h1>Login</h1>
        <?php include './message.php' ?>
        <form action="" method="post">
            <table class="table table-bordered">
                <tr>
                    <td><input type="text" placeholder="email" name="email" required class="form-control"></td>
                </tr>
                <tr>
                    <td><input type="password" name="password" required placeholder="password" class="form-control"></td>
                </tr>
                <tr>
                    <td><button type="submit" class="btn btn-primary">save</button></td>
                </tr>
            </table>
        </form>
    </div>
    <?php include './templates/footer.php' ?>
</body>

</html>