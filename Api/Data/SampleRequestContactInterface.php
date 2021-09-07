<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Api\Data;

interface SampleRequestContactInterface
{
    public const TABLE_NAME = 'sample_request_contact';

    public const ID = 'contact_id';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const COMPANY = 'company';
    public const PHONE_NUMBER = 'phone_number';
    public const PREFERRED_CALLING_HOURS = 'preferred_calling_hours';

    public function getId(): ?int;

    public function setId($id): void;

    public function getName(): string;

    public function setName(string $name): void;

    public function getEmail(): string;

    public function setEmail(string $email): void;

    public function getCompany(): string;

    public function setCompany(string $companyName): void;

    public function getPhoneNumber(): string;

    public function setPhoneNumber(string $number): void;

    public function getPreferredCallingHours(): string;

    public function setPreferredCallingHours(string $value): void;
}
