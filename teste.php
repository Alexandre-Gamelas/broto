<?php
$fb = new Facebook\Facebook([
    'app_id' => '308835103377791',
    'app_secret' => '5f7addc397884f165d3bf75ebcfd1a7b',
    'default_graph_version' => 'v2.2',
]);

try {
    // Returns a `FacebookFacebookResponse` object
    $response = $fb->get(
        '/1648707125349333/events',
        '{access-token}'
    );
} catch(FacebookExceptionsFacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
$graphNode = $response->getGraphNode();