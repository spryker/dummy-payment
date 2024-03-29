<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\DummyPayment\Communication\Plugin\ManualOrderEntry;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\DummyPayment\DummyPaymentConfig;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Spryker\Zed\ManualOrderEntryGuiExtension\Dependency\Plugin\PaymentSubFormPluginInterface;

/**
 * @method \Spryker\Zed\DummyPayment\Business\DummyPaymentFacadeInterface getFacade()
 * @method \Spryker\Zed\DummyPayment\Communication\DummyPaymentCommunicationFactory getFactory()
 * @method \Spryker\Zed\DummyPayment\DummyPaymentConfig getConfig()
 */
class DummyPaymentInvoicePaymentSubFormPlugin extends AbstractPlugin implements PaymentSubFormPluginInterface
{
    /**
     * @var string
     */
    public const PAYMENT_PROVIDER = 'DummyPayment';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Spryker\Zed\Kernel\Communication\Form\AbstractType
     */
    public function createSubForm(): AbstractType
    {
        return $this->getFactory()->createInvoiceForm();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getPropertyPath(): string
    {
        return DummyPaymentConfig::PAYMENT_METHOD_INVOICE;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return DummyPaymentConfig::PAYMENT_METHOD_INVOICE;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getPaymentProvider(): string
    {
        return static::PAYMENT_PROVIDER;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getPaymentMethod(): string
    {
        return 'invoice';
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function getData($quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()->createInvoiceFormDataProvider()->getData($quoteTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, mixed>
     */
    public function getOptions($quoteTransfer): array
    {
        return $this->getFactory()->createInvoiceFormDataProvider()->getOptions($quoteTransfer);
    }
}
