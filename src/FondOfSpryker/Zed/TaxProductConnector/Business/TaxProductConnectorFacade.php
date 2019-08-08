<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\TaxProductConnector\Business\TaxProductConnectorFacade as SprykerTaxProductConnectorFacade;

/**
 * @method \FondOfSpryker\Zed\TaxProductConnector\Business\TaxProductConnectorBusinessFactory getFactory()
 */
class TaxProductConnectorFacade extends SprykerTaxProductConnectorFacade implements TaxProductConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getNetPriceForProduct(ProductAbstractTransfer $productTransfer): ProductAbstractTransfer
    {
        return $this->getFactory()->createProductAbstractReader()->getNetPriceForProduct($productTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getTaxAmountForProduct(ProductAbstractTransfer $productTransfer): ProductAbstractTransfer
    {
        return $this->getFactory()->createProductAbstractReader()->getTaxAmountForProduct($productTransfer);
    }

    /**
     * Specification:
     *  - Set tax rate for each item
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function calculateProductItemTaxRate(QuoteTransfer $quoteTransfer)
    {
        $this->getFactory()
            ->createProductItemTaxRateCalculator()
            ->recalculate($quoteTransfer);
    }
}
