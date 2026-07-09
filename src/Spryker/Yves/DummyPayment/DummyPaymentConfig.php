<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\DummyPayment;

use Spryker\Yves\Kernel\AbstractBundleConfig;

class DummyPaymentConfig extends AbstractBundleConfig
{
    /**
     * Specification:
     * - Specifies whether the Date of Birth field and its validation are rendered on the Invoice payment sub form.
     *
     * @api
     */
    public function isDateOfBirthEnabled(): bool
    {
        return true;
    }
}
