<?php

namespace TaskModule\TaskAttributeOrder\Observer;

use Magento\Framework\Event\Observer;

class SaveCheckOut implements \Magento\Framework\Event\ObserverInterface
{

    protected $_checkoutSession;
    protected $_orderRepository;

    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\Order $orderRepository
    ) {
        $this->_checkoutSession = $checkoutSession;
        $this->_orderRepository = $orderRepository;
    }

    public function execute(Observer $observer)
    {

        $order = $observer->getEvent()->getOrder();
        $name = $this->_checkoutSession->getData('orderby');
        $order->setdata('order_by', $name);
        $order->save();
    }
}
