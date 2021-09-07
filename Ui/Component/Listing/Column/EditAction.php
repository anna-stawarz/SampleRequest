<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Ui\Component\Listing\Column;

use Infiright\SampleRequest\Api\Data\SampleRequestInterface;
use Infiright\SampleRequest\Model\Adminhtml\Route;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class EditAction extends Column
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface       $urlBuilder,
        array              $components = [],
        array              $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $urlEdit = $this->urlBuilder->getUrl(
                    Route::ADMIN_SAMPLE_REQUEST_FORM_EDIT,
                    [
                        'id' => $item[SampleRequestInterface::ID],
                    ]
                );

                $item[$this->getData('name')]['edit'] = [
                    'href' => $urlEdit,
                    'label' => __('Edit'),
                    'hidden' => false,
                ];
            }
        }

        return $dataSource;
    }
}
