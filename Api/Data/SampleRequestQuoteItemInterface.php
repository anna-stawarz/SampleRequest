<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Api\Data;

interface SampleRequestQuoteItemInterface
{
    public const TABLE_NAME = 'sample_request_quote_item';

    public const ID = 'quote_item_id';
    public const QUOTE_ID = 'parent_quote_id';
    public const ITEM_REQUEST = 'item_request';
    public const ITEM_NOTE = 'item_note';

    public function getId(): ?int;

    public function setId($id): void;

    public function getQuoteId(): int;

    public function setQuoteId(int $id): void;

    public function getItemRequest(): string;

    public function setItemRequest(string $name): void;

    public function getItemNote(): string;

    public function setItemNote(string $note): void;
}
