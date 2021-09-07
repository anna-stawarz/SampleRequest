<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model;

use Infiright\SampleRequest\Api\Data\SampleRequestQuoteInterface;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequestQuote as SampleRequestQuoteResource;
use Magento\Framework\Model\AbstractModel;

class SampleRequestQuote extends AbstractModel implements SampleRequestQuoteInterface
{
    protected function _construct(): void
    {
        $this->_init(SampleRequestQuoteResource::class);
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

    public function getProjectReference(): string
    {
        return $this->getData(self::PROJECT_REFERENCE);
    }

    public function setProjectReference(string $value): void
    {
        $this->setData(self::PROJECT_REFERENCE, $value);
    }

    public function getInstallationSize(): string
    {
        return $this->getData(self::INSTALLATION_SIZE);
    }

    public function setInstallationSize(string $size): void
    {
        $this->setData(self::INSTALLATION_SIZE, $size);
    }

    public function getProjectLocation(): string
    {
        return $this->getData(self::PROJECT_LOCATION);
    }

    public function setProjectLocation(string $value): void
    {
        $this->setData(self::PROJECT_SCHEDULE, $value);
    }

    public function getProjectSchedule(): string
    {
        return $this->getData(self::PROJECT_SCHEDULE);
    }

    public function setProjectSchedule(string $value): void
    {
        $this->setData(self::PROJECT_SCHEDULE, $value);
    }

    public function getMessage(): string
    {
        return $this->getData(self::MESSAGE);
    }

    public function setMessage(string $message): void
    {
        $this->setData(self::MESSAGE, $message);
    }
}
