<?php

namespace FondOfSpryker\Client\TaxProductConnector;

use Generated\Shared\Transfer\StorageProductTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\TaxProductConnector\TaxProductConnectorFactory getFactory()
 */
class TaxProductConnectorClient extends AbstractClient implements TaxProductConnectorClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\StorageProductTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\StorageProductTransfer
     */
    public function getNetPriceForProduct(StorageProductTransfer $productTransfer): StorageProductTransfer
    {
        return $this->getFactory()->createZedStub()->getNetPriceForProduct($productTransfer);
    }
}
