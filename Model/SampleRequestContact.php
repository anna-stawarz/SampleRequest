<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model;

use Infiright\SampleRequest\Api\Data\SampleRequestContactInterface;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequestContact as SampleRequestContactResource;
use Magento\Framework\Model\AbstractModel;

class SampleRequestContact extends AbstractModel implements SampleRequestContactInterface
{
    protected function _construct(): void
    {
        $this->_init(SampleRequestContactResource::class);
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

    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    public function setName(string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    public function getEmail(): string
    {
        return $this->getData(self::EMAIL);
    }

    public function setEmail(string $email): void
    {
        $this->setData(self::EMAIL, $email);
    }

    public function getCompany(): string
    {
        return $this->getData(self::COMPANY);
    }

    public function setCompany(string $companyName): void
    {
        $this->setData(self::COMPANY, $companyName);
    }

    public function getPhoneNumber(): string
    {
        return $this->getData(self::PHONE_NUMBER);
    }

    public function setPhoneNumber(string $number): void
    {
        $this->setData(self::PHONE_NUMBER, $number);
    }

    public function getPreferredCallingHours(): string
    {
        return $this->getData(self::PREFERRED_CALLING_HOURS);
    }

    public function setPreferredCallingHours(string $value): void
    {
        $this->setData(self::PREFERRED_CALLING_HOURS, $value);
    }
}
