# Changelog

## 2026-08-28

- Hardened the Tools SSO handoff so the callback can be bound to the Tools browser session that initiated the flow.
- Reduced the signed redirect assertion to the stable forum user id plus state, audience, timestamps and nonce; username and email are resolved by Tools from the trusted forum integration instead of being copied into the callback URL.
- Switched the handoff back to a top-level HTTPS redirect compatible with the normal SameSite=Lax Tools session policy.
- Updated README and bridge documentation for the deployable SSO integration.

## 2026-08-27

- Added `tools-sso.php`, a short-lived signed SSO handoff for authenticated vBulletin users entering Tools.
- Added deployment and security documentation for the Tools SSO bridge.
- Added repository guidance that keeps SSO secrets, passwords and reusable forum sessions out of tracked files and redirects.
