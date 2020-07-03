<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business\Model;

use FondOfSpryker\Zed\Country\Business\CountryFacadeInterface;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\TaxProductConnector\Business\Calculator\ProductItemTaxRateCalculator as SprykerProductItemTaxRateCalculator;
use Spryker\Zed\TaxProductConnector\Dependency\Facade\TaxProductConnectorToTaxInterface;
use FondOfSpryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainerInterface;

class ProductItemTaxRateCalculator extends SprykerProductItemTaxRateCalculator
{
    /**
     * @var \Spryker\Zed\Country\Business\CountryFacadeInterface
     */
    protected $countryFacade;

    /**
     * @var \FondOfSpryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainerInterface
     */
    protected $taxQueryContainer;

    /**
     * @var \Spryker\Zed\TaxProductConnector\Dependency\Facade\TaxProductConnectorToTaxInterface
     */
    protected $taxFacade;

    /**
     * @var int
     */
    protected $defaultRegionId;

    /**
     * @param \FondOfSpryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainerInterface $taxQueryContainer
     * @param \Spryker\Zed\TaxProductConnector\Dependency\Facade\TaxProductConnectorToTaxInterface $taxFacade
     * @param \FondOfSpryker\Zed\Country\Business\CountryFacadeInterface $countryFacade
     */
    public function __construct(
        TaxProductConnectorQueryContainerInterface $taxQueryContainer,
        TaxProductConnectorToTaxInterface $taxFacade,
        CountryFacadeInterface $countryFacade
    ) {
        parent::__construct($taxQueryContainer, $taxFacade);
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
        $regionIds = $this->getRegionIds($quoteTransfer->getItems());
        $foundResults = null;

        if (count($regionIds) > 0){
            $foundResults = $this->taxQueryContainer
                ->queryTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions(
                    $this->getIdProductAbstruct($quoteTransfer->getItems()),
                    $this->getCountryIso2Codes($quoteTransfer->getItems()),
                    $regionIds
                )
                ->find();
        }

        if ($foundResults === null || count($foundResults->getData()) === 0){
            $foundResults = $this->taxQueryContainer
                ->queryTaxSetByIdProductAbstractAndCountryIso2CodesWhenRegionIsNull(
                    $this->getIdProductAbstruct($quoteTransfer->getItems()),
                    $this->getCountryIso2Codes($quoteTransfer->getItems())
                )
                ->find();
        }

        $taxRatesByIdProductAbstractAndCountry = $this->mapByIdProductAbstractAndCountry($foundResults);

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            $taxRate = $this->getEffectiveTaxRate(
                $taxRatesByIdProductAbstractAndCountry,
                $itemTransfer->getIdProductAbstract(),
                $this->getShippingCountryIso2CodeByItem($itemTransfer)
            );
            $itemTransfer->setTaxRate($taxRate);
        }
    }

    /**
     * @param \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[] $itemTransfers
     *
     * @return string[]
     */
    protected function getRegionIds(iterable $itemTransfers): array
    {
        $result = [];
        foreach ($itemTransfers as $itemTransfer) {
            $idRegion = $this->getRegionIdByItem($itemTransfer);
            if ($idRegion !== null){
                $result[] = $idRegion;
            }
        }

        return array_unique($result);
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return string|null
     */
    protected function getRegionIdByItem(ItemTransfer $itemTransfer): ?string
    {
        if ($this->hasItemShippingAddressDefaultRegionId($itemTransfer)) {
            return $itemTransfer->getShipment()->getShippingAddress()->getFkRegion();
        }

        return null;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return bool
     */
    protected function hasItemShippingAddressDefaultRegionId(ItemTransfer $itemTransfer): bool
    {
        $shipmentTransfer = $itemTransfer->getShipment();

        return $shipmentTransfer !== null &&
            $shipmentTransfer->getShippingAddress() !== null &&
            $shipmentTransfer->getShippingAddress()->getFkRegion() !== null;
    }

    /**
     * @return int
     */
    protected function getDefaultTaxRegionId(): int
    {
        if ($this->defaultRegionId === null) {
            //ToDo get default Region!!!!
            $this->defaultRegionId = 1;
        }

        return $this->defaultRegionId;
    }
}
