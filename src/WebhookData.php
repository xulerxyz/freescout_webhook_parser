<?php

namespace Nigel\FreescoutWebhookParser;

use Nigel\FreescoutWebhookParser\Interfaces\WebhookDataInterface;
use JsonSerializable;

class WebhookData implements WebhookDataInterface, JsonSerializable
{
    private array $data;
    private array $filteredData;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->filteredData = [
            'ticket' => [
                'id' => $data['id'] ?? null,
                'number' => $data['number'] ?? null,
                'subject' => $data['subject'] ?? null,
                'status' => $data['status'] ?? null,
                'type' => $data['type'] ?? null,
                'created_at' => $data['createdAt'] ?? null,
            ],
            'customer' => [
                'id' => $data['customer']['id'] ?? null,
                'name' => trim(($data['customer']['firstName'] ?? '') . ' ' . ($data['customer']['lastName'] ?? '')),
                'email' => $data['customer']['email'] ?? null,
            ],
            'thread' => [
                'id' => $data['_embedded']['threads'][0]['id'] ?? null,
                'body' => $data['_embedded']['threads'][0]['body'] ?? null,
                'type' => $data['_embedded']['threads'][0]['type'] ?? null,
            ],
            'custom_fields' => array_map(function($field) {
                return [
                    'id' => $field['id'] ?? null,
                    'name' => $field['name'] ?? null,
                    'value' => $field['value'] ?? null,
                ];
            }, $data['customFields'] ?? []),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->filteredData;
    }

    public function getTicketId(): ?int
    {
        return $this->filteredData['ticket']['id'];
    }

    public function getTicketNumber(): ?int
    {
        return $this->filteredData['ticket']['number'];
    }

    public function getTicketSubject(): ?string
    {
        return $this->filteredData['ticket']['subject'];
    }

    public function getTicketStatus(): ?string
    {
        return $this->filteredData['ticket']['status'];
    }

    public function getTicketType(): ?string
    {
        return $this->filteredData['ticket']['type'];
    }

    public function getTicketCreatedAt(): ?string
    {
        return $this->filteredData['ticket']['created_at'];
    }

    public function getCustomerId(): ?int
    {
        return $this->filteredData['customer']['id'];
    }

    public function getCustomerName(): ?string
    {
        return $this->filteredData['customer']['name'];
    }

    public function getCustomerEmail(): ?string
    {
        return $this->filteredData['customer']['email'];
    }

    public function getThreadId(): ?int
    {
        return $this->filteredData['thread']['id'];
    }

    public function getThreadBody(): ?string
    {
        return $this->filteredData['thread']['body'];
    }

    public function getThreadType(): ?string
    {
        return $this->filteredData['thread']['type'];
    }

    public function getCustomFields(): array
    {
        return $this->filteredData['custom_fields'];
    }

    public function getRawData(): array
    {
        return $this->data;
    }
} 