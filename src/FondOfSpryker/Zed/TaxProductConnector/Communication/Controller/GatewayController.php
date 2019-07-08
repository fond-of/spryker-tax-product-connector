<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Communication\Controller;

use Generated\Shared\Transfer\StorageProductTransfer;
use Spryker\Zed\TaxProductConnector\Communication\Controller\GatewayController as SprykerGatewayController;

/**
 * @method \FondOfSpryker\Zed\TaxProductConnector\Business\TaxProductConnectorFacadeInterface getFacade()
 */
class GatewayController extends SprykerGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\StorageProductTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\StorageProductTransfer
     */
    public function getNetPriceForProductAction(StorageProductTransfer $productTransfer): StorageProductTransfer
    {
        return $this->getFacade()->getNetPriceForProduct($productTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\StorageProductTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\StorageProductTransfer
     */
    public function getTaxAmountForProductAction(StorageProductTransfer $productTransfer): StorageProductTransfer
    {
        return $this->getFacade()->getTaxAmountForProduct($productTransfer);
    }
}
