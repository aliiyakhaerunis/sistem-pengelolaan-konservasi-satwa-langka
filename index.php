<?php
require 'vendor/autoload.php';
require_once __DIR__ . '/config/database.php';
ini_set('display_errors',1);

// Load .env file manually
if (file_exists(__DIR__ . '/.env')) {
    $env = parse_ini_file(__DIR__ . '/.env');
    foreach ($env as $key => $value) {
        putenv("$key=$value");
    }
}

// Basic Auth protection
$validUsername = getenv('AUTH_USER');
$validPassword = getenv('AUTH_PASS');

$hasValidAuth = false;
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    if ($_SERVER['PHP_AUTH_USER'] === $validUsername && $_SERVER['PHP_AUTH_PW'] === $validPassword) {
        $hasValidAuth = true;
    }
}

if (!$hasValidAuth) {
    header('WWW-Authenticate: Basic realm="Protected GraphQL"');
    header('HTTP/1.0 401 Unauthorized');
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

use GraphQL\GraphQL;
use App\Schema as AppSchema;

try {
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);
    $query = $input['query'] ?? null;
    $variables = $input['variables'] ?? null;

    if (!$query) {
        throw new \Exception('No GraphQL query found');
    }

    $schema = AppSchema::build();
    $result = GraphQL::executeQuery($schema, $query, null, null, $variables);
    $output = $result->toArray();
} catch (\Exception $e) {
    $output = [
        'errors' => [
            ['message' => $e->getMessage()]
        ]
    ];
}

header('Content-Type: application/json');
echo json_encode($output);
