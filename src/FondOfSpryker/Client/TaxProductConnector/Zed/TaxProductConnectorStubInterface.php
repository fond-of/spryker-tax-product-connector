<?php

namespace FondOfSpryker\Client\TaxProductConnector\Zed;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\StorageProductTransfer;
use Spryker\Client\TaxProductConnector\Zed\TaxProductConnectorStubInterface as SprykerTaxProductConnectorStubInterface;

interface TaxProductConnectorStubInterface extends SprykerTaxProductConnectorStubInterface
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
