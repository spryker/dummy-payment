<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\DummyPayment;

interface DummyPaymentConfig
{
    /**
     * @api
     *
     * @var string
     */
    public const PROVIDER_NAME = 'DummyPayment';

    /**
     * @api
     *
     * @var string
     */
    public const PAYMENT_METHOD_INVOICE = 'dummyPaymentInvoice';

    /**
     * @api
     *
     * @var string
     */
    public const PAYMENT_METHOD_CREDIT_CARD = 'dummyPaymentCreditCard';

    /**
     * @api
     *
     * @var string
     */
    public const PAYMENT_METHOD_NAME_INVOICE = 'invoice';

    /**
     * @api
     *
     * @var string
     */
    public const PAYMENT_METHOD_NAME_CREDIT_CARD = 'credit card';
}
