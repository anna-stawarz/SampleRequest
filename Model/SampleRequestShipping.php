<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model;

use Infiright\SampleRequest\Api\Data\SampleRequestShippingInterface;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequestShipping as SampleRequestShippingResource;
use Magento\Framework\Model\AbstractModel;

class SampleRequestShipping extends AbstractModel implements SampleRequestShippingInterface
{
    protected function _construct(): void
    {
        $this->_init(SampleRequestShippingResource::class);
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

    public function getAddress1(): string
    {
       return $this->getData(self::ADDRESS_1);
    }

    public function setAddress1(string $address): void
    {
        $this->setData(self::ADDRESS_1, $address);
    }

    public function getAddress2(): string
    {
        return $this->getData(self::ADDRESS_2);
    }

    public function setAddress2(string $address): void
    {
        $this->setData(self::ADDRESS_2, $address);
    }

    public function getCountryCode(): string
    {
        return $this->getData(self::COUNTRY_CODE);
    }

    public function setCountryCode(string $code): void
    {
        $this->setData(self::COUNTRY_CODE, $code);
    }

    public function getStateOrProvince(): string
    {
        return $this->getData(self::STATE_OR_PROVINCE);
    }

    public function setStateOrProvince(string $value): void
    {
        $this->setData(self::STATE_OR_PROVINCE, $value);
    }

    public function getCity(): string
    {
        return $this->getData(self::CITY);
    }

    public function setCity(string $name): void
    {
        $this->setData(self::CITY, $name);
    }

    public function getZipCode(): string
    {
        return $this->getData(self::ZIP_CODE);
    }

    public function setZipCode(string $value): void
    {
        $this->setData(self::ZIP_CODE, $value);
    }

    public function getMethodOption(): string
    {
        return $this->getData(self::METHOD_OPTION);
    }

    public function setMethodOption(string $option): void
    {
        $this->setData(self::METHOD_OPTION, $option);
    }

    public function getAdditionalInfo(): string
    {
        return $this->getData(self::ADDITIONAL_INFO);
    }

    public function setAdditionalInfo(string $info): void
    {
        $this->setData(self::ADDITIONAL_INFO, $info);
    }

    public function getAccountOption(): string
    {
        return $this->getData(self::ACCOUNT_OPTION);
    }

    public function setAccountOption(string $value): void
    {
        $this->setData(self::ACCOUNT_OPTION, $value);
    }

    public function getAccountNo(): string
    {
        return $this->getData(self::ACCOUNT_NO);
    }

    public function setAccountNo(string $value): void
    {
        $this->setData(self::ACCOUNT_NO, $value);
    }

    public function getAccountZip(): string
    {
        return $this->getData(self::ACCOUNT_ZIP);
    }

    public function setAccountZip(string $value): void
    {
        $this->setData(self::ACCOUNT_ZIP, $value);
    }
}
