<?php
/**
 * Copyright © 2017 Divante, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace OpenLoyalty\Component\Transaction\Domain\SystemEvent;

use OpenLoyalty\Component\Transaction\Domain\CustomerId;
use OpenLoyalty\Component\Transaction\Domain\TransactionId;

/**
 * Class CustomerAssignedToTransactionSystemEvent.
 */
class CustomerAssignedToTransactionSystemEvent extends TransactionSystemEvent
{
    /**
     * @var CustomerId
     */
    protected $customerId;

    /**
     * @var float
     */
    protected $grossValue;

    protected $amountExcludedForLevel = 0;

    /**
     * @var float
     */
    protected $grossValueWithoutDeliveryCosts;

    /**
     * @var int
     */
    protected $transactionsCount;

    /**
     * @var bool
     */
    protected $return = false;

    public function __construct(
        TransactionId $transactionId,
        CustomerId $customerId,
        $grossValue,
        $grossValueWithoutDeliveryCosts,
        $amountExcludedForLevel = 0,
        $transactionsCount = null,
        $return = false
    ) {
        parent::__construct($transactionId, []);
        $this->grossValue = $grossValue;
        $this->grossValueWithoutDeliveryCosts = $grossValueWithoutDeliveryCosts;
        $this->customerId = $customerId;
        $this->amountExcludedForLevel = $amountExcludedForLevel;
        $this->transactionsCount = $transactionsCount;
        $this->return = $return;
    }

    /**
     * @return CustomerId
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @return float
     */
    public function getGrossValue()
    {
        return $this->grossValue;
    }

    /**
     * @return float
     */
    public function getGrossValueWithoutDeliveryCosts()
    {
        return $this->grossValueWithoutDeliveryCosts;
    }

    /**
     * @return int
     */
    public function getAmountExcludedForLevel()
    {
        return $this->amountExcludedForLevel;
    }

    /**
     * @return int
     */
    public function getTransactionsCount()
    {
        return $this->transactionsCount;
    }

    /**
     * @return bool
     */
    public function isReturn()
    {
        return $this->return;
    }
}
