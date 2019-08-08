<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business;

use FondOfSpryker\Zed\Country\Business\CountryFacadeInterface;
use FondOfSpryker\Zed\TaxProductConnector\Business\Model\ProductItemTaxRateCalculator;
use FondOfSpryker\Zed\TaxProductConnector\Business\Product\ProductAbstractReader;
use FondOfSpryker\Zed\TaxProductConnector\Business\Product\ProductAbstractReaderInterface;
use FondOfSpryker\Zed\TaxProductConnector\TaxProductConnectorDependencyProvider;
use Spryker\Zed\TaxProductConnector\Business\TaxProductConnectorBusinessFactory as SprykerTaxProductConnectorBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainer getQueryContainer()
 */
class TaxProductConnectorBusinessFactory extends SprykerTaxProductConnectorBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\TaxProductConnector\Business\Product\ProductAbstractReaderInterface
     */
    public function createProductAbstractReader(): ProductAbstractReaderInterface
    {
        return new ProductAbstractReader($this->createPriceCalculationHelper());
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Client\TaxProductConnector\TaxProductConnectorClient
     */
    public function createPriceCalculationHelper()
    {
        return $this->getProvidedDependency(TaxProductConnectorDependencyProvider::PRICE_CALCULATION_HELPER);
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\Country\Business\CountryFacadeInterface
     */
    public function getCountryFacade(): CountryFacadeInterface
    {
        return $this->getProvidedDependency(TaxProductConnectorDependencyProvider::FACADE_COUNTRY);
    }

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
}
