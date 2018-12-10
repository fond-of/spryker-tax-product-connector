<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business\Model;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\TaxProductConnector\Business\Model\ProductItemTaxRateCalculator as SprykerProductItemTaxRateCalculator;

class ProductItemTaxRateCalculator extends SprykerProductItemTaxRateCalculator
{

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function recalculate(QuoteTransfer $quoteTransfer)
    {
        $countryIso2Code = $this->getShippingCountryIso2Code($quoteTransfer);
        $idRegion = $quoteTransfer->getShippingAddress()->getFkRegion();
        $allIdProductAbstracts = $this->getAllIdAbstractProducts($quoteTransfer);

        if (!$countryIso2Code) {
            $countryIso2Code = $this->taxFacade->getDefaultTaxCountryIso2Code();
        }

        $taxRates = $this->findTaxRatesByAllIdProductAbstractsCountryIso2CodeAndIdRegion($allIdProductAbstracts, $countryIso2Code, $idRegion);
        $this->setItemsTax($quoteTransfer, $taxRates);
    }

    /**
     * @param array $allIdProductAbstracts
     * @param string $countryIso2Code
     *
     * @return array
     */
    protected function findTaxRatesByAllIdProductAbstractsCountryIso2CodeAndIdRegion(array $allIdProductAbstracts, $countryIso2Code, $idRegion)
    {
        return $this->taxQueryContainer->queryTaxSetByIdProductAbstractCountryIso2CodeAndIdRegion($allIdProductAbstracts, $countryIso2Code, $idRegion)
            ->find()
            ->toArray();
    }
}
