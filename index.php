<?php

use Nigel\FreescoutWebhookParser\FreeScoutWebhookParser;
/**
 * FreeScout Webhook Parser
 * 
 * This file serves as the main entry point for the webhook parser plugin.
 */

// Load Composer's autoloader
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Composer dependencies not installed. Please run "composer install"']);
    exit;
}

// Set the response header
header('Content-Type: application/json');

try {
    // Get raw input data
    $rawData = file_get_contents('php://input');
    
    if (empty($rawData)) {
        http_response_code(400);
        echo json_encode(['error' => 'No data received']);
        exit;
    }

    // Get showAll parameter from query string, default to false
    $showAll = isset($_GET['showAll']) ? filter_var($_GET['showAll'], FILTER_VALIDATE_BOOLEAN) : false;
    
    // Create parser instance with raw data
    $webhookParser = new FreeScoutWebhookParser($rawData);
    $result = $webhookParser->parse();
    
    if (is_array($result) && isset($result['error'])) {
        http_response_code(400);
        echo json_encode($result);
    } else {
        echo json_encode([
            'success' => true,
            'data' => $showAll ? $result->getAllFields() : $result->getBasicFields()
        ], JSON_PRETTY_PRINT);
    }
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}