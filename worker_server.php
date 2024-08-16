<?php

use Workerman\Worker;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;

require_once __DIR__ . '/vendor/autoload.php';

// Create a Websocket server
$wsWorker = new Worker('websocket://0.0.0.0:20206');
$wsWorker->count = 4;

// Emitted when new connection come
$wsWorker->onConnect = function ($connection) {
    echo "New connection\n";
};

// Emitted when data received
$wsWorker->onMessage = function ($connection, $data) {
    // var_dump($data);
    onPrint('XP-Q200', $data);
};

// Emitted when connection closed
$wsWorker->onClose = function ($connection) {
    echo "Connection closed\n";
};

// Run worker
Worker::runAll();

function onPrint(string $printerName, mixed $data): void
{
    try {
        $connector = new WindowsPrintConnector($printerName);
        $printer = new Printer($connector);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text($data);
        $printer->cut();
        $printer->close();
    } catch (\Throwable $th) {
        echo $th;
    }
}