<?php

require_once('vendor/autoload.php');
use Slim\Slim;
use Zend\Barcode\Barcode;

$app = new Slim();
$app->response->headers->set('Content-Type', 'application/json');

// Load the Slots class
require_once('warpscan.class.php');
$objWarpscan = new warpscan;
$app->group('/items', function()  use ($objWarpscan, $app) {
    $app->get('/get/:strTag', function ($strTag) use ($objWarpscan) {
        echo json_encode($objWarpscan->getItem($strTag));
    });

    $app->get('/new/:strTag/:strName/:intAmount', function ($strTag, $strName, $intAmount) use ($objWarpscan) {
        echo json_encode($objWarpscan->newItem($strTag, $strName, $intAmount));
    });

    $app->get('/add/:strTag/:intAmount', function ($strTag, $intAmount) use ($objWarpscan) {
        echo json_encode($objWarpscan->addItem($strTag, $intAmount));
    });

    $app->get('/remove/:strTag/:intAmount', function ($strTag, $intAmount) use ($objWarpscan) {
        echo json_encode($objWarpscan->removeItem($strTag, $intAmount));
    });
});

$app->get('/barcodes/:strTag.png', function($strTag) use ($app) {
    $app->response->headers->set('Content-Type', 'image/png');

// Only the text to draw is required
    $barcodeOptions = array('text' => $strTag);

// No required options
    $rendererOptions = array();

// Draw the barcode in a new image,
    Barcode::factory(
        'code128', 'image', $barcodeOptions, $rendererOptions
    )->render();

});

$app->run();