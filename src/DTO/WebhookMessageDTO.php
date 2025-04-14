<?php

namespace Nigel\FreescoutWebhookParser\DTO;

use Nigel\FreescoutWebhookParser\Helpers\HtmlCleaner;


class WebhookMessageDTO
{
    // Required fields
    public string $sender_id;
    public string $message;
    public string $platform;
    public string $timestamp;
    public int $ticket_id;
    public int $thread_id;

    // Optional fields
    public ?string $subject = null;
    public ?string $preview = null;
    public ?int $mailbox_id = null;
    public ?string $status = null;
    public ?string $state = null;
    public ?array $customer = null;
    public ?array $created_by = null;
    public ?array $source = null;
    public ?array $cc = null;
    public ?array $bcc = null;
    public ?array $custom_fields = null;
    public ?string $type = null;
    public ?int $folder_id = null;
    public ?array $assignee = null;
    public ?string $created_at = null;
    public ?string $updated_at = null;
    public ?array $closed_by = null;
    public ?string $closed_at = null;
    public ?string $user_updated_at = null;
    public ?array $customer_waiting_since = null;

    private HtmlCleaner $htmlCleaner;

    public function __construct(
        string $sender_id,
        string $message,
        string $platform,
        string $timestamp,
        int $ticket_id,
        int $thread_id,
        ?string $subject = null,
        ?string $preview = null,
        ?int $mailbox_id = null,
        ?string $status = null,
        ?string $state = null,
        ?array $customer = null,
        ?array $created_by = null,
        ?array $source = null,
        ?array $cc = null,
        ?array $bcc = null,
        ?array $custom_fields = null,
        ?string $type = null,
        ?int $folder_id = null,
        ?array $assignee = null,
        ?string $created_at = null,
        ?string $updated_at = null,
        ?array $closed_by = null,
        ?string $closed_at = null,
        ?string $user_updated_at = null,
        ?array $customer_waiting_since = null
    ) {
        $this->htmlCleaner = new HtmlCleaner();
        
        $this->sender_id = $sender_id;
        $this->message = $this->htmlCleaner->clean($message);
        $this->platform = $platform;
        $this->timestamp = $timestamp;
        $this->ticket_id = $ticket_id;
        $this->thread_id = $thread_id;
        
        // Optional fields
        $this->subject = $subject;
        $this->preview = $preview;
        $this->mailbox_id = $mailbox_id;
        $this->status = $status;
        $this->state = $state;
        $this->customer = $customer;
        $this->created_by = $created_by;
        $this->source = $source;
        $this->cc = $cc;
        $this->bcc = $bcc;
        $this->custom_fields = $custom_fields;
        $this->type = $type;
        $this->folder_id = $folder_id;
        $this->assignee = $assignee;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->closed_by = $closed_by;
        $this->closed_at = $closed_at;
        $this->user_updated_at = $user_updated_at;
        $this->customer_waiting_since = $customer_waiting_since;
    }

    public function toArray(): array
    {
        return array_filter([
            'sender_id' => $this->sender_id,
            'message' => $this->message,
            'platform' => $this->platform,
            'timestamp' => $this->timestamp,
            'ticket_id' => $this->ticket_id,
            'thread_id' => $this->thread_id,
            'subject' => $this->subject,
            'preview' => $this->preview,
            'mailbox_id' => $this->mailbox_id,
            'status' => $this->status,
            'state' => $this->state,
            'customer' => $this->customer,
            'created_by' => $this->created_by,
            'source' => $this->source,
            'cc' => $this->cc,
            'bcc' => $this->bcc,
            'custom_fields' => $this->custom_fields,
            'type' => $this->type,
            'folder_id' => $this->folder_id,
            'assignee' => $this->assignee,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'closed_by' => $this->closed_by,
            'closed_at' => $this->closed_at,
            'user_updated_at' => $this->user_updated_at,
            'customer_waiting_since' => $this->customer_waiting_since,
        ], function ($value) {
            return $value !== null;
        });
    }
}