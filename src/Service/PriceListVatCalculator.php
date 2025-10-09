<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\OXIDPerLineVAT\Service;

use OxidEsales\Eshop\Core\Utils;

class PriceListVatCalculator implements PriceListVatCalculatorInterface
{
    public function __construct(
        private readonly Utils $utils,
    ) {
    }

    public function getVatInformation(array $prices, bool $isNettoMode): array
    {
        $aVatValues = [];
        foreach ($prices as $onePrice) {
            if ($isNettoMode) {
                $calculatedVat = $onePrice->getPrice() * $onePrice->getVat() / 100;
            } else {
                $calculatedVat = $onePrice->getPrice() * $onePrice->getVat() / (100 + $onePrice->getVat());
            }

            $aVatKey = (string)$onePrice->getVat();
            $aVatValues[$aVatKey] = ($aVatValues[$aVatKey] ?? 0)
                + $this->utils->fRound($calculatedVat); // @phpstan-ignore argument.type
        }

        /** @var array<numeric-string, float> $aVatValues */
        return $aVatValues;
    }
}
