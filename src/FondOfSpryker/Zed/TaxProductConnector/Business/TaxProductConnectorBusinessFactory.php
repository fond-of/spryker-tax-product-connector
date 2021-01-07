<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business;

use FondOfSpryker\Zed\Country\Business\CountryFacadeInterface;
use FondOfSpryker\Zed\TaxProductConnector\Business\Calculator\ProductItemTaxRateByRegionCalculator;
use FondOfSpryker\Zed\TaxProductConnector\Business\Model\ProductItemTaxRateCalculator;
use FondOfSpryker\Zed\TaxProductConnector\Business\Product\ProductAbstractReader;
use FondOfSpryker\Zed\TaxProductConnector\Business\Product\ProductAbstractReaderInterface;
use FondOfSpryker\Zed\TaxProductConnector\TaxProductConnectorDependencyProvider;
use Spryker\Zed\TaxProductConnector\Business\Calculator\CalculatorInterface;
use Spryker\Zed\TaxProductConnector\Business\Calculator\ProductItemTaxRateCalculator as ProductItemTaxRateCalculatorWithMultipleShipmentTaxRate;
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
     * @return \Spryker\Zed\Tax\Business\Model\PriceCalculationHelper
     */
    public function createPriceCalculationHelper()
    {
        return $this->getProvidedDependency(TaxProductConnectorDependencyProvider::PRICE_CALCULATION_HELPER);
    }

    /**
     * @return \FondOfSpryker\Zed\Country\Business\CountryFacadeInterface
     */
    public function getCountryFacade(): CountryFacadeInterface
    {
        return $this->getProvidedDependency(TaxProductConnectorDependencyProvider::FACADE_COUNTRY);
    }

    /**
     * @return \Spryker\Zed\TaxProductConnector\Business\Calculator\CalculatorInterface
     */
    public function createProductItemTaxRateByRegionCalculator(): CalculatorInterface
    {
        return new ProductItemTaxRateByRegionCalculator(
            $this->getQueryContainer(),
            $this->getTaxFacade()
        );
    }
}
