<?php

namespace FondOfSpryker\Zed\TaxProductConnector\Business\Product;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Tax\Business\Model\PriceCalculationHelper;

class ProductAbstractReader implements ProductAbstractReaderInterface
{
    /**
     * @var \Spryker\Zed\Tax\Business\Model\PriceCalculationHelper
     */
    protected $priceCalculationHelper;

    /**
     * @param \Spryker\Zed\Tax\Business\Model\PriceCalculationHelper $priceCalculationHelper
     */
    public function __construct(
        PriceCalculationHelper $priceCalculationHelper
    ) {
        $this->priceCalculationHelper = $priceCalculationHelper;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getNetPriceForProduct(ProductAbstractTransfer $productTransfer): ProductAbstractTransfer
    {
        $netPrice = $this->priceCalculationHelper->getNetValueFromPrice(
            $productTransfer->getPrice(),
            $productTransfer->getTaxRate()
        );

        $productTransfer->setNetPrice($netPrice);

        return $productTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function getTaxAmountForProduct(ProductAbstractTransfer $productTransfer): ProductAbstractTransfer
    {
        $taxAmount = $this->priceCalculationHelper->getTaxValueFromPrice(
            $productTransfer->getPrice(),
            $productTransfer->getTaxRate()
        );

        $productTransfer->setTaxAmount($taxAmount);

        return $productTransfer;
    }
}
