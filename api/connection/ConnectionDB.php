<?php

#This class is responsible for the connection with the Database.

/**
 * Class ConnectionDB
 */
class ConnectionDB
{

    #Declare our attribute that will receive the instance of database.
    #DB Static DB params
    private static $host = 'localhost';
    private static $db_name = 'api';
    private static $username = 'root';
    private static $password = '';
    public static $instance;

    private function __construct()
    {

    }

    #Create the method that will make the connection with the database and will set this connection in the attribute "instance".
    #If you need to change driver just print a list of all the drivers that PDO currently supports, use the following code:
    ## var_dump(PDO::getAvailableDrivers());
    public static function getInstance()
    {
        #Verify if the attribute already have a connection set in it.
        if (!isset(self::$instance)) {
            #Create a new PDO object and make the connection with database.
            try {
                self::$instance = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db_name,
                self::$username, self::$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
            } catch (PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
        }
        #Return the attribute with the connection setted in it.
        return self::$instance;
    }
}

?>