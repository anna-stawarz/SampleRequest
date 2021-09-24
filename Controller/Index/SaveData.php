<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Controller\Index;

use Infiright\SampleRequest\Api\RequestData\SampleRequestDataInterface;
use Infiright\SampleRequest\Api\RequestData\SampleRequestDataInterfaceFactory;
use Infiright\SampleRequest\Model\Service\SampleRequestManagerInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\Json  as ResultJson;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

class SaveData extends Action implements ActionInterface, HttpPostActionInterface
{
    private const HTTP_OK = 200;
    private const HTTP_BAD_REQUEST = 400;
    private const HTTP_INTERNAL_ERROR = 500;

    /**
     * @var SampleRequestManagerInterface
     */
    protected $sampleRequestManager;

    /**
     * @var SampleRequestDataInterfaceFactory
     */
    protected $sampleRequestDataFactory;

    /**
     * @var ResultJson
     */
    protected $resultJson;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        Context $context,
        SampleRequestManagerInterface $sampleRequestManager,
        SampleRequestDataInterfaceFactory $sampleRequestDataFactory,
        JsonFactory $resultJsonFactory,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->sampleRequestManager = $sampleRequestManager;
        $this->sampleRequestDataFactory = $sampleRequestDataFactory;
        $this->resultJson = $resultJsonFactory->create();
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        try {
            $responseCode = self::HTTP_OK;
            /** @var SampleRequestDataInterface $saveDataModel */
            $saveDataModel = $this->sampleRequestDataFactory->create();
            $this->sampleRequestManager->saveSampleRequest($saveDataModel);

            $responseContent = [
                'errors' => false,
                'message' => __('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.'),
            ];
        } catch (LocalizedException $e) {
            $responseCode = self::HTTP_BAD_REQUEST;
            $responseContent = [
                'errors' => true,
                'message' => $e->getMessage(),
            ];
        } catch (\Throwable $e) {
            $responseCode = self::HTTP_INTERNAL_ERROR;
            $this->logger->critical($e);
            $responseContent = [
                'errors' => true,
                'message' => __('An error occurred while processing your form. Please try again later.'),
            ];
        }

        $this->resultJson->setHttpResponseCode($responseCode);
        $this->resultJson->setData($responseContent);

        return $this->resultJson;
    }
}
