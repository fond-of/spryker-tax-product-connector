<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business\Product;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface ProductAbstractReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $storageProductTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getNetPriceForProduct(ProductAbstractTransfer $storageProductTransfer): ProductAbstractTransfer;

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $storageProductTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getTaxAmountForProduct(ProductAbstractTransfer $storageProductTransfer): ProductAbstractTransfer;
}
