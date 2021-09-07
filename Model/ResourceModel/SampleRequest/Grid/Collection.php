<?php

namespace Infiright\SampleRequest\Model\ResourceModel\SampleRequest\Grid;

use Infiright\SampleRequest\Api\Data\SampleRequestContactInterface;
use Magento\Framework\DB\Select;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    public function _construct()
    {
        parent::_construct();
        $this->_map['fields']['contact_name'] = 'contact.name';
        $this->_map['fields']['contact_email'] = 'contact.email';
        $this->_map['fields']['contact_company'] = 'contact.company';
    }

    public function _initSelect(): Select
    {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
            ['contact' => SampleRequestContactInterface::TABLE_NAME],
            'contact.contact_id = main_table.contact_id',
            [
                'name AS contact_name',
                'email AS contact_email',
                'company AS contact_company',
            ]
        );

        return $this->getSelect();
    }
}
