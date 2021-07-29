<?php
namespace TaskModule\TaskFAQ\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
    protected $_collectionFactory;
    protected $resourceConnection;
    private $_tmpQuote;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       \TaskModule\TaskShipping\Model\TmpQuoteFactory $tmpQuoteFactory,
       \Magento\Framework\App\ResourceConnection $resourceConnection
    )
    {
        $this->resourceConnection = $resourceConnection;
        $this->_pageFactory = $pageFactory;
        $this->_tmpQuote = $tmpQuoteFactory;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
       // $quote = $this->_tmpQuote->create()->getCollection()->load(7)->getData();
        // $quote2 = $quote1->getSelect('price');
        // $quote->setOrder('id','DESC');
        // $quote->setPageSize(1)->getData();
        
       // $this->_checkoutSession->setData('orderby', $response['name']);
        // echo "<pre>";
        // var_dump($quote);
        // echo "</pre>";
        $quote    = $this->_tmpQuote->create()->getCollection()->addFieldToFilter('id_quote', 18);
        // $qouteIdx = $quote
            foreach ($quote as $key => $item) {
              var_dump($item->getData());
            }
        die;
       // return $this->_pageFactory->create();
    }
}