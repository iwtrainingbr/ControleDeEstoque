<?php


namespace App\Security;


class UserPermission
{
    public static function needUserLogged(): void
    {
        if (!isset($_SESSION['user_logged'])) {
            $_SESSION['error'] = ['Precisa estar logado'];
            header('location: /');
            exit;
        }
    }

    public static function needUserAdmin()
    {

    }
}