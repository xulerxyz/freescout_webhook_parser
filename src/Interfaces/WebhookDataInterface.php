<?php

namespace Nigel\FreescoutWebhookParser\Interfaces;

interface WebhookDataInterface
{
    public function getData(): array;
    public function getBody(): string;
    public function getSubject(): string;
    public function getFrom(): string;
    public function getTo(): string;
    public function getCc(): string;
    public function getBcc(): string;
    public function getDate(): string;
    public function getMessageId(): string;
    public function getInReplyTo(): string;
    public function getReferences(): string;
    public function getAttachments(): array;
    public function getHeaders(): array;
    public function getCustomFields(): array;
    public function getConversationId(): string;
    public function getThreadId(): string;
    public function getType(): string;
    public function getStatus(): string;
    public function getCustomerId(): string;
    public function getCustomerEmail(): string;
    public function getCustomerName(): string;
    public function getMailboxId(): string;
    public function getMailboxName(): string;
    public function getUserId(): string;
    public function getUserName(): string;
    public function getUserEmail(): string;
    public function getCreatedAt(): string;
    public function getUpdatedAt(): string;
    public function getDeletedAt(): string;
    public function getTags(): array;
    public function getCustomData(): array;
    public function getMeta(): array;
    public function getBasicFields(): array;
    public function getAllFields(): array;
} 