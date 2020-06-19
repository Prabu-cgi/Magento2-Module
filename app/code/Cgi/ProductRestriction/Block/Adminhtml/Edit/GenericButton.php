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
namespace Cgi\ProductRestriction\Block\Adminhtml\Edit;

use Cgi\ProductRestriction\Controller\Adminhtml\RegistryConstants;

/**
 * Class GenericButton
 * @package Cgi\ProductRestriction\Block\Adminhtml\Edit
 */
class GenericButton
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * GenericButton constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }

    /**
     * @return |null
     */
    public function getRuleId(){
        $catalogRule = $this->registry->registry(RegistryConstants::CURRENT_RULE_ID);
        return $catalogRule ? $catalogRule->getId() : null;
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function canRender($name)
    {
        return $name;
    }
}

