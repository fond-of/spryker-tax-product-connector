<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Persistence;

use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Orm\Zed\Tax\Persistence\Map\SpyTaxRateTableMap;
use Spryker\Shared\Tax\TaxConstants;
use Spryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainer as SprykerTaxProductConnectorQueryContainer;

/**
 * @method \Spryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorPersistenceFactory getFactory()
 */
class TaxProductConnectorQueryContainer extends SprykerTaxProductConnectorQueryContainer implements TaxProductConnectorQueryContainerInterface
{
    /**
     * @param int[] $allIdProductAbstracts
     * @param string $countryIso2Code
     * @param int $idRegion
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery
     */
    public function queryTaxSetByIdProductAbstractCountryIso2CodeAndIdRegion(array $allIdProductAbstracts, $countryIso2Code, $idRegion)
    {
        return $this->getFactory()->createTaxSetQuery()
            ->useSpyProductAbstractQuery()
                ->filterByIdProductAbstract($allIdProductAbstracts, Criteria::IN)
                ->withColumn(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, self::COL_ID_ABSTRACT_PRODUCT)
                ->groupBy(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT)
            ->endUse()
            ->useSpyTaxSetTaxQuery()
                ->useSpyTaxRateQuery()
                    ->useCountryQuery()->filterByIso2Code($countryIso2Code)->endUse()
                    ->_and()
                    ->useSpyRegionQuery()->filterByIdRegion($idRegion)->endUse()
                    ->_or()
                    ->filterByName(TaxConstants::TAX_EXEMPT_PLACEHOLDER)
                ->endUse()
                ->withColumn('MAX(' . SpyTaxRateTableMap::COL_RATE . ')', self::COL_MAX_TAX_RATE)
            ->endUse()
            ->select([self::COL_MAX_TAX_RATE]);
    }
}
