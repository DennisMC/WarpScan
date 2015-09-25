<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 03-07-2015
 * Time: 10:12
 */

require_once('vendor/autoload.php');
$app = new \Slim\Slim();
$app->response->headers->set('Content-Type', 'application/json');

// Load the Slots class
require_once('warpscan.class.php');
$objWarpscan = new warpscan;

$app->get('/get', function () {
    global $objWarpscan;
    echo json_encode($objWarpscan->getItem());
});

$app->run();