<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

/**
 * Module information
 */
$aModule = [
    'id' => 'fa_perlinevat',
    'title' => 'Per-Line-VAT module for OXID eShop',
    'description' => 'The module changes the OXID default grouped VAT calculation to per-line calculation',
    'thumbnail' => 'pictures/logo.png',
    'version' => '1.0.0',
    'author' => 'MB Arbatos Klubas',
    'url' => 'https://github.com/Fresh-Advance/OXID-Per-Line-VAT',
    'email' => 'anton@fedurtsya.com',
    'extend' => [
        \OxidEsales\Eshop\Core\PriceList::class => \FreshAdvance\OXIDPerLineVAT\Eshop\Core\PriceList::class
    ],
];
