<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Persistence;

use Orm\Zed\Country\Persistence\Map\SpyCountryTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Orm\Zed\Tax\Persistence\Map\SpyTaxRateTableMap;
use Orm\Zed\Tax\Persistence\SpyTaxSetQuery;
use Propel\Runtime\ActiveQuery\Criteria;
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

    /**
     * @api
     *
     * @module Country
     *
     * @param int[] $idProductAbstracts
     * @param string[] $countryIso2Code
     * @param int[] $idRegions
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery
     */
    public function queryTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions(array $idProductAbstracts, array $countryIso2Code, array $idRegions): SpyTaxSetQuery
    {
        return $this->getFactory()
            ->createTaxSetQuery()
            ->useSpyProductAbstractQuery()
                ->filterByIdProductAbstract($idProductAbstracts, Criteria::IN)
                ->withColumn(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, static::COL_ID_ABSTRACT_PRODUCT)
                ->groupBy(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT)
            ->endUse()
            ->useSpyTaxSetTaxQuery()
                ->useSpyTaxRateQuery()
                    ->useCountryQuery()
                        ->filterByIso2Code($countryIso2Code, Criteria::IN)
                        ->withColumn(SpyCountryTableMap::COL_ISO2_CODE, static::COL_COUNTRY_CODE)
                        ->groupBy(SpyCountryTableMap::COL_ISO2_CODE)
                    ->endUse()
                    ->_and()
                    ->useSpyRegionQuery()->filterByIdRegion($idRegions, Criteria::IN)->endUse()
                    ->_or()
                    ->filterByFkCountry(null)
                ->endUse()
                ->withColumn('MAX(' . SpyTaxRateTableMap::COL_RATE . ')', static::COL_MAX_TAX_RATE)
            ->endUse()
            ->select([static::COL_COUNTRY_CODE, static::COL_MAX_TAX_RATE, SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT]);
    }
}
