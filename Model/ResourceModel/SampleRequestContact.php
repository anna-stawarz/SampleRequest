<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\ResourceModel;

use Infiright\SampleRequest\Api\Data\SampleRequestContactInterface;
use Magento\Framework\Model\ResourceModel\Db;

class SampleRequestContact extends Db\AbstractDb
{
    protected function _construct(): void
    {
        $this->_init(SampleRequestContactInterface::TABLE_NAME, SampleRequestContactInterface::ID);
    }
}
