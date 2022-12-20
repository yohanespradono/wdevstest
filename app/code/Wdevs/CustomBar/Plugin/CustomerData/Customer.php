<?php

namespace Wdevs\CustomBar\Plugin\CustomerData;

use Magento\Customer\Helper\Session\CurrentCustomer;

class Customer
{
    /**
     * @var CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @var \Magento\Customer\Api\GroupRepositoryInterface
     */
    protected $groupRepository;

    /**
     * @param CurrentCustomer $currentCustomer
     * @param \Magento\Customer\Api\GroupRepositoryInterface $groupRepository
     */
    public function __construct(
        CurrentCustomer $currentCustomer,
        \Magento\Customer\Api\GroupRepositoryInterface $groupRepository
    ) {
        $this->currentCustomer = $currentCustomer;
        $this->groupRepository = $groupRepository;
    }

    /**
     * @param \Magento\Customer\CustomerData\Customer $subject
     * @param array $result
     * @return array
     */
    public function afterGetSectionData(\Magento\Customer\CustomerData\Customer $subject, $result)
    {
        if (!$this->currentCustomer->getCustomerId()) {
            return [];
        }

        $customer = $this->currentCustomer->getCustomer();
        $groupId = $customer->getGroupId();
        try {
            $group = $this->groupRepository->getById($groupId);
        } catch (\Exception $e) {
            $group = null;
        }
        $result['group'] = $group->getCode();
        return $result;
    }
}
