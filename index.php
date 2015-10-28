<?php

require_once('vendor/autoload.php');
$app = new \Slim\Slim();
$app->response->headers->set('Content-Type', 'application/json');

// Load the Slots class
require_once('warpscan.class.php');
$objWarpscan = new warpscan;

$app->get('/get/:strTag', function ($strTag) {
    global $objWarpscan;
    echo json_encode($objWarpscan->getItem($strTag));
});

$app->get('/new/:strTag/:strName/:intAmount', function ($strTag, $strName, $intAmount) {
    global $objWarpscan;
    echo json_encode($objWarpscan->newItem($strTag, $strName, $intAmount));
});

$app->get('/add/:strTag/:intAmount', function ($strTag, $intAmount) {
    global $objWarpscan;
    echo json_encode($objWarpscan->addItem($strTag, $intAmount));
});

$app->get('/remove/:strTag/:intAmount', function ($strTag, $intAmount) {
    global $objWarpscan;
    echo json_encode($objWarpscan->removeItem($strTag, $intAmount));
});

$app->run();