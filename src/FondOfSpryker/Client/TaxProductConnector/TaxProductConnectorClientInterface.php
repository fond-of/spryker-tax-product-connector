<?php

namespace FondOfSpryker\Client\TaxProductConnector;

use Generated\Shared\Transfer\StorageProductTransfer;

interface TaxProductConnectorClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\StorageProductTransfer
     */
    public function getNetPriceForProduct(StorageProductTransfer $productTransfer): StorageProductTransfer;
}
