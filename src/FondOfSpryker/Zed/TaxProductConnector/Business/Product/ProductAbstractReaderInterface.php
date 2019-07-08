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
    public function getNetPriceForProductAbstract(StorageProductTransfer $storageProductTransfer): StorageProductTransfer;
}
