<?php

namespace Omniplay\Gog;

use Omniplay\Config;
use Omniplay\Http\JsonClient;
use Omniplay\ProviderFactory;
use Omniplay\ProviderInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * "gog": no key; options locale ("en-US"), country ("US"), currency ("USD":
 * the search's prices; a record's price is the country's own), user_agent,
 * api, catalog.
 */
final class GogFactory extends ProviderFactory
{
    public function __construct(private readonly ?HttpClientInterface $http = null)
    {
    }

    protected function populate(Config $c): void
    {
        $c->defaults([
            'omniplay.factory_name' => 'gog',
            'omniplay.factory_title' => 'GOG',
            'omniplay.required_options' => [],
            'locale' => 'en-US',
            'country' => 'US',
            'currency' => 'USD',
            'user_agent' => 'omniplay/1.0 (+https://github.com/glitchr-omnisense/omniplay)',
            'api' => 'https://api.gog.com',
            'catalog' => 'https://catalog.gog.com',
        ]);
    }

    protected function build(Config $c): ProviderInterface
    {
        return new GogProvider(
            new JsonClient($this->http ?? HttpClient::create(['timeout' => 20]), 'GOG', ['Accept' => 'application/json', 'User-Agent' => (string) $c->string('user_agent')]),
            (string) $c->string('locale'),
            (string) $c->string('country'),
            (string) $c->string('currency'),
            rtrim((string) $c->string('api'), '/'),
            rtrim((string) $c->string('catalog'), '/'),
        );
    }
}
