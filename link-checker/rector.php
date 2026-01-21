<?php

declare(strict_types=1);

use Contao\Rector\Set\SetList;
use Rector\Config\RectorConfig;
use Rector\Php81\Rector\Array_\FirstClassCallableRector;

return RectorConfig::configure()
    ->withSets([SetList::CONTAO])
    ->withPaths([
        __DIR__.'/src',
    ])
    ->withSkip([
        FirstClassCallableRector::class,
    ])
    ->withParallel()
    ->withCache(sys_get_temp_dir().'/rector_cache')
;
