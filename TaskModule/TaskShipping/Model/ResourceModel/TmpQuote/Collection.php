<?php
namespace TaskModule\TaskShipping\ResourceModel\TmpQuote;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'aht_quote_quote_collection';
    protected $_eventObject = 'quote_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('TaskModule\TaskShipping\Model\TmpQuote', 'TaskModule\TaskShipping\Model\ResourceModel\TmpQuote');
    }
}