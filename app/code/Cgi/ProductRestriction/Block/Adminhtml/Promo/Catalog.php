<?php
declare(strict_types=1);

namespace Cgi\ProductRestriction\Block\Adminhtml\Promo;

class Catalog extends \Magento\Backend\Block\Widget\Grid\Container
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_blockGroup = 'Cgi_ProductRestriction';
        $this->_controller = 'adminhtml_promo_catalog';
        $this->_headerText = __('Product Restriction');
        $this->_addButtonLabel = __('Add New Rule');
        parent::_construct();

        $this->buttonList->add(
            'apply_rules',
            [
                'label' => __('Apply Rules'),
                'onclick' => "location.href='" . $this->getUrl('catalog_productrestriction/promo/applyRules') . "'",
                'class' => 'apply'
            ]
        );
    }
}

