<?php

require_once __DIR__ . '/vendor/autoload.php';

use Nigel\FreescoutWebhookParser\FreeScoutWebhookParser;

// Test data
$testData = '{
    "id": 36,
    "number": 36,
    "threadsCount": 0,
    "type": "email",
    "folderId": 1,
    "status": "active",
    "state": "published",
    "subject": "Problem with the flux capacitor",
    "preview": "Hi there is a problem with my flux capacitor. Can you please check it\u2019s installed correctly?",
    "mailboxId": 1,
    "assignee": null,
    "createdBy": {
        "id": 27,
        "type": "customer",
        "firstName": "Marty",
        "lastName": null,
        "photoUrl": "",
        "email": "mcfly_42@pm.me"
    },
    "createdAt": "2025-04-09T09:13:05Z",
    "updatedAt": "2025-04-09T09:13:06Z",
    "closedBy": null,
    "closedByUser": null,
    "closedAt": null,
    "userUpdatedAt": null,
    "customerWaitingSince": {
        "time": "2025-04-09T09:13:05Z",
        "friendly": "Just now",
        "latestReplyFrom": "customer"
    },
    "source": {
        "type": "email",
        "via": "customer"
    },
    "cc": [],
    "bcc": [],
    "customer": {
        "id": 27,
        "type": "customer",
        "firstName": "Marty",
        "lastName": null,
        "photoUrl": "",
        "email": "mcfly_42@pm.me"
    },
    "_embedded": {
        "threads": [
            {
                "id": 89,
                "type": "customer",
                "status": "active",
                "state": "published",
                "action": {
                    "type": "",
                    "text": "Marty started a new conversation #36",
                    "associatedEntities": []
                },
                "body": " <div><br><\/div><div dir=\"auto\">Hi there is a problem with my flux capacitor. Can you please check it\u2019s installed correctly?<\/div> ",
                "source": {
                    "type": "email",
                    "via": "customer"
                },
                "customer": {
                    "id": 27,
                    "type": "customer",
                    "firstName": "Marty",
                    "lastName": null,
                    "photoUrl": "",
                    "email": "mcfly_42@pm.me"
                },
                "createdBy": {
                    "id": 27,
                    "type": "customer",
                    "firstName": "Marty",
                    "lastName": null,
                    "photoUrl": "",
                    "email": "mcfly_42@pm.me"
                },
                "assignedTo": null,
                "to": [
                    "support@demo.freescout.net"
                ],
                "cc": [],
                "bcc": [],
                "createdAt": "2025-04-09T09:13:05Z",
                "openedAt": null,
                "_embedded": {
                    "attachments": []
                }
            }
        ]
    },
    "customFields": [
        {
            "id": 1,
            "name": "Priority",
            "value": "",
            "text": ""
        },
        {
            "id": 2,
            "name": "Purchase Date",
            "value": "",
            "text": ""
        }
    ]
}';

try {
    // Create parser instance with test data
    $parser = new FreeScoutWebhookParser($testData);
    
    // Test 1: Parse function with showAll=false (should return WebhookData object)
    echo "Test 1: Parse function with showAll=false\n";
    $result = $parser->parse(false);
    echo json_encode($result, JSON_PRETTY_PRINT) . "\n\n";
    
    // Test 2: Parse function with showAll=true (should return raw data)
    echo "Test 2: Parse function with showAll=true\n";
    $result = $parser->parse(true);
    echo json_encode($result, JSON_PRETTY_PRINT) . "\n\n";
    
    // Test 3: Using interface methods
    echo "Test 3: Using interface methods\n";
    $webhookData = $parser->parse(false);
    echo "Ticket ID: " . $webhookData->getTicketId() . "\n";
    echo "Ticket Subject: " . $webhookData->getTicketSubject() . "\n";
    echo "Customer Name: " . $webhookData->getCustomerName() . "\n";
    echo "Customer Email: " . $webhookData->getCustomerEmail() . "\n";
    echo "Thread Body: " . $webhookData->getThreadBody() . "\n";
    echo "Custom Fields:\n";
    print_r($webhookData->getCustomFields());
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
} 