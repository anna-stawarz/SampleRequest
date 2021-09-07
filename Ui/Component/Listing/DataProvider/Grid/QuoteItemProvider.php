<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Ui\Component\Listing\DataProvider\Grid;

use Infiright\SampleRequest\Model\ResourceModel\SampleRequestQuoteItem\Grid\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class QuoteItemProvider extends AbstractDataProvider
{
    /**
     * @var RequestInterface $request ,
     */
    private $request;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->request = $request;
    }

    public function getData(): array
    {
        $collection = $this->getCollection();
        $data['items'] = [];
        if ($this->request->getParam('parent_id')) {
            $collection->addFieldToFilter('quote_id', $this->request->getParam('parent_id'));
            $data = $collection->toArray();
        }

        return $data;
    }
}
