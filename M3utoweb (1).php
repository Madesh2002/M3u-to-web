<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uploadedFile = $_FILES['m3u_file'];
    $url = $_POST['m3u_url'];

    // Process the m3u content from either the uploaded file or the URL
    if (!empty($uploadedFile['tmp_name'])) {
        // If a file is uploaded, process the file content
        $m3uContent = file_get_contents($uploadedFile['tmp_name']);
    } elseif (!empty($url)) {
        // If a URL is provided, fetch and process the URL content
        $m3uContent = file_get_contents($url);
    }

    // Initialize arrays to store channel logos, names, and URLs
    $channelLogos = array();
    $channelNames = array();
    $channelURLs = array();

    // Split the m3u content by lines to get channel information
    $lines = explode("\n", $m3uContent);

    // Loop through the lines to extract channel details
    foreach ($lines as $line) {
        if (strpos($line, '#EXTINF:') !== false) {
            // Extract channel name
            $name = preg_match('/,(.*)/', $line, $matches) ? trim($matches[1]) : '';

            // Look for a logo URL in the line
            $logoUrl = '';
            if (preg_match('/tvg-logo="([^"]+)"/', $line, $matches)) {
                $logoUrl = $matches[1];
            }

            // Extract channel URL from the next line
            $channelURL = trim($lines[array_search($line, $lines) + 1]);

            // Store channel details in arrays
            $channelLogos[] = $logoUrl;
            $channelNames[] = $name;
            $channelURLs[] = $channelURL;
        }
    }
}
?>

<html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
    <title>Dnyanesh | TataPlay</title>
</head>
<body>
    <div class="container" class="search">
        <form method="post" enctype="multipart/form-data">
            <label for="m3u_file">Upload an m3u File:</label>
            <input type="file" id="m3u_file" name="m3u_file"><br>
            <label for="m3u_url">Or Enter m3u URL:</label>
            <input type="text" id="m3u_url" name="m3u_url"><br>
            <input type="submit" value="Submit">
        </form>
    </div>

    <?php
    // Display channel details if they are available
    if (!empty($channelLogos)) {
        for ($i = 0; $i < count($channelLogos); $i++) {
            echo '<div>';
            if (!empty($channelLogos[$i])) {
                echo '<img src="' . $channelLogos[$i] . '" alt="' . $channelNames[$i] . '"><br>';
            }
            echo '<strong>' . $channelNames[$i] . '</strong><br>';
            echo '<a href="' . $channelURLs[$i] . '" target="_blank">Watch Channel</a>';
            echo '</div>';
        }
    }
    ?>
</body>
</html>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="file"],
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        div {
            background-color: #fff;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        strong {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        a {
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>