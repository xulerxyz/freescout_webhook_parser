<?php

namespace Nigel\FreescoutWebhookParser;

use Nigel\FreescoutWebhookParser\WebhookData;

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

    public function parse(bool $showAll = false): array|WebhookData
    {
        if (empty($this->data)) {
            return ['error' => 'No data received'];
        }

        try {
            if ($showAll) {
                return $this->data;
            }

            return new WebhookData($this->data);
        } catch (\Exception $e) {
            return ['error' => 'Failed to parse webhook data: ' . $e->getMessage()];
        }
    }
}