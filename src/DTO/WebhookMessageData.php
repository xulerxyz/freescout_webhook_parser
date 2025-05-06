<?php

namespace Nigel\FreescoutWebhookParser\DTO;

use Nigel\FreescoutWebhookParser\Interfaces\WebhookDataInterface;
use Nigel\FreescoutWebhookParser\Helpers\HtmlCleaner;
use Nigel\FreescoutWebhookParser\DTO\Assignee;

class WebhookMessageData implements WebhookDataInterface
{
    private array $data;
    private HtmlCleaner $htmlCleaner;
    private ?Assignee $assignee = null;

    public function __construct(array $data)
    {
        $this->htmlCleaner = new HtmlCleaner();
        $this->data = $data;
        if (isset($data['assignee'])) {
            $this->assignee = new Assignee($data['assignee']);
        }
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getBasicFields(): array
    {
        return [
            'subject' => $this->getSubject(),
            'body' => $this->getBody(),
            'from' => $this->getFrom(),
            'to' => $this->getTo(),
            'date' => $this->getDate(),
            'type' => $this->getType(),
            'status' => $this->getStatus(),
            'customer' => [
                'name' => $this->getCustomerName(),
                'email' => $this->getCustomerEmail()
            ],
            'assignee' => $this->assignee ? [
                'id' => $this->assignee->getId(),
                'name' => $this->assignee->getFullName(),
                'email' => $this->assignee->getEmail()
            ] : null,
            'conversation_id' => $this->getConversationId(),
            'thread_id' => $this->getThreadId()
        ];
    }

    public function getAllFields(): array
    {
        $fields = [
            'subject' => $this->getSubject(),
            'body' => $this->getBody(),
            'from' => $this->getFrom(),
            'to' => $this->getTo(),
            'cc' => $this->getCc(),
            'bcc' => $this->getBcc(),
            'date' => $this->getDate(),
            'message_id' => $this->getMessageId(),
            'in_reply_to' => $this->getInReplyTo(),
            'references' => $this->getReferences(),
            'attachments' => $this->getAttachments(),
            'headers' => $this->getHeaders(),
            'custom_fields' => $this->getCustomFields(),
            'conversation_id' => $this->getConversationId(),
            'thread_id' => $this->getThreadId(),
            'type' => $this->getType(),
            'status' => $this->getStatus(),
            'customer' => [
                'id' => $this->getCustomerId(),
                'name' => $this->getCustomerName(),
                'email' => $this->getCustomerEmail()
            ],
            'mailbox' => [
                'id' => $this->getMailboxId(),
                'name' => $this->getMailboxName()
            ],
            'user' => [
                'id' => $this->getUserId(),
                'name' => $this->getUserName(),
                'email' => $this->getUserEmail()
            ],
            'assignee' => $this->assignee ? [
                'id' => $this->assignee->getId(),
                'type' => $this->assignee->getType(),
                'name' => $this->assignee->getFullName(),
                'email' => $this->assignee->getEmail()
            ] : null,
            'dates' => [
                'created_at' => $this->getCreatedAt(),
                'updated_at' => $this->getUpdatedAt(),
                'deleted_at' => $this->getDeletedAt()
            ],
            'tags' => $this->getTags(),
            'custom_data' => $this->getCustomData(),
            'meta' => $this->getMeta()
        ];

        return $fields;
    }

    public function getBody(): string
    {
        return $this->htmlCleaner->clean($this->data['_embedded']['threads'][0]['body'] ?? '');
    }

    public function getSubject(): string
    {
        return $this->data['subject'] ?? '';
    }

    public function getFrom(): string
    {
        return $this->data['customer']['email'] ?? '';
    }

    public function getTo(): string
    {
        return implode(', ', $this->data['_embedded']['threads'][0]['to'] ?? []);
    }

    public function getCc(): string
    {
        return implode(', ', $this->data['_embedded']['threads'][0]['cc'] ?? []);
    }

    public function getBcc(): string
    {
        return implode(', ', $this->data['_embedded']['threads'][0]['bcc'] ?? []);
    }

    public function getDate(): string
    {
        return $this->data['createdAt'] ?? '';
    }

    public function getMessageId(): string
    {
        return (string)($this->data['_embedded']['threads'][0]['id'] ?? '');
    }

    public function getInReplyTo(): string
    {
        return '';
    }

    public function getReferences(): string
    {
        return '';
    }

    public function getAttachments(): array
    {
        return $this->data['_embedded']['threads'][0]['_embedded']['attachments'] ?? [];
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function getCustomFields(): array
    {
        return $this->data['customFields'] ?? [];
    }

    public function getConversationId(): string
    {
        return (string)($this->data['id'] ?? '');
    }

    public function getThreadId(): string
    {
        return (string)($this->data['_embedded']['threads'][0]['id'] ?? '');
    }

    public function getType(): string
    {
        return $this->data['type'] ?? '';
    }

    public function getStatus(): string
    {
        return $this->data['status'] ?? '';
    }

    public function getCustomerId(): string
    {
        return (string)($this->data['customer']['id'] ?? '');
    }

    public function getCustomerEmail(): string
    {
        return $this->data['customer']['email'] ?? '';
    }

    public function getCustomerName(): string
    {
        return $this->data['customer']['firstName'] ?? '';
    }

    public function getMailboxId(): string
    {
        return (string)($this->data['mailboxId'] ?? '');
    }

    public function getMailboxName(): string
    {
        return '';
    }

    public function getUserId(): string
    {
        return (string)($this->data['createdBy']['id'] ?? '');
    }

    public function getUserName(): string
    {
        return $this->data['createdBy']['firstName'] ?? '';
    }

    public function getUserEmail(): string
    {
        return $this->data['createdBy']['email'] ?? '';
    }

    public function getCreatedAt(): string
    {
        return $this->data['createdAt'] ?? '';
    }

    public function getUpdatedAt(): string
    {
        return $this->data['updatedAt'] ?? '';
    }

    public function getDeletedAt(): string
    {
        return $this->data['closedAt'] ?? '';
    }

    public function getTags(): array
    {
        return [];
    }

    public function getCustomData(): array
    {
        return [];
    }

    public function getMeta(): array
    {
        return [];
    }

    public function getAssignee(): ?Assignee
    {
        return $this->assignee;
    }
} 