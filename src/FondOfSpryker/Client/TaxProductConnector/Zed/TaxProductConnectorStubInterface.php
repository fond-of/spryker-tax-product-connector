<?php

namespace FondOfSpryker\Client\TaxProductConnector\Zed;

use Generated\Shared\Transfer\StorageProductTransfer;
use Spryker\Client\TaxProductConnector\Zed\TaxProductConnectorStubInterface as SprykerTaxProductConnectorStubInterface;

interface TaxProductConnectorStubInterface extends SprykerTaxProductConnectorStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\StorageProductTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\StorageProductTransfer
     */
    public function getNetPriceForProduct(StorageProductTransfer $productTransfer): StorageProductTransfer;
}
