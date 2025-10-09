<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\OXIDPerLineVAT\Tests\Integration\Service;

use FreshAdvance\OXIDPerLineVAT\Service\PriceListVatCalculator;
use OxidEsales\Eshop\Core\Price;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class PriceListVatCalculatorTest extends IntegrationTestCase
{
    #[DataProvider('getVatInformationDataProvider')]
    public function testGetVatInformation(
        array $prices,
        bool $isNettoMode,
        array $expectedVatInformation,
    ) {
        $utils = Registry::getUtils();

        $sut = new PriceListVatCalculator($utils);

        $result = $sut->getVatInformation($prices, $isNettoMode);
        $this->assertSame($expectedVatInformation, $result);
    }

    public static function getVatInformationDataProvider(): \Generator
    {
        yield 'netto single VAT rate' => [
            'prices' => [
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 20.97,
                    'getVat' => 19.0,
                ]),
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 25.17,
                    'getVat' => 19.0,
                ]),
            ],
            'isNettoMode' => true,
            'expectedVatInformation' => [
                '19' => 3.98 + 4.78,
            ]
        ];

        yield 'netto mixed VAT rates' => [
            'prices' => [
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 10.00,
                    'getVat' => 7.0,
                ]),
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 20.00,
                    'getVat' => 19.0,
                ]),
            ],
            'isNettoMode' => true,
            'expectedVatInformation' => [
                '7' => 0.70,
                '19' => 3.80,
            ]
        ];

        // Unique netto case: zero price
        yield 'netto zero price' => [
            'prices' => [
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 0.00,
                    'getVat' => 19.0,
                ]),
            ],
            'isNettoMode' => true,
            'expectedVatInformation' => [
                '19' => 0.00,
            ]
        ];

        yield 'brutto single VAT rate' => [
            'prices' => [
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 24.95,
                    'getVat' => 19.0,
                ]),
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 59.9,
                    'getVat' => 19.0,
                ]),
            ],
            'isNettoMode' => false,
            'expectedVatInformation' => [
                '19' => 3.98 + 9.56,
            ]
        ];

        yield 'brutto mixed VAT rates' => [
            'prices' => [
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 10.70,
                    'getVat' => 7.0,
                ]),
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 23.80,
                    'getVat' => 19.0,
                ]),
            ],
            'isNettoMode' => false,
            'expectedVatInformation' => [
                '7' => 0.70,
                '19' => 3.80,
            ]
        ];

        // Unique brutto case: zero price
        yield 'brutto zero price' => [
            'prices' => [
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 0.00,
                    'getVat' => 19.0,
                ]),
            ],
            'isNettoMode' => false,
            'expectedVatInformation' => [
                '19' => 0.00,
            ]
        ];

        yield 'same - netto per-line vs total VAT rounding' => [
            'prices' => [
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 0.99,
                    'getVat' => 19.0,
                ]),
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 1.01,
                    'getVat' => 19.0,
                ]),
            ],
            'isNettoMode' => true,
            // Per-line: round(0.99*0.19,2) + round(1.01*0.19,2) = 0.19 + 0.19 = 0.38
            // Total: round((0.99+1.01)*0.19,2) = round(2.00*0.19,2) = 0.38
            'expectedVatInformation' => [
                '19' => 0.38,
            ]
        ];

        yield 'different - netto per-line vs total VAT rounding' => [
            'prices' => [
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 0.33,
                    'getVat' => 19.0,
                ]),
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 0.33,
                    'getVat' => 19.0,
                ]),
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 0.34,
                    'getVat' => 19.0,
                ]),
            ],
            'isNettoMode' => true,
            // Per-line: round(0.33*0.19,2)=0.06, round(0.33*0.19,2)=0.06, round(0.34*0.19,2)=0.06; sum=0.18
            // Total: round(1.00*0.19,2)=0.19
            'expectedVatInformation' => [
                '19' => 0.18,
            ]
        ];

        yield 'different - brutto per-line vs total VAT rounding' => [
            'prices' => [
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 0.39,
                    'getVat' => 19.0,
                ]),
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 0.39,
                    'getVat' => 19.0,
                ]),
                self::createConfiguredStub(Price::class, [
                    'getPrice' => 0.40,
                    'getVat' => 19.0,
                ]),
            ],
            'isNettoMode' => false,
            // Per-line: round(0.39*19/119,2)=0.06, round(0.39*19/119,2)=0.06, round(0.40*19/119,2)=0.06; sum=0.18
            // Total: round(1.18*19/119,2)=0.19
            'expectedVatInformation' => [
                '19' => 0.18,
            ]
        ];
    }
}
