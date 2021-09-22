<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\ResourceModel;

use Infiright\SampleRequest\Api\Data\SampleRequestShippingInterface;
use Magento\Framework\Model\ResourceModel\Db;

class SampleRequestShipping extends Db\AbstractDb
{
    protected function _construct(): void
    {
        $this->_init(SampleRequestShippingInterface::TABLE_NAME, SampleRequestShippingInterface::ID);
    }
}
