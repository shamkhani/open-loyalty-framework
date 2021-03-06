<?php
/**
 * Copyright © 2017 Divante, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace OpenLoyalty\Component\EarningRule\Domain\Algorithm;

use OpenLoyalty\Component\Transaction\Domain\ReadModel\TransactionDetails;

/**
 * Class RuleEvaluationContext.
 */
class RuleEvaluationContext extends RuleNameContext implements RuleEvaluationContextInterface
{
    /**
     * @var array
     */
    private $products;

    /**
     * @var TransactionDetails
     */
    private $transaction;

    /**
     * @var string
     */
    private $customerId;

    /**
     * RuleEvaluationContext constructor.
     *
     * @param TransactionDetails $transaction
     * @param string             $customerId
     */
    public function __construct(TransactionDetails $transaction, string $customerId = null)
    {
        $this->products = [];
        $this->transaction = $transaction;
        $this->customerId = $customerId;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * {@inheritdoc}
     */
    public function getProductPoints($sku)
    {
        if (!array_key_exists($sku, $this->products)) {
            return 0;
        }

        return round($this->products[$sku], 2);
    }

    /**
     * {@inheritdoc}
     */
    public function addProductPoints($sku, $points)
    {
        $current = $this->getProductPoints($sku);
        $this->setProductPoints($sku, $current + $points);
    }

    /**
     * {@inheritdoc}
     */
    public function setProductPoints($sku, $points)
    {
        if (!array_key_exists($sku, $this->products)) {
            $this->products[$sku] = 0;
        }

        $this->products[$sku] = $points;
    }

    /**
     * {@inheritdoc}
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return string|null
     */
    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }
}
