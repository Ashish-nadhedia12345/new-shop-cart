<?php
class User
{
    public $dbo;
    public function __construct()
    {
        $this->dbo = DBO::getDBO();
    }

    public function create($email, $password, $fullname, $roleId = 2)
    {
        $sql = "SELECT * FROM `users` WHERE `email`='$email'";
        $result = mysqli_query($this->dbo, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['msg'] = 'username is allready exists chose another username';
            return false;
        } else {
            $password = md5($password);
            $sql = "INSERT INTO `users` SET `email`='$email',`password`='$password',`fullname`='$fullname',`role_id`='$roleId'";
            mysqli_query($this->dbo, $sql);
            $_SESSION['msg'] = 'registered successfully';
            return true;
            exit;
        }
    }
    public function login($email, $password)
    {
        $sql = "SELECT * FROM `users` WHERE `email`='$email'";
        $result = mysqli_query($this->dbo, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if ($user['password'] == md5($password)) {
                unset($_SESSION['password']);
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['user'] = $user;
                $_SESSION['msg'] = 'logged in successfully';
                if ($user['role_id'] == 1) {
                    $_SESSION['isAdmin'] = true;
                }
                return true;
            } else {
                $_SESSION['msg'] = 'user not found';
                return false;
            }
        } else {
            $_SESSION['msg'] = 'user not found';
            return false;
        }
    }




    public static function checkLogin()
    {
        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
            return true;
        } else {
            return false;
            exit;
        }
    }
    public static function checkAdminLogin()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
            return true;
        } else {
            return false;
            exit;
        }
    }
    public static function isAuthorizedUser()
    {
        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
            return true;
        } else {
            $_SESSION['err_msg'] = 'you are not authorized to view this page';
            header('location:' . SITE_WS_PATH . '/login.php');
            exit;
        }
    }
    public static function isAuthorizedAdminUser()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
            return true;
        } else {
            $_SESSION['err_msg'] = "You are not authorized to perform this action";
            header('location: ' . SITE_WS_PATH . '/login.php');
            exit;
        }
    }
}
