<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\OXIDPerLineVAT\Eshop\Core;

use FreshAdvance\OXIDPerLineVAT\Service\PriceListVatCalculatorInterface;
use OxidEsales\EshopCommunity\Core\Di\ContainerFacade;

/**
 * @mixin \OxidEsales\Eshop\Core\PriceList
 */
class PriceList extends PriceList_parent
{
    /**
     * @return array<numeric-string, float>
     */
    public function getVatInfo($isNettoMode = true)
    {
        /** @var PriceListVatCalculatorInterface $vatCalculator */
        $vatCalculator = ContainerFacade::get(PriceListVatCalculatorInterface::class);
        return $vatCalculator->getVatInformation($this->_aList, $isNettoMode);
    }
}
