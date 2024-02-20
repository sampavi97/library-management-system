<?php
require_once 'SessionManager.php';
require_once 'PersistanceManager.php';

class AppManager 
{
    private static $pm;
    private static $sm;

    public static function getPM()
    {
        if (self::$pm === null) {
            self::$pm = new PersistanceManager();
        }
        return self::$pm;
    }
    
    public static function getSM()
    {
        if (self::$sm === null) {
            self::$sm = new SessionManager();
        }
        return self::$sm;
    }
}
?>