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
                return $arrItems;
            }
            return false;
        }
        return false;
    }

    public function newItem($strTag, $strName, $intAmount = 1) {

        $stmtAddNew = "INSERT INTO items (tag,name,amount) VALUES (:tag,:name,:amount)";
        $objInsert = $this->pdo->prepare($stmtAddNew);
        try {
            $blnSuccess = $objInsert->execute(array(':tag' => $strTag, ':name' => $strName, ':amount' => intval($intAmount)));
            return $blnSuccess;
        }
        catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function addItem($strTag, $intAmount = 1) {
        if(!is_numeric($intAmount)){
            return false;
        }
        $intAmount = intval($intAmount);

        $stmtIncreaseAmount = "UPDATE items SET amount = amount+:intAmount WHERE tag = :strTag";
        $objUpdate = $this->pdo->prepare($stmtIncreaseAmount);
        $objUpdate->bindParam(':intAmount',$intAmount,PDO::PARAM_INT);
        $objUpdate->bindParam(':strTag',$strTag,PDO::PARAM_STR);
        $blnSuccess = $objUpdate->execute();
        return $blnSuccess;
    }

    public function removeItem($strTag, $intAmount = 1) {

        if(!is_numeric($intAmount)){
            return false;
        }
        $intAmount = intval($intAmount);

        $stmtIncreaseAmount = "UPDATE items SET amount = amount-:intAmount WHERE tag = :strTag";
        $objUpdate = $this->pdo->prepare($stmtIncreaseAmount);
        $objUpdate->bindParam(':intAmount',$intAmount,PDO::PARAM_INT);
        $objUpdate->bindParam(':strTag',$strTag,PDO::PARAM_STR);
        $blnSuccess = $objUpdate->execute();
        return $blnSuccess;
    }
}