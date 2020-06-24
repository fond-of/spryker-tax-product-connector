<?php

namespace FondOfSpryker\Client\TaxProductConnector;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\TaxProductConnector\TaxProductConnectorFactory getFactory()
 */
class TaxProductConnectorClient extends AbstractClient implements TaxProductConnectorClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getNetPriceForProduct(ProductAbstractTransfer $productTransfer): ProductAbstractTransfer
    {
        return $this->getFactory()->createZedStub()->getNetPriceForProduct($productTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getTaxAmountForProduct(ProductAbstractTransfer $productTransfer): ProductAbstractTransfer
    {
        return $this->getFactory()->createZedStub()->getTaxAmountForProduct($productTransfer);
    }
}
