<?php
namespace TaskModule\TaskShipping\Plugin;

class GetData
{   

        /**
     * Return configuration array
     *
     * @return array|mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function AfterGetConfig()
    { 
        $output['getPriceQuote'] = 2132132;
        return $output;
    }
}