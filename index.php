<?php
function error($err, $code = 400) {
    http_response_code($code);
    if ($err != '')
        echo json_encode(['detail' => $err]);
    exit();
}

$accounts = [
    // ADD YOUR STELLAR ADDRESSES HERE, LIKE THE EXAMPLE BELOW
    'wallet*example.com' => [
        'stellar_address' => 'wallet*example.com',
        'account_id' => '<account_id>',
    ],
];

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

if (!array_key_exists('q', $_GET) || !array_key_exists('type', $_GET))
    error('Expected parameters q and type.');

if ($_GET['type'] == 'name') {
    $nameLookup = strtolower($_GET['q']);
    if (!array_key_exists($nameLookup, $accounts))
        error('No record found.', 404);
    echo json_encode($accounts[$nameLookup]);
} else {
    error('Unsupported type.');
}