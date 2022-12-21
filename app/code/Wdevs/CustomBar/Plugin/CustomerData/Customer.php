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
        try {
            $customer = $this->currentCustomer->getCustomer();
            $groupId = $customer->getGroupId();
            $group = $this->groupRepository->getById($groupId);
            $result['group'] = $group->getCode();
        } catch (\Exception $e) {
            //log or do something
        }
        return $result;
    }
}
