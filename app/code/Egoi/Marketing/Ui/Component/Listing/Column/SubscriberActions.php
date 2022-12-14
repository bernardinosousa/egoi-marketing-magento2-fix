<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Egoi\Marketing\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class BlockActions
 */
class SubscriberActions extends Column
{

    /**
     * Url path
     */
    const URL_PATH_EDIT = 'egoi/subscriber/edit';

    const URL_PATH_DELETE = 'egoi/subscriber/delete';

    const URL_PATH_CUSTOMER = 'customer/index/edit';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * Constructor
     *
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface       $urlBuilder,
        array              $components = [],
        array              $data = []
    )
    {

        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $items
     *
     * @return array
     */
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['subscriber_id'])) {
                    $data = [
                        'edit'     => [
                            'href'  => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'id' => $item['subscriber_id'],
                                ]
                            ),
                            'label' => __('Edit'),
                        ],
                        'customer' => [
                            'href'  => $this->urlBuilder->getUrl(
                                static::URL_PATH_CUSTOMER,
                                [
                                    'id' => $item['customer_id'],
                                ]
                            ),
                            'label' => __('Customer'),
                        ],
                        'delete'   => [
                            'href'    => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'id' => $item['subscriber_id'],
                                ]
                            ),
                            'label'   => __('Delete'),
                            'confirm' => [
                                'title'   => __('Delete "${ $.$data.email }"'),
                                'message' => __(
                                    'Are you sure you wan\'t to delete the subscriber "${ $.$data.email }"?'
                                ),
                            ],
                        ],
                    ];

                    if ($item['customer_id'] == 0) {
                        unset($data['customer']);
                    }

                    $item[$this->getData('name')] = $data;
                }
            }
        }

        return $dataSource;
    }
}
