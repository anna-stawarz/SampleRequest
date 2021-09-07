<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model\Service;

use Infiright\SampleRequest\Api\Data\SampleRequestContactInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestQuoteInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestQuoteItemInterface;
use Infiright\SampleRequest\Api\Data\SampleRequestQuoteItemInterfaceFactory;
use Infiright\SampleRequest\Api\Data\SampleRequestShippingInterface;
use Infiright\SampleRequest\Api\RequestData\SampleRequestDataInterface;
use Magento\Framework\App\RequestContentInterface;
use Magento\Framework\Serialize\Serializer\Json;

class SampleRequestSaveData implements SampleRequestDataInterface
{
    /**
     * @var SampleRequestInterface
     */
    protected $sampleRequest;

    /**
     * @var SampleRequestContactInterface
     */
    protected $sampleRequestContact;

    /**
     * @var SampleRequestShippingInterface
     */
    protected $sampleRequestShipping;

    /**
     * @var SampleRequestQuoteInterface
     */
    protected $sampleRequestQuote;

    /**
     * @var SampleRequestQuoteItemInterface
     */
    protected $sampleRequestQuoteItemFactory;

    /**
     * @var array|SampleRequestQuoteItemInterface[]
     */
    protected $sampleRequestQuoteItems = [];

    /**
     * @var RequestContentInterface
     */
    protected $requestContent;

    /**
     * @var Json
     */
    protected $jsonSerializer;

    public function __construct(
        RequestContentInterface $requestContent,
        SampleRequestInterface $sampleRequest,
        SampleRequestContactInterface $sampleRequestContact,
        SampleRequestShippingInterface $sampleRequestShipping,
        SampleRequestQuoteInterface $sampleRequestQuote,
        SampleRequestQuoteItemInterfaceFactory $sampleRequestQuoteItemFactory,
        Json $jsonSerializer
    ) {
        $this->sampleRequest = $sampleRequest;
        $this->sampleRequestContact = $sampleRequestContact;
        $this->sampleRequestShipping = $sampleRequestShipping;
        $this->sampleRequestQuote = $sampleRequestQuote;
        $this->sampleRequestQuoteItemFactory = $sampleRequestQuoteItemFactory;
        $this->requestContent = $requestContent;
        $this->jsonSerializer = $jsonSerializer;

        $this->initData($this->requestContent->getContent());
    }

    protected function initData(string $content): void
    {
        $content = $this->jsonSerializer->unserialize($content);

        if (array_key_exists('sample_request',$content)) {
            $this->sampleRequest->setId((int)$content['sample_request'][SampleRequestInterface::ID]);
            $this->sampleRequest->setQuoteId((int)$content['sample_request'][SampleRequestInterface::QUOTE_ID]);
            $this->sampleRequest->setContactId((int)$content['sample_request'][SampleRequestInterface::CONTACT_ID]);
            $this->sampleRequest->setShippingId((int)$content['sample_request'][SampleRequestInterface::SHIPPING_ID]);
        }

        if (array_key_exists('contact',$content) && array_key_exists(SampleRequestContactInterface::ID, $content['contact'])) {
            $this->sampleRequestContact->setId((int)$content['contact'][SampleRequestContactInterface::ID]);
        }

        $this->sampleRequestContact->setName($content['contact'][SampleRequestContactInterface::NAME]);
        $this->sampleRequestContact->setEmail($content['contact'][SampleRequestContactInterface::EMAIL]);
        $this->sampleRequestContact->setCompany($content['contact'][SampleRequestContactInterface::COMPANY]);
        $this->sampleRequestContact->setPhoneNumber($content['contact'][SampleRequestContactInterface::PHONE_NUMBER]);
        $this->sampleRequestContact->setPreferredCallingHours($content['contact'][SampleRequestContactInterface::PREFERRED_CALLING_HOURS]);

        if (array_key_exists('shipping',$content) && array_key_exists(SampleRequestShippingInterface::ID, $content['shipping'])) {
            $this->sampleRequestShipping->setId((int)$content['shipping'][SampleRequestShippingInterface::ID]);
        }

        $this->sampleRequestShipping->setAddress1($content['shipping'][SampleRequestShippingInterface::ADDRESS_1]);
        $this->sampleRequestShipping->setAddress2($content['shipping'][SampleRequestShippingInterface::ADDRESS_2]);
        $this->sampleRequestShipping->setCountryCode($content['shipping'][SampleRequestShippingInterface::COUNTRY_CODE]);
        $this->sampleRequestShipping->setStateOrProvince($content['shipping'][SampleRequestShippingInterface::STATE_OR_PROVINCE]);
        $this->sampleRequestShipping->setCity($content['shipping'][SampleRequestShippingInterface::CITY]);
        $this->sampleRequestShipping->setZipCode($content['shipping'][SampleRequestShippingInterface::ZIP_CODE]);
        $this->sampleRequestShipping->setAccountOption($content['shipping'][SampleRequestShippingInterface::ACCOUNT_OPTION]);
        $this->sampleRequestShipping->setAccountNo($content['shipping'][SampleRequestShippingInterface::ACCOUNT_NO]);
        $this->sampleRequestShipping->setAccountZip($content['shipping'][SampleRequestShippingInterface::ACCOUNT_ZIP]);
        $this->sampleRequestShipping->setMethodOption($content['shipping'][SampleRequestShippingInterface::METHOD_OPTION]);
        $this->sampleRequestShipping->setAdditionalInfo($content['shipping'][SampleRequestShippingInterface::ADDITIONAL_INFO]);

        if (array_key_exists('quote',$content) && array_key_exists(SampleRequestShippingInterface::ID, $content['quote'])) {
            $this->sampleRequestQuote->setId((int)$content['quote'][SampleRequestQuoteInterface::ID]);;
        }

        $this->sampleRequestQuote->setProjectReference($content['quote'][SampleRequestQuoteInterface::PROJECT_REFERENCE]);
        $this->sampleRequestQuote->setInstallationSize($content['quote'][SampleRequestQuoteInterface::INSTALLATION_SIZE]);
        $this->sampleRequestQuote->setProjectLocation($content['quote'][SampleRequestQuoteInterface::PROJECT_LOCATION]);
        $this->sampleRequestQuote->setProjectSchedule($content['quote'][SampleRequestQuoteInterface::PROJECT_SCHEDULE]);
        $this->sampleRequestQuote->setMessage($content['quote'][SampleRequestQuoteInterface::MESSAGE]);

        if (array_key_exists('items', $content)) {
            $items = $content['items'];
            if (!empty($items)) {
                foreach ($items as $item) {
                    $name = $item['name'] ?? null;
                    $note = $item['note'] ?? null;
                    /** @var  SampleRequestQuoteItemInterface $quoteItem */
                    $quoteItem = $this->sampleRequestQuoteItemFactory->create();
                    $quoteItem->setItemRequest($name);
                    $quoteItem->setItemNote($note);
                    $this->sampleRequestQuoteItems[] = $quoteItem;
                }
            }
        }
    }

    public function getSampleRequest(): SampleRequestInterface
    {
        return $this->sampleRequest;
    }

    public function getContact(): SampleRequestContactInterface
    {
        return $this->sampleRequestContact;
    }

    public function getShipping(): SampleRequestShippingInterface
    {
        return  $this->sampleRequestShipping;
    }

    public function getQuote(): SampleRequestQuoteInterface
    {
        return $this->sampleRequestQuote;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuoteItems(): array
    {
       return $this->sampleRequestQuoteItems;
    }
}
