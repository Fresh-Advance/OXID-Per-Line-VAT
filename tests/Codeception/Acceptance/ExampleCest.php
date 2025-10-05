<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\OXIDPerLineVAT\Tests\Codeception\Acceptance;

use OxidEsales\Codeception\Module\Translation\Translator;
use FreshAdvance\OXIDPerLineVAT\Tests\Codeception\Support\AcceptanceTester;

/**
 * @group fa_perlinevat
 * @group fa_perlinevat_startpage
 */
final class ExampleCest
{
    public function testCanOpenShopStartPage(AcceptanceTester $I): void
    {
        $I->wantToTest('that codeception tests are working');

        $I->openShop();
        $I->waitForPageLoad();

        $I->see(Translator::translate('HOME'));
    }
}
