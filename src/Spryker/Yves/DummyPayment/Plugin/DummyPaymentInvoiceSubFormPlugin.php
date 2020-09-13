<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\DummyPayment\Plugin;

use Spryker\Yves\DummyPayment\Form\InvoiceSubForm;
use Spryker\Yves\Kernel\AbstractPlugin;
use Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface;
use Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginInterface;

/**
 * @method \Spryker\Yves\DummyPayment\DummyPaymentFactory getFactory()
 */
class DummyPaymentInvoiceSubFormPlugin extends AbstractPlugin implements SubFormPluginInterface
{
    /**
     * @return \Spryker\Yves\DummyPayment\Form\InvoiceSubForm
     */
    public function createSubForm(): InvoiceSubForm
    {
        return $this->getFactory()->createInvoiceForm();
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface
     */
    public function createSubFormDataProvider(): StepEngineFormDataProviderInterface
    {
        return $this->getFactory()->createInvoiceFormDataProvider();
    }
}
