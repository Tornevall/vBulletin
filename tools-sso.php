<?php

declare(strict_types=1);

// Deploy this file in the vBulletin web root. It relies on vBulletin's normal
// bootstrap and current authenticated server-side session.
require_once __DIR__ . '/global.php';

function toolsSsoBase64UrlEncode(string $value): string
{
    return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
}

function toolsSsoFail(int $status, string $message): void
{
    http_response_code($status);
    header('Content-Type: text/plain; charset=UTF-8');
    echo $message;
    exit;
}

function toolsSsoHtml(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$state = trim((string) ($_GET['state'] ?? ''));
if ($state === '' || strlen($state) < 32 || strlen($state) > 128 || preg_match('/^[A-Za-z0-9]+$/', $state) !== 1) {
    toolsSsoFail(400, 'Invalid SSO state.');
}

$secret = trim((string) getenv('TOOLS_SSO_SHARED_SECRET'));
$callbackUrl = trim((string) getenv('TOOLS_SSO_CALLBACK_URL'));
if ($callbackUrl === '') {
    $callbackUrl = 'https://tools.tornevall.com/login/sso/vbulletin/callback';
}

$callbackParts = parse_url($callbackUrl);
if (
    $secret === ''
    || !is_array($callbackParts)
    || strtolower((string) ($callbackParts['scheme'] ?? '')) !== 'https'
    || trim((string) ($callbackParts['host'] ?? '')) === ''
) {
    toolsSsoFail(503, 'Tools SSO is not configured.');
}

$userInfo = [];
if (class_exists('vB') && method_exists('vB', 'getCurrentSession')) {
    $session = vB::getCurrentSession();
    if ($session && method_exists($session, 'fetch_userinfo')) {
        $userInfo = (array) $session->fetch_userinfo();
    }
}

if (empty($userInfo) && isset($GLOBALS['vbulletin']->userinfo) && is_array($GLOBALS['vbulletin']->userinfo)) {
    $userInfo = $GLOBALS['vbulletin']->userinfo;
}

$userId = (int) ($userInfo['userid'] ?? 0);
$username = trim((string) ($userInfo['username'] ?? ''));
$email = strtolower(trim((string) ($userInfo['email'] ?? '')));

if ($userId <= 0 || $email === '' || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $returnUrl = rawurlencode((string) ($_SERVER['REQUEST_URI'] ?? '/tools-sso.php?state=' . rawurlencode($state)));
    header('Location: /auth/login?url=' . $returnUrl, true, 302);
    exit;
}

$issuedAt = time();
$claims = [
    'userid' => $userId,
    'username' => $username,
    'email' => $email,
    'iat' => $issuedAt,
    'exp' => $issuedAt + 120,
    'aud' => 'tools',
    'state' => $state,
    'nonce' => bin2hex(random_bytes(16)),
];

$json = json_encode($claims, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
if (!is_string($json)) {
    toolsSsoFail(500, 'Could not create SSO assertion.');
}

$payload = toolsSsoBase64UrlEncode($json);
$signature = hash_hmac('sha256', $payload, $secret);

header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-store, max-age=0');
header('Referrer-Policy: no-referrer');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex,nofollow">
    <title>Continue to Tools</title>
</head>
<body>
<form id="tools-sso-handoff" method="post" action="<?= toolsSsoHtml($callbackUrl) ?>">
    <input type="hidden" name="state" value="<?= toolsSsoHtml($state) ?>">
    <input type="hidden" name="payload" value="<?= toolsSsoHtml($payload) ?>">
    <input type="hidden" name="sig" value="<?= toolsSsoHtml($signature) ?>">
    <noscript><button type="submit">Continue to Tools</button></noscript>
</form>
<script>document.getElementById('tools-sso-handoff').submit();</script>
</body>
</html>
