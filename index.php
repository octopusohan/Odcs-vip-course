<?php
// Handling form submission and API fetch
$number = '';
$response = null;

if (isset($_POST['getInfo'])) {
    $number = $_POST['number'];
    $api_url = "https://api.pikaapis.my.id/nagad.php?msisdn=" . urlencode($number);
    
    // Use file_get_contents or cURL to fetch the API response
    $response = @file_get_contents($api_url);
    
    if ($response === FALSE) {
        $response = "Failed to fetch data from the API.";
    }
    else {
        // Decode JSON response into an associative array
        $response = json_decode($response, true);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylish API Fetcher with PHP</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #000;
            font-family: 'Arial', sans-serif;
            color: #fff;
        }

        .container {
            text-align: center;
            background: rgba(0, 0, 0, 0.7);
            padding: 30px 25px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
            max-width: 380px;
            width: 100%;
            color: #fff;
        }

        h2 {
            font-size: 2em;
            margin-bottom: 1em;
            font-weight: 700;
            color: #ff0000;
            text-shadow: 0 0 10px #ff0000, 0 0 20px #ff0000;
        }

        input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2);
            color: #00f;
            font-size: 1em;
            outline: none;
            transition: background 0.3s;
            text-shadow: 0 0 5px #00f, 0 0 10px #00f;
        }

        input[type="number"]::placeholder {
            color: #ddd;
        }

        input[type="number"]:focus {
            background: rgba(255, 255, 255, 0.3);
        }

        button {
            width: 48%;
            padding: 12px;
            margin: 5px 1%;
            font-size: 1em;
            font-weight: bold;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
            text-shadow: 0 0 5px #fff, 0 0 10px #fff;
        }

        .btn-info {
            background-color: #ff0000;
            text-shadow: 0 0 10px #ff0000, 0 0 20px #ff0000;
        }

        .btn-info:hover {
            background-color: #d40000;
            text-shadow: 0 0 10px #d40000, 0 0 20px #d40000;
        }

        .btn-join {
            background-color: #00bfff;
            text-shadow: 0 0 10px #00bfff, 0 0 20px #00bfff;
        }

        .btn-join:hover {
            background-color: #007bb5;
            text-shadow: 0 0 10px #007bb5, 0 0 20px #007bb5;
        }

        .response-box {
            margin-top: 20px;
            padding: 15px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 8px;
            font-size: 1em;
            line-height: 1.5;
            text-align: left;
            color: #00bfff;
            text-shadow: 0 0 5px #00bfff, 0 0 10px #00bfff;
        }

        .response-box p {
            margin: 8px 0;
        }

        .response-key {
            font-weight: bold;
            color: #ff0000;
            text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000;
        }

        .response-value {
            color: #fff;
            text-shadow: 0 0 5px #fff, 0 0 10px #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🌟 Get Info & Join Channel 🌟</h2>
        <form method="POST">
            <input type="number" name="number" placeholder="📞 Enter Number Here" required value="<?= htmlspecialchars($number) ?>">
            <div>
                <button class="btn-info" type="submit" name="getInfo">🔍 Get Info</button>
                <button class="btn-join" type="button" onclick="window.open('https://t.me/octodarkcybersquad1', '_blank')">💬 Join Channel</button>
            </div>
        </form>

        <?php if ($response && is_array($response)): ?>
            <div class="response-box">
                <p><span class="response-key">👤Name:</span> <span class="response-value"><?= htmlspecialchars($response['name']) ?></span></p>
                <p><span class="response-key">🆔User ID:</span> <span class="response-value"><?= htmlspecialchars($response['userId']) ?></span></p>
                <p><span class="response-key">📌Status:</span> <span class="response-value"><?= htmlspecialchars($response['status']) ?></span></p>
                <p><span class="response-key">🔍User Type:</span> <span class="response-value"><?= htmlspecialchars($response['userType']) ?></span></p>
                <p><span class="response-key">💼RB Base:</span> <span class="response-value"><?= htmlspecialchars($response['rbBase'] ? 'Yes' : 'No') ?></span></p>
                <p><span class="response-key">✅Verification Status:</span> <span class="response-value"><?= htmlspecialchars($response['verificationStatus']) ?></span></p>
                <p><span class="response-key">⚙️Execution Status:</span> <span class="response-value"><?= htmlspecialchars($response['executionStatus'] ?? 'N/A') ?></span></p>
            </div>
        <?php elseif ($response): ?>
            <div class="response-box">
                <p><span class="response-key">Error:</span> <span class="response-value"><?= htmlspecialchars($response) ?></span></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>