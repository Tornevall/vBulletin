# Tools SSO bridge

`tools-sso.php` provides a narrow handoff from an already authenticated vBulletin 6.2.x member to Tools.

## Contract

- The bridge reads identity only from the current server-side vBulletin session.
- Browser-supplied user ids, usernames and email addresses are never accepted as identity proof.
- Tools creates a one-time `state` before redirecting to the forum.
- The bridge returns a short-lived signed assertion containing the stable forum `userid`, username, email, audience, issue/expiry timestamps, nonce and the same `state`.
- The assertion never contains passwords, password hashes, salts, cookies or reusable session identifiers.
- Tools verifies the signature, lifetime, audience and state before establishing a Tools session.

## Deployment configuration

The bridge reads two deployment environment values:

- `TOOLS_SSO_SHARED_SECRET` - shared signing secret. Keep this outside the repository.
- `TOOLS_SSO_CALLBACK_URL` - optional Tools callback URL override.

`tools-sso.php` is intended to be deployed in the vBulletin web root so it can load the normal forum bootstrap and current authenticated session.

## Failure behavior

Unauthenticated visitors are redirected to the forum login flow. Missing configuration, invalid state or assertion-generation failures fail closed. Secrets and reusable forum session material must never be logged or placed in redirect parameters.
