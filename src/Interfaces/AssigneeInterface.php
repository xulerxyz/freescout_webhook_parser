<?php

namespace Nigel\FreescoutWebhookParser\Interfaces;

interface AssigneeInterface
{
    /**
     * Get the assignee's ID
     * @return int
     */
    public function getId(): int;

    /**
     * Get the assignee's type (e.g., "user")
     * @return string
     */
    public function getType(): string;

    /**
     * Get the assignee's first name
     * @return string
     */
    public function getFirstName(): string;

    /**
     * Get the assignee's last name
     * @return string
     */
    public function getLastName(): string;

    /**
     * Get the assignee's email address
     * @return string
     */
    public function getEmail(): string;

    /**
     * Get the assignee's full name (first name + last name)
     * @return string
     */
    public function getFullName(): string;
} 