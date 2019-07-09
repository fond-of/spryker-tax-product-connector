<?php

namespace FondOfSpryker\Client\TaxProductConnector;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\StorageProductTransfer;

interface TaxProductConnectorClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getNetPriceForProduct(ProductAbstractTransfer $productTransfer): ProductAbstractTransfer;

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productTransfer
     * 
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getTaxAmountForProduct(ProductAbstractTransfer $productTransfer): ProductAbstractTransfer;
}
