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
    public function getNetPriceForProduct(StorageProductTransfer $productTransfer): StorageProductTransfer
    {
        return $this->getFactory()->createProductAbstractReader()->getNetPriceForProduct($productTransfer);

    }

    /**
     * @param \Generated\Shared\Transfer\StorageProductTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\StorageProductTransfer
     */
    public function getTaxAmountForProduct(StorageProductTransfer $productTransfer): StorageProductTransfer
    {
        return $this->getFactory()->createProductAbstractReader()->getTaxAmountForProduct($productTransfer);

    }
}