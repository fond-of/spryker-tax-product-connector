<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business\Model;

use FondOfSpryker\Zed\Country\Business\CountryFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\TaxProductConnector\Business\Model\ProductItemTaxRateCalculator as SprykerProductItemTaxRateCalculator;
use Spryker\Zed\TaxProductConnector\Dependency\Facade\TaxProductConnectorToTaxInterface;
use Spryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainer;
use Spryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainerInterface;

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
     * @param \FondOfSpryker\Zed\Country\Business\CountryFacadeInterface $countryFacade
     */
    public function __construct(
        TaxProductConnectorQueryContainerInterface $taxQueryContainer,
        TaxProductConnectorToTaxInterface $taxFacade,
        CountryFacadeInterface $countryFacade
    ) {
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
        $taxRates = [];
        $countryIso2Code = $this->getShippingCountryIso2Code($quoteTransfer);
        $allIdProductAbstracts = $this->getAllIdAbstractProducts($quoteTransfer);

        if (!$countryIso2Code) {
            $countryIso2Code = $this->taxFacade->getDefaultTaxCountryIso2Code();
        }

        if ($quoteTransfer->getShippingAddress() != null && $quoteTransfer->getShippingAddress()->getRegion()) {
            $regionId = $this->countryFacade->getIdRegionByIso2Code($quoteTransfer->getShippingAddress()->getRegion());
            $taxRates = $this->findTaxRatesByAllIdProductAbstractsCountryIso2CodeAndIdRegion(
                $allIdProductAbstracts,
                $countryIso2Code,
                $regionId
            );
        } else {
            $taxRates = $this->findTaxRatesByAllIdProductAbstractsAndCountryIso2Code($allIdProductAbstracts, $countryIso2Code);
        }

        $this->setItemsTax($quoteTransfer, $taxRates);
    }
    
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param array $taxRates
     *
     * @return void
     */
    protected function setItemsTax(QuoteTransfer $quoteTransfer, array $taxRates)
    {
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            $itemTransfer->setTaxRate(
                $this->getTaxRate(
                    $taxRates,
                    $itemTransfer->getIdProductAbstract(),
                    $quoteTransfer
                )
            );
        }
    }

    /**
     * @param array $taxRates
     * @param int $idProductAbstract
     *
     * @return float
     */
    protected function getTaxRate(array $taxRates, $idProductAbstract, QuoteTransfer $quoteTransfer)
    {
        if ($quoteTransfer->getShippingAddress() === null) {
            return $this->taxFacade->getDefaultTaxRate();
        }

        foreach ($taxRates as $taxRate) {
            if ((int)$taxRate[TaxProductConnectorQueryContainer::COL_ID_ABSTRACT_PRODUCT] === (int)$idProductAbstract) {
                return (float)$taxRate[TaxProductConnectorQueryContainer::COL_MAX_TAX_RATE];
            }
        }

        return $this->taxFacade->getDefaultTaxRate();
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
