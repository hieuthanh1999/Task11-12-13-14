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

    protected $id;
    protected $id_quote;
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
        $data = $this->getRequest()->getContent();
        // print_r($data);
        // die;
        $response = $this->_json->unserialize($data);
        $quoteId  = $response['quoteId'];
        $quote   = $this->_tmpQuote->create();

        $dataQuote = $quote->getCollection()->addFieldToFilter('id_quote', $quoteId);
            foreach ($dataQuote as $key => $item) {
                    $this->id_quote =$item['id_quote'];
                    $this->id =$item['id'];
            }
            if($this->id_quote){
                $quote = $quote->load($this->id);
                $quote->setPrice($response['price']);
                $quote->save(); 
                echo "update";       
            }
            else{
                $quote->setData([
                    "id_quote"  => $quoteId,
                    "price"     => $response['price']
                    ]);
                $quote->save();
                echo "create"; 
            }
        //var_dump($response);
        $resultJson = $this->resultJsonFactory->create();
        return  $resultJson->setData('response', $response);
        //return var_dump($response);
    }
}