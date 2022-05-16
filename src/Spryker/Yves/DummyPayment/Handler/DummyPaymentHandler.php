<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\DummyPayment\Handler;

use Generated\Shared\Transfer\DummyPaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\DummyPayment\DummyPaymentConfig;
use Spryker\Yves\DummyPayment\Exception\PaymentMethodNotFoundException;

class DummyPaymentHandler
{
    /**
     * @var string
     */
    public const PAYMENT_PROVIDER = 'DummyPayment';

    /**
     * @var array
     */
    protected static $paymentMethods = [
        DummyPaymentConfig::PAYMENT_METHOD_INVOICE => 'invoice',
        DummyPaymentConfig::PAYMENT_METHOD_CREDIT_CARD => 'credit card',
    ];

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addPaymentToQuote(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $paymentSelection = $quoteTransfer->getPayment()->getPaymentSelection();

        $this->setPaymentProviderAndMethod($quoteTransfer, $paymentSelection);
        $this->setDummyPayment($quoteTransfer, $paymentSelection);

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param string $paymentSelection
     *
     * @return void
     */
    protected function setPaymentProviderAndMethod(QuoteTransfer $quoteTransfer, string $paymentSelection): void
    {
        $quoteTransfer->getPayment()
            ->setPaymentProvider(static::PAYMENT_PROVIDER)
            ->setPaymentMethod(static::$paymentMethods[$paymentSelection]);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param string $paymentSelection
     *
     * @return void
     */
    protected function setDummyPayment(QuoteTransfer $quoteTransfer, string $paymentSelection): void
    {
        $dummyPaymentTransfer = $this->getDummyPaymentTransfer($quoteTransfer, $paymentSelection);

        $quoteTransfer->getPayment()->setDummyPayment(clone $dummyPaymentTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param string $paymentSelection
     *
     * @throws \Spryker\Yves\DummyPayment\Exception\PaymentMethodNotFoundException
     *
     * @return \Generated\Shared\Transfer\DummyPaymentTransfer
     */
    protected function getDummyPaymentTransfer(QuoteTransfer $quoteTransfer, string $paymentSelection): DummyPaymentTransfer
    {
        $paymentMethod = ucfirst($paymentSelection);
        $method = 'get' . $paymentMethod;
        $paymentTransfer = $quoteTransfer->getPayment();
        if (!method_exists($paymentTransfer, $method) || ($quoteTransfer->getPayment()->$method() === null)) {
            throw new PaymentMethodNotFoundException(sprintf('Selected payment method "%s" not found in PaymentTransfer', $paymentMethod));
        }
        $dummyPaymentTransfer = $quoteTransfer->getPayment()->$method();

        return $dummyPaymentTransfer;
    }
}
