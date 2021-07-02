<?php
namespace TaskModule\TaskShipping\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $_questionFactory;

    public function __construct(\TaskModule\TaskShipping\Model\TmpQuoteFactory $questionFactory)
    {
        $this->_questionFactory = $questionFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        $data = [
            'id_quote'      => "1", 
            'price'     => "2.99",
        ];
        $question = $this->_questionFactory->create();
        $question->addData($data)->save();
    }
}
?>