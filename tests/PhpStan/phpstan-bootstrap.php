<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

class_alias(
    \OxidEsales\Eshop\Application\Model\User::class,
    \FreshAdvance\OXIDPerLineVAT\Extension\Model\User_parent::class
);

class_alias(
    \OxidEsales\Eshop\Application\Controller\StartController::class,
    \FreshAdvance\OXIDPerLineVAT\Extension\Controller\StartController_parent::class
);

class_alias(
    \OxidEsales\Eshop\Application\Model\Basket::class,
    \FreshAdvance\OXIDPerLineVAT\Extension\Model\Basket_parent::class
);

class_alias(
    \OxidEsales\Eshop\Application\Controller\ArticleDetailsController::class,
    \FreshAdvance\OXIDPerLineVAT\ProductVote\Controller\ArticleDetailsController_parent::class
);

class_alias(
    \OxidEsales\Eshop\Application\Component\Widget\ArticleDetails::class,
    \FreshAdvance\OXIDPerLineVAT\ProductVote\Widget\ArticleDetails_parent::class
);
