<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Controller\Adminhtml\Form;

use Infiright\SampleRequest\Api\RequestData\SampleRequestDataInterface;
use Infiright\SampleRequest\Api\RequestData\SampleRequestDataInterfaceFactory;
use Infiright\SampleRequest\Api\SampleRequestRepositoryInterface;
use Infiright\SampleRequest\Model\Adminhtml\Route;
use Infiright\SampleRequest\Model\Service\SampleRequestManagerInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\NoSuchEntityException;

class Save extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Infiright_SampleRequest::manage';

    /**
     * @var SampleRequestRepositoryInterface
     */
    protected $sampleRequestRepository;

    /**
     * @var SampleRequestDataInterfaceFactory
     */
    protected $sampleRequestDataFactory;

    /**
     * @var SampleRequestManagerInterface
     */
    protected $sampleRequestManager;

    public function __construct(
        Context $context,
        SampleRequestRepositoryInterface $sampleRequestRepository,
        SampleRequestDataInterfaceFactory $sampleRequestDataFactory,
        SampleRequestManagerInterface $sampleRequestManager
    ) {
        parent::__construct($context);
        $this->sampleRequestRepository = $sampleRequestRepository;
        $this->sampleRequestDataFactory = $sampleRequestDataFactory;
        $this->sampleRequestManager = $sampleRequestManager;
    }

    public function execute(): Redirect
    {
        $sampleRequestId = (int)$this->getRequest()->getParam('id');

        try {
            if ($sampleRequestId) {
                $sampleRequest = $this->sampleRequestRepository->getById($sampleRequestId);
            }

            /** @var SampleRequestDataInterface $saveData */
            $saveData = $this->sampleRequestDataFactory->create();

            $this->sampleRequestManager->saveSampleRequest($saveData);
            $returnToEditPage = (bool)$this->getRequest()->getParam('back', false);
            $this->messageManager->addSuccessMessage(__('You saved the Sample Request.'));
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addExceptionMessage(
                $e,
                __('Something went wrong while saving the Sample Request.')
            );

            $sampleRequestId = false;
            $returnToEditPage = false;
            $this->_getSession()->setSampleRequestFormData($this->getRequest()->getPostValue());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage(
                $e,
                __('Something went wrong while saving the Sample Request.')
            );

            $returnToEditPage = true;
            $this->_getSession()->setSampleRequestFormData($this->getRequest()->getPostValue());
        } finally {
            $resultRedirect = $this->resultRedirectFactory->create();

            if ($returnToEditPage && $sampleRequestId) {
                $resultRedirect->setPath(Route::ADMIN_SAMPLE_REQUEST_FORM_EDIT);
            } else {
                $resultRedirect->setPath(Route::ADMIN_SAMPLE_REQUEST_INDEX_GRID);
            }
        }

        return $resultRedirect;
    }
}
