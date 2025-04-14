# FreeScout Webhook Parser

A PHP package for parsing FreeScout webhook payloads with configurable output formats.

## Features

- Parse FreeScout webhook payloads
- Two output formats: filtered (essential fields) or complete data
- Type-safe data access through interface methods
- JSON serialization support
- Null-safe field access
- Easy integration with any PHP application

## Requirements

- PHP 8.1 or higher
- JSON extension

## Installation

Install via Composer:

```bash
composer require nigel/freescout-webhook-parser
```

## Usage

### 1. Basic Usage

```php
use Nigel\FreescoutWebhookParser\FreeScoutWebhookParser;

// Initialize parser
$parser = new FreeScoutWebhookParser();

// Parse webhook data (returns WebhookData object with essential fields)
$webhookData = $parser->parse();

// Access data through interface methods
$ticketId = $webhookData->getTicketId();
$customerName = $webhookData->getCustomerName();
$threadBody = $webhookData->getThreadBody();
```

### 2. Get Complete Data

```php
// Get all fields from the webhook
$allData = $parser->parse(true);
```

### 3. Parse Custom JSON Data

```php
// Parse specific JSON data
$jsonData = '{"id": 36, "subject": "Test ticket", ...}';
$parser = new FreeScoutWebhookParser($jsonData);
$webhookData = $parser->parse();
```

### 4. Available Methods

The WebhookData object provides the following methods:

```php
// Ticket information
getTicketId(): ?int
getTicketNumber(): ?int
getTicketSubject(): ?string
getTicketStatus(): ?string
getTicketType(): ?string
getTicketCreatedAt(): ?string

// Customer information
getCustomerId(): ?int
getCustomerName(): ?string
getCustomerEmail(): ?string

// Thread information
getThreadId(): ?int
getThreadBody(): ?string
getThreadType(): ?string

// Other data
getCustomFields(): array
getRawData(): array
```

### 5. Output Format

#### Filtered Data (Default)
```json
{
    "ticket": {
        "id": 36,
        "number": 36,
        "subject": "Problem with the flux capacitor",
        "status": "active",
        "type": "email",
        "created_at": "2025-04-09T09:13:05Z"
    },
    "customer": {
        "id": 27,
        "name": "Marty",
        "email": "mcfly_42@pm.me"
    },
    "thread": {
        "id": 89,
        "body": "Hi there is a problem with my flux capacitor...",
        "type": "customer"
    },
    "custom_fields": [
        {
            "id": 1,
            "name": "Priority",
            "value": ""
        }
    ]
}
```

## Error Handling

The parser includes built-in error handling:

```php
try {
    $webhookData = $parser->parse();
} catch (\Exception $e) {
    // Handle parsing errors
    echo $e->getMessage();
}
```

## License

MIT License 