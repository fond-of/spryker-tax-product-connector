<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business\Model;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Country\Business\CountryFacadeInterface;
use Spryker\Zed\TaxProductConnector\Dependency\Facade\TaxProductConnectorToTaxInterface;
use Spryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainerInterface;
use Spryker\Zed\TaxProductConnector\Business\Model\ProductItemTaxRateCalculator as SprykerProductItemTaxRateCalculator;

class ProductItemTaxRateCalculator extends SprykerProductItemTaxRateCalculator
{
    /**
     * @var \Spryker\Zed\Country\Business\CountryFacadeInterface
     */
    protected $countryFacade;

    /**
     * @var \Spryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainerInterface
     */
    protected $taxQueryContainer;

    /**
     * @var \Spryker\Zed\TaxProductConnector\Dependency\Facade\TaxProductConnectorToTaxInterface
     */
    protected $taxFacade;

    /**
     * @param \Spryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainerInterface $taxQueryContainer
     * @param \Spryker\Zed\TaxProductConnector\Dependency\Facade\TaxProductConnectorToTaxInterface $taxFacade
     */
    public function __construct(TaxProductConnectorQueryContainerInterface $taxQueryContainer, TaxProductConnectorToTaxInterface $taxFacade, CountryFacadeInterface $countryFacade)
    {
        $this->countryFacade = $countryFacade;
        $this->taxQueryContainer = $taxQueryContainer;
        $this->taxFacade = $taxFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function recalculate(QuoteTransfer $quoteTransfer)
    {
        $countryIso2Code = $this->getShippingCountryIso2Code($quoteTransfer);
        $allIdProductAbstracts = $this->getAllIdAbstractProducts($quoteTransfer);

        if (!$countryIso2Code) {
            $countryIso2Code = $this->taxFacade->getDefaultTaxCountryIso2Code();
        }

        if ($quoteTransfer->getShippingAddress() == null || $quoteTransfer->getShippingAddress()->getFkRegion() == null) {
            $countryTransfer = $this->countryFacade->getCountryByIso2Code($countryIso2Code);
            /** @var \Generated\Shared\Transfer\RegionTransfer $region */
            $region = current($countryTransfer->getRegions());
            $idRegion = $region->getIdRegion();
        }else {
            $idRegion = $quoteTransfer->getShippingAddress()->getFkRegion();
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
