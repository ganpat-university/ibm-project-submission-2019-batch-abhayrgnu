<?php
    $secret_key = "6LdqdzIlAAAAAD2N3CMwkaYEOJhmlfHcaZ5nttkA"; // replace "your_secret_key" with your actual Secret key
    $response = $_POST['g-recaptcha-response'];
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array('secret' => $secret_key, 'response' => $response);

    // send a POST request to the reCAPTCHA API
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $json = json_decode($result);

    // check the response from the reCAPTCHA API
    if ($json->success) {
        // reCAPTCHA validation successful
        header('Location: userDashboard.php'); // redirect to dashboard.php
        echo $_SESSION["username"];
        exit;
    } else {
        // reCAPTCHA validation failed
        echo "reCAPTCHA validation failed";
    }   
?>

