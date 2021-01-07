<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Communication\Plugin\Calculation;

use Generated\Shared\Transfer\CalculableObjectTransfer;
use Spryker\Zed\CalculationExtension\Dependency\Plugin\CalculationPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\TaxProductConnector\Business\TaxProductConnectorFacadeInterface getFacade()
 */
class ProductItemTaxRateByRegionCalculatorPlugin extends AbstractPlugin implements CalculationPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CalculableObjectTransfer $calculableObjectTransfer
     *
     * @return void
     */
    public function recalculate(CalculableObjectTransfer $calculableObjectTransfer)
    {
        $this->getFacade()->calculateProductItemTaxRateForCalculableObjectTransfer($calculableObjectTransfer);
    }
}
