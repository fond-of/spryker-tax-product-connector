<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business;

use Generated\Shared\Transfer\StorageProductTransfer;
use Spryker\Zed\TaxProductConnector\Business\TaxProductConnectorFacade as SprykerTaxProductConnectorFacade;

/**
 * @method \FondOfSpryker\Zed\TaxProductConnector\Business\TaxProductConnectorBusinessFactory getFactory()
 */
class TaxProductConnectorFacade extends SprykerTaxProductConnectorFacade implements TaxProductConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\StorageProductTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\StorageProductTransfer
     */
    public function getNetPriceForProductAbstract(StorageProductTransfer $productTransfer): StorageProductTransfer
    {
        return $this->getFactory()->createProductAbstractReader()->getNetPriceForProductAbstract($productTransfer);

    }
}
