<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business\Product;

use Generated\Shared\Transfer\StorageProductTransfer;
use Spryker\Zed\Tax\Business\Model\PriceCalculationHelper;

class ProductAbstractReader implements ProductAbstractReaderInterface
{
    /**
     * @var \Spryker\Zed\Tax\Business\Model\PriceCalculationHelper
     */
    protected $priceCalculationHelper;

    /**
     * ProductAbstractReader constructor.
     * @param \Spryker\Zed\Tax\Business\Model\PriceCalculationHelper $priceCalculationHelper
     */
    public function __construct(
        PriceCalculationHelper $priceCalculationHelper
    )
    {
        $this->priceCalculationHelper = $priceCalculationHelper;
    }

    /**
     * @param \Generated\Shared\Transfer\StorageProductTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\StorageProductTransfer
     */
    public function getNetPriceForProductAbstract(StorageProductTransfer $productTransfer): StorageProductTransfer
    {
        $netPrice = $this->priceCalculationHelper->getNetValueFromPrice(
            $productTransfer->getPrice(),
            $productTransfer->getTaxRate()
        );

        $productTransfer->setNetPrice($netPrice);

        return $productTransfer;
    }
}
