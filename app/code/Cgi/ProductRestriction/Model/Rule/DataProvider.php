<?php
/**
 * *
 *  * Copyright © 2020 CGI. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    CGI <info.de@cgi.com>
 *  * @copyright 2020 CGI
 *  * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 */
namespace Cgi\ProductRestriction\Model\Rule;

use Cgi\ProductRestriction\Model\ResourceModel\Rule\Collection;
use Cgi\ProductRestriction\Model\ResourceModel\Rule\CollectionFactory;
use Magento\CatalogRule\Model\Rule;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $ProductRestrictionCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $ProductRestrictionCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $ProductRestrictionCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var Rule $rule */
        foreach ($items as $rule) {
            $rule->load($rule->getId());
            $this->loadedData[$rule->getId()] = $rule->getData();
        }
        $data = $this->dataPersistor->get('productrestriction_rule');
        if (!empty($data)) {
            $rule = $this->collection->getNewEmptyItem();
            $rule->setData($data);
            $this->loadedData[$rule->getId()] = $rule->getData();
            $this->dataPersistor->clear('productrestriction_rule');
        }

        return $this->loadedData;
    }
}