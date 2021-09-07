<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model;

use Infiright\SampleRequest\Api\Data\SampleRequestQuoteInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestQuoteItemInterface;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequestQuoteItem as SampleRequestQuoteItemResource;
use Magento\Framework\Model\AbstractModel;

class SampleRequestQuoteItem extends AbstractModel implements SampleRequestQuoteItemInterface
{
    protected $quote;

    protected function _construct(): void
    {
        $this->_init(SampleRequestQuoteItemResource::class);
    }

    public function getId(): ?int
    {
        $id = $this->getData(self::ID);
        if (null !== $id) {
            $id = (int) $id;
        }

        return $id;
    }

    public function setId($id): void
    {
        $this->setData(self::ID, $id);
    }

    public function getQuoteId(): int
    {
        return $this->getData(self::QUOTE_ID);
    }

    public function setQuoteId(int $id): void
    {
        $this->setData(self::QUOTE_ID, $id);
    }

    public function getItemRequest(): string
    {
        return $this->getData(self::ITEM_REQUEST);
    }

    public function setItemRequest(string $name): void
    {
        $this->setData(self::ITEM_REQUEST, $name);
    }

    public function getItemNote(): string
    {
        return $this->getData(self::ITEM_NOTE);
    }

    public function setItemNote(string $note): void
    {
        $this->setData(self::ITEM_NOTE, $note);
    }

    public function setQuote(SampleRequestQuoteInterface $quote) : void
    {
        $this->quote = $quote;
    }

    public function beforeSave(): SampleRequestQuoteItem
    {
        if ($this->quote) {
            $this->setQuoteId($this->quote->getId());
        }

        return parent::beforeSave();
    }
}
