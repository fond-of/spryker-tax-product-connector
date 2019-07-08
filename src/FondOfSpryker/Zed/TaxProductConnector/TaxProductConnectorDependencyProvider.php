<?php

namespace FondOfSpryker\Zed\TaxProductConnector;

use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Tax\Business\Model\PriceCalculationHelper;
use Spryker\Zed\TaxProductConnector\TaxProductConnectorDependencyProvider as SprykerTaxProductConnectorDependencyProvider;

class TaxProductConnectorDependencyProvider extends SprykerTaxProductConnectorDependencyProvider
{
    const FACADE_COUNTRY = 'facade_country';

    const PRICE_CALCULATION_HELPER = 'PRICE_CALCULATION_HELPER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addCountryFacade($container);
        $container = $this->addPriceCalculationHelper($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCountryFacade(Container $container)
    {
        $container[static::FACADE_COUNTRY] = function (Container $container) {
            return $container->getLocator()->country()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPriceCalculationHelper(Container $container)
    {
        $container[static::PRICE_CALCULATION_HELPER] = function (Container $container) {
            return new PriceCalculationHelper();
        };

        return $container;
    }
}
