<?php

namespace Egoi\Marketing\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Class ChangeStatus
 *
 * @package Egoi\Marketing\Observer
 */
class ChangeStatus implements ObserverInterface
{

    /**
     * @var \Egoi\Marketing\Model\AutorespondersFactory
     */
    protected $_autorespondersFactory;

    /**
     * ChangeStatus constructor.
     *
     * @param \Egoi\Marketing\Model\AutorespondersFactory $autorespondersFactory
     */
    function __construct(
        \Egoi\Marketing\Model\AutorespondersFactory $autorespondersFactory
    )
    {

        $this->_autorespondersFactory = $autorespondersFactory;
    }

    /**
     * @param \Magento\Framework\Event\Observer $event
     */
    public function execute(\Magento\Framework\Event\Observer $event)
    {

        try {
            $this->_autorespondersFactory->create()->changeStatus($event);
        } catch (\Exception $e) {

        }
    }

}
