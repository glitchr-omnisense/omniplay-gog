# Changelog

## Unreleased (1.x)

### Changed
- 2026-11-10: the usage policy declared as data, in `policy.json` (omnisense/contracts' schema, named in `composer.json`'s `extra.omnisense.policy`). The provider implements `DeclaresUsagePolicyInterface` and gives the policy to its Capabilities. The factory hands the provider's Backoff to its JsonClient, so that a 429 and its Retry-After hold every call. `Tests/PolicyTest.php`.
- `omnigame/gog` is now `omniplay/gog` (2026-11-09: the omnigame family merged into omniplay, this
  repository's history kept, from omnigame-gog at b2951ff): the namespace `Omniplay\Gog`, requiring
  `omnisense/omniplay`; the default User-Agent `omniplay/1.0
  (+https://github.com/glitchr-omnisense/omniplay)`.
