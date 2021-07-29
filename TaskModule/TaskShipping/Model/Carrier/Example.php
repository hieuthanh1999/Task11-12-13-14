<?php
namespace TaskModule\TaskShipping\Model\Carrier;
 
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;
 
class Example extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{
    /**
     * @var string
     */
    protected $_code = 'example';
 
       /**
     * @param \Magento\Checkout\Model\Session
     */
    private $_tmpQuote;
    protected $resourceConnection;
    protected $_quote;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
     * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        \TaskModule\TaskShipping\Model\TmpQuoteFactory $tmpQuoteFactory,
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        \Magento\Checkout\Model\Cart $quoteCart,
        array $data = []
    ) {
        $this->_tmpQuote = $tmpQuoteFactory;
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->resourceConnection = $resourceConnection;
        $this->_quote = $quoteCart;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }
 
    /**
     * @return array
     */
    public function getAllowedMethods()
    {
        return ['example' => $this->getConfigData('name')];
    }
 

    public function getNewTmpQuote($quoteId){
        $query = 'SELECT price FROM aht_quote WHERE id_quote = ' .$quoteId ;
        $results = $this->resourceConnection->getConnection()->fetchAll($query);
        return $results;  
    }

    /**
     * @param RateRequest $request
     * @return bool|Result
     */
    public function collectRates(RateRequest $request)
    {

        if (!$this->getConfigFlag('active')) {
            return false;
        }
 
        /** @var \Magento\Shipping\Model\Rate\Result $result */
        $result = $this->_rateResultFactory->create();
 
        /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method */
        $method = $this->_rateMethodFactory->create();
 
        $method->setCarrier('example');
        $method->setCarrierTitle($this->getConfigData('title'));
 
        $method->setMethod('example');
        $method->setMethodTitle($this->getConfigData('name'));
        
        $quoteId = $this->_quote->getQuote()->getId();
        $test = $this->getNewTmpQuote($quoteId);
        // if($test)
        // {
            $method->setPrice($test[0]['price']);
            $method->setCost($test[0]['price']);
        // }
        // else{
        //     $method->setPrice('0');
        //     $method->setCost('0');
        // }
       

        $result->append($method);
 
        return $result;
    }
}