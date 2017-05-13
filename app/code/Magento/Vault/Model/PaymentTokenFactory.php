<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Vault\Model;

use Magento\Framework\ObjectManagerInterface;
use Magento\Vault\Api\Data\PaymentTokenFactoryInterface;
use Magento\Vault\Api\Data\PaymentTokenInterface;

/**
 * PaymentTokenFactory class
 * @api
 */
class PaymentTokenFactory implements PaymentTokenFactoryInterface
{
    /**
     * @var array
     */
    private $tokenTypes = array();

    /**
     * PaymentTokenFactory constructor.
     * @param ObjectManagerInterface $objectManager
     * @param array $tokenTypes
     */
    public function __construct(ObjectManagerInterface $objectManager, $tokenTypes = [])
    {
        $this->objectManager = $objectManager;
        $this->tokenTypes = $tokenTypes;
    }

    /**
     * Create payment token entity
     * @param $type string
     * @return PaymentTokenInterface
     */
    public function create($type = null)
    {
        if ($type !== null && !in_array($type, $this->tokenTypes, true)) {
            throw new \LogicException('There is no such payment token type: ' . $type);
        }

        return $this->objectManager->create(PaymentTokenInterface::class, ['data' => [PaymentTokenInterface::TYPE => $type]]);
    }
}
