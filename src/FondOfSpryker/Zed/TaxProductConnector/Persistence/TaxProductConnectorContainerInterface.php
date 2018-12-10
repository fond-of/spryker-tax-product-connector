<?php

namespace FondOSpryker\Zed\TaxProductConnector\Persistence;

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
    public function queryTaxSetByIdProductAbstractCountryIso2CodeAndIdRegion(array $allIdProductAbstracts, $countryIso2Code, $idRegion);
}
