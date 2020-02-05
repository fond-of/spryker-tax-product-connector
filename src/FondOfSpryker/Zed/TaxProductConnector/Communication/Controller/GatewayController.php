<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Communication\Controller;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\TaxProductConnector\Communication\Controller\GatewayController as SprykerGatewayController;

/**
 * @method \FondOfSpryker\Zed\TaxProductConnector\Business\TaxProductConnectorFacadeInterface getFacade()
 */
class GatewayController extends SprykerGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getNetPriceForProductAction(ProductAbstractTransfer $productTransfer): ProductAbstractTransfer
    {
        return $this->getFacade()->getNetPriceForProduct($productTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getTaxAmountForProductAction(ProductAbstractTransfer $productTransfer): ProductAbstractTransfer
    {
        return $this->getFacade()->getTaxAmountForProduct($productTransfer);
    }
}
