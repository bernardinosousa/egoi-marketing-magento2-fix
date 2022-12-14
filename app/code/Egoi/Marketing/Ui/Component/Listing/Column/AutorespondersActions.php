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
class AutorespondersActions extends Column
{

    /**
     * Url path
     */
    const URL_PATH_EDIT = 'egoi/autoresponders/edit';

    const URL_PATH_DELETE = 'egoi/autoresponders/delete';

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
                if (isset($item['autoresponder_id'])) {
                    $item[$this->getData('name')] = [
                        'edit'   => [
                            'href'  => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'id' => $item['autoresponder_id'],
                                ]
                            ),
                            'label' => __('Edit'),
                        ],
                        'delete' => [
                            'href'    => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'id' => $item['autoresponder_id'],
                                ]
                            ),
                            'label'   => __('Delete'),
                            'confirm' => [
                                'title'   => __('Delete "${ $.$data.name }"'),
                                'message' => __(
                                    'Are you sure you wan\'t to delete the "${ $.$data.name }" autoresponder?'
                                ),
                            ],
                        ],
                    ];
                }
            }
        }

        return $dataSource;
    }
}
