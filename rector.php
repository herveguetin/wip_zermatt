<?php

declare(strict_types=1);

use Magento2\Rector\Src\ReplaceMbStrposNullLimit;
use Magento2\Rector\Src\ReplaceNewDateTimeNull;
use Magento2\Rector\Src\ReplacePregSplitNullLimit;
use Rector\CodeQuality\Rector\ClassMethod\OptionalParametersAfterRequiredRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Php80\Rector\Class_\StringableForToStringRector;
use Rector\Php80\Rector\ClassMethod\FinalPrivateToPrivateVisibilityRector;
use Rector\Php80\Rector\ClassMethod\SetStateToStaticRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;


return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->phpVersion(PhpVersion::PHP_82);
    $rectorConfig->sets([
        SetList::PHP_82,
        LevelSetList::UP_TO_PHP_81,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::DEAD_CODE,
        SetList::TYPE_DECLARATION,
        SetList::STRICT_BOOLEANS,
        SetList::DEAD_CODE
    ]);

    $rectorConfig->rule(FinalPrivateToPrivateVisibilityRector::class);
    $rectorConfig->rule(OptionalParametersAfterRequiredRector::class);
    $rectorConfig->rule(SetStateToStaticRector::class);
    $rectorConfig->rule(StringableForToStringRector::class);
    $rectorConfig->rule(ReplacePregSplitNullLimit::class);
    $rectorConfig->rule(ReplaceMbStrposNullLimit::class);
    $rectorConfig->rule(ReplaceNewDateTimeNull::class);
};
