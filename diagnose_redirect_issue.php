<?php
/**
 * Diagnose Redirect Issues
 * This script will help identify why URLs are showing redirect errors in Google Search Console
 */

echo "🔍 Diagnosing redirect issues for NepState URLs...\n\n";

// Test URLs
$test_urls = [
    'https://nepstate.com/',
    'https://nepstate.com/classifieds/events',
    'https://nepstate.com/classified/detail/beni-ko-bazar',
    'https://nepstate.com/classified/detail/bara-nepalese-restaurant-and-bar',
    'https://nepstate.com/classified/detail/everest-kitchen'
];

foreach ($test_urls as $url) {
    echo "Testing: $url\n";
    
    // Test with different user agents
    $user_agents = [
        'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
    ];
    
    foreach ($user_agents as $ua) {
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => "User-Agent: $ua\r\n",
                'follow_location' => false, // Don't follow redirects
                'timeout' => 10
            ]
        ]);
        
        $response = @file_get_contents($url, false, $context);
        $headers = $http_response_header ?? [];
        
        echo "  User-Agent: " . substr($ua, 0, 50) . "...\n";
        
        if ($headers) {
            $status_line = $headers[0];
            echo "  Status: $status_line\n";
            
            // Check for redirects
            foreach ($headers as $header) {
                if (stripos($header, 'Location:') !== false) {
                    echo "  Redirect to: $header\n";
                }
            }
        } else {
            echo "  Error: Could not fetch URL\n";
        }
        echo "\n";
    }
    echo "---\n\n";
}

echo "💡 If you see redirects, that explains the Google Search Console errors.\n";
echo "💡 If different user agents get different responses, that's the issue.\n";
?>
