<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\DummyPayment\Business\Model\Payment;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RefundTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\DummyPayment\Business\Model\Payment\Refund;
use Spryker\Zed\DummyPayment\Dependency\Facade\DummyPaymentToRefundFacadeInterface;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group DummyPayment
 * @group Business
 * @group Model
 * @group Payment
 * @group RefundTest
 * Add your own group annotations below this line
 */
class RefundTest extends Unit
{
    /**
     * @return void
     */
    public function testSaveRefundShouldCalledWhenRefundProcessSuccessful(): void
    {
        $refundTransfer = new RefundTransfer();
        $refundTransfer->setAmount(100);
        $refundFacadeMock = $this->getRefundFacadeMock($refundTransfer);
        $refund = new Refund($refundFacadeMock);
        $refund->refund([], new SpySalesOrder());
    }

    /**
     * @return void
     */
    public function testSaveRefundShouldNotCalledWhenRefundProcessNotSuccessful(): void
    {
        $refundTransfer = new RefundTransfer();
        $refundTransfer->setAmount(0);
        $refundFacadeMock = $this->getRefundFacadeMock($refundTransfer);
        $refund = new Refund($refundFacadeMock);
        $refund->refund([], new SpySalesOrder());
    }

    /**
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     *
     * @return \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\DummyPayment\Dependency\Facade\DummyPaymentToRefundFacadeInterface
     */
    protected function getRefundFacadeMock(RefundTransfer $refundTransfer): DummyPaymentToRefundFacadeInterface
    {
        $refundFacadeMock = $this->getMockBuilder(DummyPaymentToRefundFacadeInterface::class)->getMock();
        $refundFacadeMock->method('calculateRefund')->willReturn($refundTransfer);
        if ($refundTransfer->getAmount() > 0) {
            $refundFacadeMock->expects($this->once())->method('saveRefund');
        } else {
            $refundFacadeMock->expects($this->never())->method('saveRefund');
        }

        return $refundFacadeMock;
    }
}
