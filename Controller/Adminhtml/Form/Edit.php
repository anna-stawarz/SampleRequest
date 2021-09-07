<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Controller\Adminhtml\Form;

use Infiright\SampleRequest\Api\Data\SampleRequestInterface;
use Infiright\SampleRequest\Api\SampleRequestRepositoryInterface;
use Infiright\SampleRequest\Model\Adminhtml\Route;
use Infiright\SampleRequest\Registry\CurrentSampleRequest;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Infiright_SampleRequest::manage';

    /**
     * @var CurrentSampleRequest
     */
    private $currentSampleRequest;

    /**
     * @var SampleRequestRepositoryInterface
     */
    private $sampleRequestRepository;

    public function __construct(
        Context $context,
        SampleRequestRepositoryInterface $sampleRequestRepository,
        CurrentSampleRequest $currentSampleRequest
    ) {
        parent::__construct($context);
        $this->currentSampleRequest = $currentSampleRequest;
        $this->sampleRequestRepository = $sampleRequestRepository;
    }

    /**
     * @throws \Exception
     */
    private function initSampleRequestModel(): SampleRequestInterface
    {
        $sampleRequestId = (int)$this->getRequest()->getParam('id');
        try {
            $model = $this->sampleRequestRepository->getById($sampleRequestId);
            $this->currentSampleRequest->set($model);
        } catch (NoSuchEntityException $e) {
            throw new \Exception('This sample request no longer exists.');
        }

        return $this->currentSampleRequest->get();
    }

    /**
     * @return Page|Redirect
     */
    public function execute()
    {

        try {
            $id = $this->getRequest()->getParam('id');
            if (!$id) {
                throw new \InvalidArgumentException('Missing id');
            }

            $this->initSampleRequestModel();

            /** @var  Page $resultPage */
            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $resultPage->getConfig()->getTitle()->prepend(__('Sample Request'));

            return $resultPage;
        } catch (\Throwable $e) {
            $resultRedirect = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(__($e->getMessage()));

            return $resultRedirect->setPath(Route::ADMIN_SAMPLE_REQUEST_INDEX_GRID);
        }
    }
}
