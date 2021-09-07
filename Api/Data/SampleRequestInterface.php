<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Api\Data;

interface SampleRequestInterface
{
    public const TABLE_NAME = 'sample_request';

    public const ID = 'sample_request_id';
    public const CONTACT_ID = 'parent_contact_id';
    public const SHIPPING_ID = 'parent_shipping_id';
    public const QUOTE_ID = 'parent_quote_id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    public function getId(): ?int;

    public function setId($id): void;

    public function getContactId(): int;

    public function setContactId(int $contactId): void;

    public function getShippingId(): int;

    public function setShippingId(int $shippingId): void;

    public function getQuoteId(): int;

    public function setQuoteId(int $quoteId): void;

    public function getCreatedAt(): string;

    public function getUpdatedAt(): string;

    public function setContact(SampleRequestContactInterface $contact): void;

    public function setQuote(SampleRequestQuoteInterface $quote): void;

    public function setShipping(SampleRequestShippingInterface $shipping): void;
}
