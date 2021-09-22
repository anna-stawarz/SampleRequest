<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\ResourceModel;

use Infiright\SampleRequest\Api\Data\SampleRequestQuoteItemInterface;
use Magento\Framework\Model\ResourceModel\Db;

class SampleRequestQuoteItem extends Db\AbstractDb
{
    protected function _construct(): void
    {
        $this->_init(SampleRequestQuoteItemInterface::TABLE_NAME, SampleRequestQuoteItemInterface::ID);
    }
}
