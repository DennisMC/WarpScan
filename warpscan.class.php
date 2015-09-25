<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 25-09-2015
 * Time: 10:06
 */

class warpscan {

    private $pdo;

    function __construct() {
        $strHost = '127.0.0.1';
        $strUsername = "root";
        $strPass = '';
        $strDatabase = 'warpscan';

        // Create connection
        $this->pdo = new PDO("mysql:host=$strHost;dbname=$strDatabase", $strUsername, $strPass);

        // set the PDO error mode to exception
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public function getItem($strTag) {
        $stmtGetItems = $this->pdo->prepare('SELECT * FROM `items` WHERE `tag` = :strTag');

        $stmtGetItems->bindParam(':strTag',$strTag,PDO::PARAM_STR);

        if($stmtGetItems->execute()){
            //do some checks and get data
            $arrItems = $stmtGetItems->fetchAll(PDO::FETCH_ASSOC);
            if(is_array($arrItems) && !empty($arrItems)){
                return 'Exists!';
            }
            return false;
        }
        return false;
    }

    public function newItem($strTag, $strName, $intAmount = 1) {
        // Add a new item
    }

    public function addItem($strTag, $intAmount = 1) {
        // Add items
    }

    public function removeItem($strTag, $intAmount = 1) {
        // Remove items
    }
}