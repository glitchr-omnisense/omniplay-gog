<?php

namespace Omniplay\Gog\Tests;

use Omniplay\Gog\GogProvider;
use Omniplay\Testing\BareTestCase;

/** omniplay/gog's classes load with omnisense/omniplay and Symfony's HTTP client contracts alone. */
final class BareTest extends BareTestCase
{
    protected static function entryClass(): string
    {
        return GogProvider::class;
    }

    protected static function requiredPackages(): array
    {
        return ['symfony/http-client-contracts'];
    }
}
