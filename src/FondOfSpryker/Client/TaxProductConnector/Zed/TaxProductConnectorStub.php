<?php

namespace FondOfSpryker\Client\TaxProductConnector\Zed;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\StorageProductTransfer;
use Spryker\Client\TaxProductConnector\Zed\TaxProductConnectorStub as SprykerTaxProductConnectorStub;

class TaxProductConnectorStub extends SprykerTaxProductConnectorStub implements TaxProductConnectorStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getNetPriceForProduct(ProductAbstractTransfer $productTransfer): ProductAbstractTransfer
    {
        return $this->zedRequestClient->call('/tax-product-connector/gateway/get-net-price-for-product', $productTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getTaxAmountForProduct(ProductAbstractTransfer $productTransfer): ProductAbstractTransfer
    {
        return $this->zedRequestClient->call('/tax-product-connector/gateway/get-tax-amount-for-product', $productTransfer);
    }
}
