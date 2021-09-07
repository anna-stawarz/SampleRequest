<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Api\Data;

interface SampleRequestQuoteInterface
{
    public const TABLE_NAME = 'sample_request_quote';

    public const ID = 'quote_id';
    public const PROJECT_REFERENCE = 'project_reference';
    public const INSTALLATION_SIZE = 'installation_size';
    public const PROJECT_LOCATION = 'project_location';
    public const PROJECT_SCHEDULE = 'project_schedule';
    public const MESSAGE = 'message';

    public function getId(): ?int;

    public function setId($id): void;

    public function getProjectReference(): string;

    public function setProjectReference(string $value): void;

    public function getInstallationSize(): string;

    public function setInstallationSize(string $size): void;

    public function getProjectLocation(): string;

    public function setProjectLocation(string $value): void;

    public function getProjectSchedule(): string;

    public function setProjectSchedule(string $value): void;

    public function getMessage(): string;

    public function setMessage(string $message): void;

}
