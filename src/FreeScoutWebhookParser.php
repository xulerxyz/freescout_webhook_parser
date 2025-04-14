<?php

namespace Nigel\FreescoutWebhookParser;

use Nigel\FreescoutWebhookParser\DTO\WebhookMessageData;
use Nigel\FreescoutWebhookParser\Helpers\HtmlCleaner;

class FreeScoutWebhookParser
{
    private array $data;


    public function __construct(?string $data = null)
    {
        
        if ($data !== null) {
            $this->data = json_decode($data, true) ?? [];
        } else {
            // Get the raw input data
            $input = file_get_contents('php://input');
            $this->data = json_decode($input, true) ?? [];
        }
    }

    public function parse(): array|WebhookMessageData
    {
        if (empty($this->data)) {
            return ['error' => 'No data received'];
        }

        try {

            return new WebhookMessageData($this->data);
        } catch (\Exception $e) {
            return ['error' => 'Failed to parse webhook data: ' . $e->getMessage()];
        }
    }
}