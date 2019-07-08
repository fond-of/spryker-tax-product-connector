<?php

namespace FondOfSpryker\Client\TaxProductConnector\Zed;

use Generated\Shared\Transfer\StorageProductTransfer;
use Spryker\Client\TaxProductConnector\Zed\TaxProductConnectorStub as SprykerTaxProductConnectorStub;

class TaxProductConnectorStub extends SprykerTaxProductConnectorStub implements TaxProductConnectorStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\StorageProductTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\StorageProductTransfer
     */
    public function getNetPriceForProduct(StorageProductTransfer $productTransfer): StorageProductTransfer
    {
        return $this->zedRequestClient->call('/tax-product-connector/gateway/get-net-price-for-product', $productTransfer);
    }
}
