<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\Service;

use Infiright\SampleRequest\Api\Data\SampleRequestInterface;
use Infiright\SampleRequest\Api\RequestData\SampleRequestDataInterface;
use Magento\Framework\DB\TransactionFactory;

class SampleRequestManager implements SampleRequestManagerInterface
{
    protected $transactionFactory;

    public function __construct(
        TransactionFactory $transactionFactory
    ) {
        $this->transactionFactory = $transactionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function saveSampleRequest(SampleRequestDataInterface $sampleRequestData): SampleRequestInterface
    {
        $transaction = $this->transactionFactory->create();

        $sampleRequest = $sampleRequestData->getSampleRequest();
        $contact = $sampleRequestData->getContact();
        $shipping = $sampleRequestData->getShipping();
        $quote = $sampleRequestData->getQuote();
        $quoteItems = $sampleRequestData->getQuoteItems();

        $transaction->addObject($contact);
        $transaction->addObject($quote);
        $transaction->addObject($shipping);

        foreach ($quoteItems as $quoteItem) {
            $quoteItem->setQuote($quote);
            $transaction->addObject($quoteItem);
        }

        $sampleRequest->setDataChanges(true);
        $sampleRequest->setContact($contact);
        $sampleRequest->setShipping($shipping);
        $sampleRequest->setQuote($quote);

        $transaction->addObject($sampleRequest);
        $transaction->save();

        return $sampleRequest;
    }
}
