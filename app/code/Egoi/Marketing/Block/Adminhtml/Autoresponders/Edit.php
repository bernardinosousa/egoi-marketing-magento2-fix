<?php

/**
 * E-goi.com
 *
 * @title      E-Goi Multi-channel Marketing
 * @package    E-Goi
 * @copyright  Copyright (c) 2012-2018 E-Goi - http://e-goi.com
 */

namespace Egoi\Marketing\Block\Adminhtml\Autoresponders;

/**
 * Class Edit
 *
 * @package Egoi\Marketing\Block\Adminhtml\Autoresponders
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry           $registry
     * @param array                                 $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry           $registry,
        array                                 $data = []
    )
    {

        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {

        $this->_objectId = 'id';
        $this->_blockGroup = 'Egoi_Marketing';
        $this->_controller = 'adminhtml_autoresponders';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Autoresponder'));
        $this->buttonList->update('delete', 'label', __('Delete Autoresponder'));

        $this->buttonList->add(
            'save_and_continue',
            [
                'label'          => __('Save and Continue Edit'),
                'class'          => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                    ],
                ],
            ],
            10
        );

    }

    /**
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {

        return $this->getUrl('*/*/save', ['_current' => true, 'back' => 'edit', 'tab' => '{{tab_id}}']);
    }

    /**
     * Get edit form container header text
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {

        if ($this->_coreRegistry->registry('egoi_autoresponder')->getId()) {
            return __(
                "Edit Autoresponder '%1'",
                $this->escapeHtml($this->_coreRegistry->registry('egoi_autoresponder')->getName())
            );
        } else {
            return __('New Autoresponder');
        }
    }
}
