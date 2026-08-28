# Tools SSO bridge

`tools-sso.php` provides a narrow handoff from an already authenticated vBulletin 6.2.x member to Tools.

## Contract

- The bridge reads identity only from the current server-side vBulletin session.
- Browser-supplied user ids, usernames and email addresses are never accepted as identity proof.
- Tools creates a one-time `state` before redirecting to the forum and binds that state to the Tools browser session that initiated the flow.
- The bridge returns a short-lived signed assertion containing only the stable forum `userid`, audience, issue/expiry timestamps, nonce and the same `state`.
- Username and email are deliberately not copied into the redirect assertion. Tools resolves them from its trusted direct forum integration after the signed stable `userid` has been verified.
- The assertion never contains passwords, password hashes, salts, cookies or reusable session identifiers.
- The callback is a top-level HTTPS GET redirect so the initiating Tools session cookie can participate in browser-session validation under the normal SameSite=Lax policy.
- Tools verifies the signature, lifetime, audience, state and initiating browser-session binding before establishing a Tools session.

## Deployment configuration

The bridge reads two deployment environment values:

- `TOOLS_SSO_SHARED_SECRET` - shared signing secret. Keep this outside the repository.
- `TOOLS_SSO_CALLBACK_URL` - optional Tools callback URL override.

`tools-sso.php` is intended to be deployed in the vBulletin web root so it can load the normal forum bootstrap and current authenticated session.

## Failure behavior

Unauthenticated visitors are redirected to the forum login flow. Missing configuration, invalid state or assertion-generation failures fail closed. Secrets, reusable forum session material, usernames and email addresses must never be placed in the SSO redirect assertion.
