<?php

namespace Infiright\SampleRequest\Model\ResourceModel;

use Infiright\SampleRequest\Api\Data\SampleRequestQuoteInterface;
use Magento\Framework\Model\ResourceModel\Db;

class SampleRequestQuote extends Db\AbstractDb
{
    protected function _construct(): void
    {
        $this->_init(SampleRequestQuoteInterface::TABLE_NAME, SampleRequestQuoteInterface::ID);
    }
}
