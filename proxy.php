<?php
header("Access-Control-Allow-Origin: *");
header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline';");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: SAMEORIGIN");
header("Referrer-Policy: no-referrer");
header("Permissions-Policy: geolocation=(), microphone=(), camera=()");

function isValidDomain($domain)
{
    return (bool) preg_match('/^(?!:\/\/)([a-zA-Z0-9-_]+\.)*[a-zA-Z0-9][a-zA-Z0-9-_]+\.[a-zA-Z]{2,11}?$/', $domain);
}

$domain = $_GET["domain"] ?? '';

if (!isValidDomain($domain)) {
    echo json_encode(['error' => 'Invalid domain']);
    exit;
}

$url = "https://crt.sh/?q=" . urlencode($domain) . "&output=json";

try {
    $ch = curl_init();
    if (!$ch) {
        throw new Exception("cURL not supported on this server");
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, generateRandomUserAgent());
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Disable SSL verification
    $data = curl_exec($ch);
    if (curl_errno($ch)) {
        throw new Exception(curl_error($ch));
    }
    curl_close($ch);

    $certificates = json_decode($data, true);
    $subdomains = [];

    foreach ($certificates as $cert) {
        if (isset($cert['name_value'])) {
            $domains = explode("\n", $cert['name_value']);
            foreach ($domains as $domain) {
                if (isValidDomain($domain) && !in_array($domain, $subdomains)) {
                    $subdomains[] = $domain;
                }
            }
        }
    }

    echo json_encode(array_values(array_unique($subdomains)));
} catch (Exception $e) {
    echo json_encode(['error' => 'Caught exception: ' . $e->getMessage()]);
}

function generateRandomUserAgent()
{
    $userAgents = array(
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36",
        "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:96.0) Gecko/20100101 Firefox/96.0",
        "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36",
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36",
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:96.0) Gecko/20100101 Firefox/96.0"
    );
    return $userAgents[array_rand($userAgents)];
}