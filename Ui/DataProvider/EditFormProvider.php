<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Ui\DataProvider;

use Infiright\SampleRequest\Api\Data\SampleRequestContactInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestQuoteInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestShippingInterface;
use Infiright\SampleRequest\Api\SampleRequestContactRepositoryInterface;
use Infiright\SampleRequest\Api\SampleRequestQuoteRepositoryInterface;
use Infiright\SampleRequest\Api\SampleRequestShippingRepositoryInterface;
use Infiright\SampleRequest\Model\ResourceModel\SampleRequest\CollectionFactory;
use Infiright\SampleRequest\Registry\CurrentSampleRequest;
use Magento\Framework\Api\Filter;
use Magento\Ui\DataProvider\AbstractDataProvider;

class EditFormProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var SampleRequestContactRepositoryInterface
     */
    protected $contactRepository;

    /**
     * @var SampleRequestQuoteRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * @var SampleRequestShippingRepositoryInterface
     */
    protected $shippingRepository;

    /**
     * @var CurrentSampleRequest
     */
    protected $currentSampleRequest;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CurrentSampleRequest $currentSampleRequest,
        SampleRequestContactRepositoryInterface $contactRepository,
        SampleRequestQuoteRepositoryInterface $quoteRepository,
        SampleRequestShippingRepositoryInterface $shippingRepository,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->currentSampleRequest = $currentSampleRequest;
        $this->contactRepository = $contactRepository;
        $this->quoteRepository = $quoteRepository;
        $this->shippingRepository = $shippingRepository;
    }

    public function getData(): array
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        /** @var SampleRequestInterface $sampleRequest */
        $sampleRequest = $this->currentSampleRequest->get();

        $sampleRequestId = $sampleRequest->getId();
        $this->loadedData[] = $sampleRequestId;

        $contactId = $sampleRequest->getContactId();
        $quoteId = $sampleRequest->getQuoteId();
        $shippingId = $sampleRequest->getShippingId();

        $this->loadedData[$sampleRequestId]['sample_request'][SampleRequestInterface::ID] = $sampleRequestId;
        $this->loadedData[$sampleRequestId]['sample_request'][SampleRequestInterface::CONTACT_ID] = $contactId;
        $this->loadedData[$sampleRequestId]['sample_request'][SampleRequestInterface::QUOTE_ID] = $quoteId;
        $this->loadedData[$sampleRequestId]['sample_request'][SampleRequestInterface::SHIPPING_ID] = $shippingId;

        /** @var SampleRequestContactInterface $contact */
        $contact = $this->contactRepository->getById($contactId);
        $this->loadedData[$sampleRequestId]['contact'] = $contact->getData();

        /** @var SampleRequestQuoteInterface $quote */
        $quote = $this->quoteRepository->getById($quoteId);
        $this->loadedData[$sampleRequestId]['quote'] = $quote->getData();

        /** @var SampleRequestShippingInterface $shipping */
        $shipping = $this->shippingRepository->getById($shippingId);
        $this->loadedData[$sampleRequestId]['shipping'] = $shipping->getData();

        return $this->loadedData;
    }

    public function addFilter(Filter $filter): void
    {
    }

    public function getMeta(): array
    {
        $meta = parent::getMeta();
        $meta['sample_request']['arguments']['data']['config']['visible'] = 0;

        return $meta;
    }
}
