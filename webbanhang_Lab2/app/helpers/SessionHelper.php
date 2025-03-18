<?php  
class SessionHelper {     
    public static function isLoggedIn() {         
        return isset($_SESSION['username']);     
    }      

    public static function isAdmin() {         
        return isset($_SESSION['username']) && $_SESSION['user_role'] === 'admin';     
    } 
}
