<?php
namespace TaskModule\TaskShipping\Controller\Price;

class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

     /**
     * @param \Magento\Framework\Serialize\Serializer\Json
     */
    private $_json;

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
         \TaskModule\TaskShipping\Model\TmpQuoteFactory $tmpQuoteFactory,
         
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
        $data = $this->getRequest()->getContent();
        $response = $this->_json->unserialize($data);

        $quote = $this->_tmpQuote->create();

        $quote->addData([
			"id_quote" => $response['quoteId'],
			"price" => $response['price']
			]);
        $quote->save();

        return var_dump($response);
    }
}