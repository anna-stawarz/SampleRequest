<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model;

use Infiright\SampleRequest\Api\Data\SampleRequestContactInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestQuoteInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestShippingInterface;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequest as SampleRequestResource;
use Magento\Framework\Model\AbstractModel;

class SampleRequest extends AbstractModel implements SampleRequestInterface
{
    /**
     * @var SampleRequestContactInterface
     */
    protected $contact;

    /**
     * @var SampleRequestShippingInterface
     */
    protected $shipping;

    /**
     * @var SampleRequestQuoteInterface
     */
    protected $quote;

    protected function _construct(): void
    {
        $this->_init(SampleRequestResource::class);
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

    public function getContactId(): int
    {
        return (int)$this->getData(self::CONTACT_ID);
    }

    public function setContactId(int $contactId): void
    {
        $this->setData(self::CONTACT_ID, $contactId);
    }

    public function getShippingId(): int
    {
        return (int)$this->getData(self::SHIPPING_ID);
    }

    public function setShippingId(int $shippingId): void
    {
        $this->setData(self::SHIPPING_ID, $shippingId);
    }

    public function getQuoteId(): int
    {
        return (int)$this->getData(self::QUOTE_ID);
    }

    public function setQuoteId(int $quoteId): void
    {
        $this->setData(self::QUOTE_ID, $quoteId);
    }

    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setContact(SampleRequestContactInterface $contact): void
    {
        $this->contact = $contact;
    }

    public function setQuote(SampleRequestQuoteInterface $quote): void
    {
        $this->quote = $quote;
    }

    public function setShipping(SampleRequestShippingInterface $shipping): void
    {
        $this->shipping = $shipping;
    }

    public function beforeSave(): SampleRequest
    {
        if ($this->quote) {
            $this->setQuoteId($this->quote->getId());
        }

        if ($this->contact) {
            $this->setContactId($this->contact->getId());
        }

        if ($this->shipping) {
            $this->setShippingId($this->shipping->getId());
        }

        return parent::beforeSave();
    }
}
