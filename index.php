<?php

/* Simple include for this script, no need for PSR-4 autoloader */
include './src/InitData.php';
include './src/FindArea.php';

/* Start benchmark time */
$t1 = microtime(true);

/**
 * Get CLI arguments
 * 0: Script name
 * 1: Data type (array, generate, file)
 *    [!] Please note, the file type won't need further arguments.
 * 2: Number of array items (rows)
 * 3: Number of characters in string (cols)
 */
$type = (!empty($argv[1]) ? (string) $argv[1] : 'generate');
$rows = (!empty($argv[2]) ? (int) $argv[2] : 100);
$cols = (!empty($argv[3]) ? (int) $argv[3] : 100);

$data = new MaxSquare\InitData($rows, $cols);

/**
 * Get input data in different ways:
 * a) Allocate full array into memory
 * b) Generate array values
 * c) Read stream / file
 */
if ($type === 'array') {

    $input = $data->store();

} elseif ($type === 'file') {

    $readFile = function ($file) {
        $handle = fopen($file, 'rb');
        if (!$handle) {
            throw new \Exception("Cannot read file.");
        }
        while (feof($handle) !== true) {
            yield fgets($handle);
        }
        fclose($handle);
    };

    $input = $readFile('data.txt');

} else {

    $input = $data->generate();

}

$area = new MaxSquare\FindArea($input);

echo "MAX square area: {$area->get()}".PHP_EOL;

$t2 = microtime(true);

echo $area->stats([$t1, $t2]);
