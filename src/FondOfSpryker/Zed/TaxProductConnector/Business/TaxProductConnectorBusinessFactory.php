<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business;

use FondOfSpryker\Zed\TaxProductConnector\Business\Product\ProductAbstractReader;
use FondOfSpryker\Zed\TaxProductConnector\Business\Product\ProductAbstractReaderInterface;
use FondOfSpryker\Zed\TaxProductConnector\TaxProductConnectorDependencyProvider;
use Spryker\Zed\TaxProductConnector\Business\TaxProductConnectorBusinessFactory as SprykerTaxProductConnectorBusinessFactory;

class TaxProductConnectorBusinessFactory extends SprykerTaxProductConnectorBusinessFactory
{
    /**
     * @return \Spryker\Zed\TaxProductConnector\Business\Product\ProductAbstractTaxReaderInterface
     */
    public function createProductAbstractReader(): ProductAbstractReaderInterface
    {
        return new ProductAbstractReader($this->createPriceCalculationHelper());
    }

    /**
     * @return \FondOfSpryker\Client\TaxProductConnector\TaxProductConnectorClient
     */
    public function createPriceCalculationHelper()
    {
        return $this->getProvidedDependency(TaxProductConnectorDependencyProvider::PRICE_CALCULATION_HELPER);
    }
}
