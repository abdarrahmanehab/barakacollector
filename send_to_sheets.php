<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $question = htmlspecialchars($_POST['question']);
    $date = date('Y-m-d H:i:s'); // Current date and time
    
    // Google Sheets Web App URL (you'll need to replace this with your actual Web App URL)
    // ===== PASTE YOUR WEB APP URL HERE =====
    $webAppUrl = 'https://script.google.com/macros/s/AKfycbySkvGSehlPmIVYKBtAzjQhQMkdaWbnno9EWczntRiku3TQo4xXuwzHShqg9sR7JnbWjA/exec';
    // ===== PASTE YOUR WEB APP URL ABOVE =====
    
    // Check if URL has been updated
    if (strpos($webAppUrl, 'YOUR_GOOGLE_APPS_SCRIPT_WEB_APP_URL') !== false) {
        echo "<h3>Setup Required!</h3>";
        echo "<p>You need to:</p>";
        echo "<ol>";
        echo "<li>Go to <a href='https://script.google.com/' target='_blank'>Google Apps Script</a></li>";
        echo "<li>Create a new project and paste the code from google_apps_script.js</li>";
        echo "<li>Deploy it as a Web App</li>";
        echo "<li>Copy the Web App URL and replace 'YOUR_GOOGLE_APPS_SCRIPT_WEB_APP_URL' in send_to_sheets.php</li>";
        echo "</ol>";
        echo "<p>The URL should look like: https://script.google.com/macros/s/ABC123.../exec</p>";
        exit;
    }
    
    // Data to send
    $postData = array(
        'name' => $name,
        'phone' => $phone,
        'question' => $question,
        'date' => $date
    );
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $webAppUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // Execute the request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if (curl_error($ch)) {
        echo "Error: " . curl_error($ch);
    } else if ($httpCode == 200) {
        echo "Data successfully sent to Google Sheets!";
    } else {
        echo "Failed to send data. HTTP Code: " . $httpCode;
    }
    
    curl_close($ch);
} else {
    echo "Invalid request.";
}
?>