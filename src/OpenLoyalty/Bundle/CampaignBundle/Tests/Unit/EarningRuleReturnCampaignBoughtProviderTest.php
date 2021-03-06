<?php
/**
 * Copyright © 2018 Divante, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace OpenLoyalty\Bundle\CampaignBundle\Tests\Unit;

use OpenLoyalty\Bundle\CampaignBundle\Service\EarningRuleReturnCampaignBoughtProvider;
use OpenLoyalty\Component\Campaign\Domain\Campaign;
use OpenLoyalty\Component\Campaign\Domain\CampaignId;
use OpenLoyalty\Component\Campaign\Domain\CustomerId;
use OpenLoyalty\Component\Campaign\Domain\Model\Coupon;
use OpenLoyalty\Component\Campaign\Domain\Provider\EarningRuleReturnCampaignBoughtProviderInterface;
use OpenLoyalty\Component\Campaign\Domain\ReadModel\CampaignBought;
use OpenLoyalty\Component\Campaign\Domain\ReadModel\CampaignBoughtRepository;
use OpenLoyalty\Component\Customer\Domain\Model\CampaignPurchase;
use PHPUnit_Framework_MockObject_MockBuilder;

/**
 * Class EarningRuleReturnCampaignBoughtProviderTest.
 */
class EarningRuleReturnCampaignBoughtProviderTest extends \PHPUnit_Framework_TestCase
{
    private const CUSTOMER_ID = '00000000-0000-0000-0000-000000000000';
    private const CUSTOMER_EMAIL = 'test@test.test';
    private const CUSTOMER_PHONE = '1234567890';
    private const CAMPAIGN_ID = '00000000-0000-0000-0000-000000000001';
    private const COUPON_CODE = 'test';
    private const CAMPAIGN_NAME = 'test';

    /**
     * @var EarningRuleReturnCampaignBoughtProviderInterface
     */
    private $service;

    protected function setUp()
    {
        $campaignBought = new CampaignBought(
            new CampaignId(self::CAMPAIGN_ID),
            new CustomerId(self::CUSTOMER_ID),
            new \DateTime(),
            new Coupon(self::COUPON_CODE),
            Campaign::REWARD_TYPE_PERCENTAGE_DISCOUNT_CODE,
            self::CAMPAIGN_NAME,
            self::CUSTOMER_EMAIL,
            self::CUSTOMER_PHONE,
            CampaignPurchase::STATUS_ACTIVE
        );
        /** @var CampaignBoughtRepository|PHPUnit_Framework_MockObject_MockBuilder $campaignRepository */
        $campaignRepository = $this->getMockBuilder(CampaignBoughtRepository::class)->getMock();
        $campaignRepository->method('findByTransactionIdAndCustomerId')->willReturn([$campaignBought]);

        $this->service = new EarningRuleReturnCampaignBoughtProvider(
            $campaignRepository
        );
    }

    /**
     * @test
     */
    public function it_will_return_transactions()
    {
        $result = $this->service->findByTransactionAndCustomer(
            'test',
            'test'
        );

        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
    }
}
