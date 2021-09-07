<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Api\Data;

interface SampleRequestShippingInterface
{
    public const TABLE_NAME = 'sample_request_shipping';

    public const ID = 'shipping_id';
    public const ADDRESS_1 = 'address_1';
    public const ADDRESS_2 = 'address_2';
    public const COUNTRY_CODE = 'country_code';
    public const STATE_OR_PROVINCE = 'state_or_province';
    public const CITY = 'city';
    public const ZIP_CODE = 'zip_code';
    public const METHOD_OPTION = 'method_option';
    public const ADDITIONAL_INFO = 'additional_info';
    public const ACCOUNT_OPTION = 'account_option';
    public const ACCOUNT_NO = 'account_no';
    public const ACCOUNT_ZIP = 'account_zip';

    public function getId(): ?int;

    public function setId($id): void;

    public function getAddress1(): string;

    public function setAddress1(string $address): void;

    public function getAddress2(): string;

    public function setAddress2(string $address): void;

    public function getCountryCode(): string;

    public function setCountryCode(string $code): void;

    public function getStateOrProvince(): string;

    public function setStateOrProvince(string $value): void;

    public function getCity(): string;

    public function setCity(string $name): void;

    public function getZipCode(): string;

    public function setZipCode(string $value): void;

    public function getMethodOption(): string;

    public function setMethodOption(string $option): void;

    public function getAdditionalInfo(): string;

    public function setAdditionalInfo(string $info): void;

    public function getAccountOption(): string;

    public function setAccountOption(string $value): void;

    public function getAccountNo(): string;

    public function setAccountNo(string $value): void;

    public function getAccountZip(): string;

    public function setAccountZip(string $value): void;
}
