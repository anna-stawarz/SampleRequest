<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\ResourceModel\SampleRequestQuoteItem;

use Infiright\SampleRequest\Model\SampleRequestQuoteItem;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequestQuoteItem as SampleRequestQuoteItemResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _construct(): void
    {
        $this->_init(
            SampleRequestQuoteItem::class,
            SampleRequestQuoteItemResource::class
        );
    }
}
