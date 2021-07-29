<?php
namespace TaskModule\TaskShipping\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Checkout\Model\Session
     */
    private $_tmpQuote;


    protected $resultJsonFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Serialize\Serializer\Json $json,
         \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
         \TaskModule\TaskShipping\Model\TmpQuoteFactory $tmpQuoteFactory
    )
    {
        $this->_tmpQuote = $tmpQuoteFactory;
        $this->_json = $json;
        $this->_pageFactory = $pageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $quote = $this->_tmpQuote->create()->getCollection()->addFieldToFilter('id', 1);
        // $quote2 = $quote1->getSelect('price');
        // $quote->setOrder('id','DESC');
        // $quote->setPageSize(1)->getData();
        
       // $this->_checkoutSession->setData('orderby', $response['name']);
        echo "<pre>";
        var_dump($quote);
        echo "</pre>";
        die;
    }
}