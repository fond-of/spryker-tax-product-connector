<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business\Product;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\StorageProductTransfer;

interface ProductAbstractReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\StorageProductTransfer $storageProductTransfer
     *
     * @return \Generated\Shared\Transfer\StorageProductTransfer
     */
    public function getNetPriceForProduct(StorageProductTransfer $storageProductTransfer): StorageProductTransfer;

    /**
     * @param \Generated\Shared\Transfer\StorageProductTransfer $storageProductTransfer
     *
     * @return \Generated\Shared\Transfer\StorageProductTransfer
     */
    public function getTaxAmountForProduct(StorageProductTransfer $storageProductTransfer): StorageProductTransfer;
}
