<?php

namespace FondOfSpryker\Client\TaxProductConnector;

use FondOfSpryker\Client\TaxProductConnector\Zed\TaxProductConnectorStub;
use Spryker\Client\TaxProductConnector\TaxProductConnectorFactory as SprykerTaxProductConnectorFactory;
use Spryker\Client\TaxProductConnector\Zed\TaxProductConnectorStubInterface;

class TaxProductConnectorFactory extends SprykerTaxProductConnectorFactory
{
    /**
     * @return \FondOfSpryker\Client\TaxProductConnector\Zed\TaxProductConnectorStubInterface
     */
    public function createZedStub(): TaxProductConnectorStubInterface
    {
        return new TaxProductConnectorStub($this->getZedRequestClient());
    }
}
