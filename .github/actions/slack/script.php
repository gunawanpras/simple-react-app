<?php

require_once 'vendor/autoload.php';
Requests::register_autoloader();

echo "::debug ::Send request to a slack\n";

try {
    $response = Requests::post(
        $_ENV['INPUT_SLACK_WEBHOOK']
        , [
            'Content-Type' => 'application/json'
        ],
        json_encode([
            'blocks' => [
              0 => [
                'type' => 'section',
                'text' => [
                  'type' => 'mrkdwn',
                  'text' => $_ENV['INPUT_MESSAGE'],
                ],
              ],
              1 => [
                'type' => 'section',
                'fields' => [
                  0 => [
                    'type' => 'mrkdwn',
                    'text' => "*Repository:* ${_ENV["GITHUB_REPOSITORY"]}",
                  ],
                  1 => [
                    'type' => 'mrkdwn',
                    'text' => "*Event:* ${_ENV["GITHUB_EVENT_NAME"]}",
                  ],
                  2 => [
                    'type' => 'mrkdwn',
                    'text' => "*Ref:* ${_ENV["GITHUB_REF"]}",
                  ],
                  3 => [
                    'type' => 'mrkdwn',
                    'text' => "*SHA:* ${_ENV["GITHUB_SHA"]}",
                  ]
                ],
              ],
              2 => [
                'type' => 'actions',
                'elements' => [
                  0 => [
                    'type' => 'button',
                    'text' => [
                      'type' => 'plain_text',
                      'emoji' => true,
                      'text' => 'Approve',
                    ],
                    'style' => 'primary',
                    'value' => 'click_me_123',
                  ],
                  1 => [
                    'type' => 'button',
                    'text' => [
                      'type' => 'plain_text',
                      'emoji' => true,
                      'text' => 'Deny',
                    ],
                    'style' => 'danger',
                    'value' => 'click_me_123',
                  ],
                ],
              ],
            ],
          ])
    );
    
    if (isset($response->success)) {
        if (!$response->success) {
            throw new Exception("Error");            
        }
    }
    
    echo "::group::PRINT RESPONSE TO CONSOLE\n";
    var_dump($response);
    echo "::endgroup::\n";

    echo $response->body;

} catch (\Throwable $th) {
    print_r($th);
    exit;
}