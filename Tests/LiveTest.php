<?php

namespace Omniplay\Gog\Tests;

use Omniplay\Gog\GogFactory;
use Omniplay\Gog\GogProvider;
use Omniplay\Model\GameRef;
use Omniplay\Model\Query;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

/**
 * GOG itself, gently (three requests): a product, its price, a search.
 * `docker compose run --rm omniplay live`; never in the default run.
 */
#[Group('live')]
final class LiveTest extends TestCase
{
    public function testTheCatalogue(): void
    {
        $provider = (new GogFactory(HttpClient::create(['timeout' => 30])))->create(['user_agent' => 'omniplay-tests/1.0 (+https://github.com/glitchr-omnisense/omniplay)']);
        self::assertInstanceOf(GogProvider::class, $provider);

        $game = $provider->game(GameRef::gog(1207658924), 'en', 'US');
        self::assertNotNull($game);
        self::assertSame(['The Witcher: Enhanced Edition', 'USD'], [$game->title, $game->price?->currency]);
        self::assertContains('1207658924', array_map(static fn ($g) => $g->identifiers->get('gog'), $provider->search(new Query('witcher enhanced'))));
    }
}
