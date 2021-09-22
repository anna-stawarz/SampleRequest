<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\ResourceModel;

use Infiright\SampleRequest\Api\Data\SampleRequestInterface;
use Magento\Framework\Model\ResourceModel\Db;

class SampleRequest extends Db\AbstractDb
{
    protected function _construct(): void
    {
        $this->_init(SampleRequestInterface::TABLE_NAME, SampleRequestInterface::ID);
    }
}
