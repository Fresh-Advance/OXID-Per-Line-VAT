<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\OXIDPerLineVAT\Service;

use OxidEsales\Eshop\Core\Price;

interface PriceListVatCalculatorInterface
{
    /**
     * @param array<Price> $prices
     * @return array<numeric-string, float>
     */
    public function getVatInformation(array $prices, bool $isNettoMode): array;
}
