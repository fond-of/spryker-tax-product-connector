<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Persistence;

use Orm\Zed\Tax\Persistence\SpyTaxSetQuery;
use Spryker\Zed\TaxProductConnector\Persistence\TaxProductConnectorQueryContainerInterface as SprykerTaxProductConnectorQueryContainerInterface;

interface TaxProductConnectorQueryContainerInterface extends SprykerTaxProductConnectorQueryContainerInterface
{
    /**
     * @param int[] $allIdProductAbstracts
     * @param string $countryIso2Code
     * @param int $idRegion
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery
     */
    public function queryTaxSetByIdProductAbstractCountryIso2CodeAndIdRegion(array $allIdProductAbstracts, string $countryIso2Code, int$idRegion): SpyTaxSetQuery;

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
    public function queryTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions(array $idProductAbstracts, array $countryIso2Code, array $idRegions): SpyTaxSetQuery;
}
