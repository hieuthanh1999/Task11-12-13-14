<?php
namespace TaskModule\TaskShipping\Model\ResourceModel;

class TmpQuote extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('aht_quote', 'id');
    }
}
