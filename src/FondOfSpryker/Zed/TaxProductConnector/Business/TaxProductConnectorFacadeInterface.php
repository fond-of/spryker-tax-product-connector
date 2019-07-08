<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business;

use Generated\Shared\Transfer\StorageProductTransfer;
use Spryker\Zed\TaxProductConnector\Business\TaxProductConnectorFacadeInterface as SprykerTaxProductConnectorFacadeInterface;

interface TaxProductConnectorFacadeInterface extends SprykerTaxProductConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\StorageProductTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\StorageProductTransfer
     */
    public function getNetPriceForProductAbstract(StorageProductTransfer $productTransfer): StorageProductTransfer;
}
