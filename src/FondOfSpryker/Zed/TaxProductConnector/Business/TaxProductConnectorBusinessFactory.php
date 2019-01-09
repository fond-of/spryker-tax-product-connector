<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business;

use FondOfSpryker\Zed\TaxProductConnector\Business\Model\ProductItemTaxRateCalculator;
use FondOfSpryker\Zed\TaxProductConnector\TaxProductConnectorDependencyProvider;
use Spryker\Zed\TaxProductConnector\Business\TaxProductConnectorBusinessFactory as SprykerTaxProductConnectorBusinessFactory;

/**
 * @method \Spryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainerInterface getQueryContainer()
 */
class TaxProductConnectorBusinessFactory extends SprykerTaxProductConnectorBusinessFactory
{
    /**
     * @return \Spryker\Zed\TaxProductConnector\Business\Model\ProductItemTaxRateCalculator
     */
    public function createProductItemTaxRateCalculator()
    {
        return new ProductItemTaxRateCalculator(
            $this->getQueryContainer(),
            $this->getTaxFacade(),
            $this->getCountryFacade()
        );
    }

    /**
     * @return \Spryker\Zed\TaxProductConnector\Dependency\Facade\TaxProductConnectorToTaxInterface
     */
    protected function getCountryFacade()
    {
        return $this->getProvidedDependency(TaxProductConnectorDependencyProvider::FACADE_COUNTRY);
    }

}
