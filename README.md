# FreeScout Webhook Parser

A PHP library for parsing FreeScout webhook data with HTML cleaning capabilities.

## Features

- Parse FreeScout webhook data
- Clean HTML content using HtmlCleaner
- Support for both basic and extended data fields
- Easy to use interface
- Type-safe data access

## Installation

```bash
composer require nigel/freescout-webhook-parser
```

## Usage

### Basic Usage

```php
use Nigel\FreescoutWebhookParser\FreeScoutWebhookParser;

// Get webhook data
$rawData = file_get_contents('php://input');

// Create parser instance
$parser = new FreeScoutWebhookParser($rawData);

// Parse the data
$result = $parser->parse();

// Get basic fields
$basicFields = $result->getBasicFields();

// Get all fields
$allFields = $result->getAllFields();
```

### Basic Fields

The `getBasicFields()` method returns the most commonly used fields:

```php
[
    'subject' => string,
    'body' => string,
    'from' => string,
    'to' => string,
    'date' => string,
    'type' => string,
    'status' => string,
    'customer' => [
        'name' => string,
        'email' => string
    ],
    'conversation_id' => string,
    'thread_id' => string
]
```

### All Fields

The `getAllFields()` method returns all available fields:

```php
[
    'subject' => string,
    'body' => string,
    'from' => string,
    'to' => string,
    'cc' => string,
    'bcc' => string,
    'date' => string,
    'message_id' => string,
    'in_reply_to' => string,
    'references' => string,
    'attachments' => array,
    'headers' => array,
    'custom_fields' => array,
    'conversation_id' => string,
    'thread_id' => string,
    'type' => string,
    'status' => string,
    'customer' => [
        'id' => string,
        'name' => string,
        'email' => string
    ],
    'mailbox' => [
        'id' => string,
        'name' => string
    ],
    'user' => [
        'id' => string,
        'name' => string,
        'email' => string
    ],
    'dates' => [
        'created_at' => string,
        'updated_at' => string,
        'deleted_at' => string
    ],
    'tags' => array,
    'custom_data' => array,
    'meta' => array
]
```

## Requirements

- PHP 8.0 or higher
- Composer

## License

This project is licensed under the MIT License - see the LICENSE file for details. 