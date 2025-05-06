<?php

namespace Nigel\FreescoutWebhookParser\DTO;

use Nigel\FreescoutWebhookParser\Interfaces\AssigneeInterface;

class Assignee implements AssigneeInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getId(): int
    {
        return (int)($this->data['id'] ?? 0);
    }

    public function getType(): string
    {
        return $this->data['type'] ?? '';
    }

    public function getFirstName(): string
    {
        return $this->data['firstName'] ?? '';
    }

    public function getLastName(): string
    {
        return $this->data['lastName'] ?? '';
    }

    public function getEmail(): string
    {
        return $this->data['email'] ?? '';
    }

    public function getFullName(): string
    {
        return trim($this->getFirstName() . ' ' . $this->getLastName());
    }
} 