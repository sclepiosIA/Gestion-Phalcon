<?php
namespace Manager;

use Phalcon\Di\Di;

/**
 * Manage User connection and data
 */
class User{

    /**
     * Disconnect user from application and destroy session
     * 
     * @return void
     */
    public static function disconnect():void{
        Di::getDefault()->get('session')->remove('user');
        Di::getDefault()->get('session')->remove('permissions');
        Di::getDefault()->get('session')->destroy();
    }

    /**
     * Connect an user to the application
     * 
     * @param \User $user User model instance
     * 
     * @return void
     */
    public static function connect($user):void{
        Di::getDefault()->get('session')->set('user', $user);
    }

    /**
     * Get user data
     * 
     * @param null|string $name=null Data name
     * @return mixed Return the wanted data or all if null
     */
    public static function get(null|string $name=null):mixed{
        if(!isset($name)){
            return Di::getDefault()->get('session')->get('user');
        } else {
            return Di::getDefault()->get('session')->get('user')[$name];
        }
    }

    /**
     * Get all user permissions
     * 
     * @return int User permission id
     */
    public static function getPermission():int{
        if (self::isAuthenticated()) {
            $user = Di::getDefault()->get('session')->get('user');
            // Compat: certains projets n'ont pas de permissions legacy.
            return isset($user['us_permission_id']) ? (int)$user['us_permission_id'] : 0;
        }

        // Fallback: si PermissionType n'existe pas, on utilise un rôle statique.
        if (class_exists('PermissionType')) {
            return (int)\PermissionType::findFirstByPetyName('anonymous')->pety_id;
        }

        return 0;
    }

    /**
     * Check if user have a permission
     * 
     * @param int $id Permission id
     * 
     * @return bool Check result
     */
    public static function havePermission(int $id):bool{
        return self::getPermission() === $id;
    }

    /**
     * Check if the user is connected to the application
     * 
     * @return bool Result of the check
     */
    public static function isAuthenticated():bool{
        return Di::getDefault()->get('session')->get('user') !== null;
    }

}