<?php

namespace Nigel\FreescoutWebhookParser\Interfaces;

interface WebhookDataInterface
{
    public function getTicketId(): ?int;
    public function getTicketNumber(): ?int;
    public function getTicketSubject(): ?string;
    public function getTicketStatus(): ?string;
    public function getTicketType(): ?string;
    public function getTicketCreatedAt(): ?string;
    
    public function getCustomerId(): ?int;
    public function getCustomerName(): ?string;
    public function getCustomerEmail(): ?string;
    
    public function getThreadId(): ?int;
    public function getThreadBody(): ?string;
    public function getThreadType(): ?string;
    
    public function getCustomFields(): array;
    
    public function getRawData(): array;
} 