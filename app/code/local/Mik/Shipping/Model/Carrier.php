<?php

/**
 * From free shipping model
 */
class Mik_Shipping_Model_Carrier
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{

    /**
     * Carrier's code
     *
     * @var string
     */
    protected $_code = 'mikshipping';

    /**
     * Whether this carrier has fixed rates calculation
     *
     * @var bool
     */
    protected $_isFixed = true;

    /**
     * FreeShipping Rates Collector
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        
        if (!$this->getConfigFlag('active')) {
            //return false;
        }

        $result = Mage::getModel('shipping/rate_result');
        $method = Mage::getModel('shipping/rate_result_method');

        $method->setCarrier($this->_code);
        $method->setCarrierTitle('Mik Carrier');

        $method->setMethod('fixed');
        $method->setMethodTitle('Fixed price 10');

        $method->setPrice('10.00');
        $method->setCost('10.00');

        $result->append($method);


        return $result;
    }

    /**
     * Allows free shipping when all product items have free shipping (promotions etc.)
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return void
     */
    protected function _updateFreeMethodQuote($request)
    {
        
    }

    /**
     * Get allowed shipping methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return array('fixed' => 'All for 10');
    }

}
