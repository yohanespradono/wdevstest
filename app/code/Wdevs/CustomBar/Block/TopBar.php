<?php

namespace Wdevs\CustomBar\Block;

class TopBar extends \Magento\Framework\View\Element\Template
{
    /**
     * @return bool
     */
    public function isShown()
    {
        if ($this->_scopeConfig->getValue(
            'custom_topbar/general/active',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        )) {
            return true;
        }
        return false;
    }
}
