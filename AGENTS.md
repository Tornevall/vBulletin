# Repository guidance

## Scope

This repository contains Tornevall-maintained vBulletin 6.2.x support assets. Besides language resources, it may contain small deployable integration bridges that are deliberately kept separate from vendor core files.

## Tools SSO bridge

- `tools-sso.php` is a narrow authenticated handoff from an already logged-in vBulletin member to Tools.
- Never copy, commit, log, redirect, or otherwise expose forum passwords, password hashes, salts, reusable session identifiers, cookies, API keys, or shared secrets.
- The bridge must trust the current vBulletin server-side session only. It must not accept a user id, username, or email supplied by the browser as proof of identity.
- Assertions must be short-lived, signed server-side, tied to the Tools-generated `state`, and intended only for the `tools` audience.
- Keep the bridge additive. Do not modify or redistribute vBulletin vendor core files in this repository for the integration.
- Configuration values and secrets belong in the deployment environment, never in tracked files.
- Update README and CHANGELOG when the integration contract changes.
