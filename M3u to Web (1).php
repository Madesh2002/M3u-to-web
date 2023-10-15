<?php
if (!isset($_POST['m3u_url'])) {
// If the user hasn't submitted the form, display it
?>
<html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
<title>M3U TO WEB</title>
<style>
/* Add CSS styles for the image borders */
.channel-box {
border: 2px solid #333; /* Border styles for the channel boxes */
padding: 10px; /* Padding inside the channel boxes */
margin: 10px; /* Margin between the channel boxes */
display: inline-block; /* Display channels in a row */
text-align: center; /* Center-align text inside the boxes */
background-color: #f0f0f0; /* Background color for the channel boxes */
border-radius: 10px; /* Rounded corners for the boxes */
}
.channel-logo {
border: 2px solid #333; /* Border styles for the channel logos */
max-width: 100%; /* Ensure logos don't exceed the box width */
height: auto; /* Maintain aspect ratio */
}
/* Add background color to the "Watch Channel" link */
.watch-channel-link {
background-color: #007bff; /* Customize the background color */
color: #fff; /* Text color for the link */
padding: 5px 10px; /* Padding inside the link */
text-decoration: none; /* Remove underlines from the link */
border-radius: 5px; /* Rounded corners for the link */
}
/* Add styles for channel groups */
.channel-group {
background-color: #ccc; /* Background color for channel groups */
padding: 10px; /* Padding for channel groups */
margin: 10px 0; /* Margin above and below channel groups */
border-radius: 10px; /* Rounded corners for channel groups */
}
    center h1 {
    color: #ff5733; /* Change heading color to orange-red */
    font-size: 36px; /* Increase font size */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Add a text shadow */
  }
    label {
    display: block; /* Display the label as a block element */
    font-size: 18px; /* Set the font size */
    color: #0073e6; /* Change label color to blue */
    margin-bottom: 10px; /* Add space below the label */
  }
</style>
</head>
<body>
  <center>  <h1> M3U TO WEB </h1> </center>
<div class="container" class="search">
<form method="post">
<label for="m3u_url">Enter m3u URL:</label>
<input type="text" id="m3u_url" name="m3u_url">
<input type="submit" value="Submit">
    <a href="https://chrome.google.com/webstore/detail/native-mpeg-dash-%2B-hls-pl/cjfbmleiaobegagekpmlhmaadepdeedn?utm_source=ext_app_menu" target="_blank" class="link1">Add this Player In Pc</a>
</form>
</div>
</body>
</html>
<?php
} else {
// If the user has submitted the form, process the URL and display the channels
$url = $_POST['m3u_url'];
// Load and parse the m3u file to get channel details
$m3uContent = file_get_contents($url);
// Split the m3u file by lines to get channel information
$lines = explode("\n", $m3uContent);
// Initialize an array to store channel logos
$channelLogos = array();
// Initialize an array to store channel groups
$channelGroups = array();
// Loop through the lines to extract channel details and logos
foreach ($lines as $line) {
if (strpos($line, '#EXTINF:') !== false) {
// Extract channel name and URL
$parts = explode(',', $line);
$name = isset($parts[1]) ? trim($parts[1]) : '';
$url = trim($lines[array_search($line, $lines) + 1]);
// Look for a logo URL in the line
$logoUrl = '';
if (preg_match('/tvg-logo="([^"]+)"/', $line, $matches)) {
$logoUrl = $matches[1];
}
// Look for a group title in the line
$group = '';
if (preg_match('/group-title="([^"]+)"/', $line, $matches)) {
$group = $matches[1];
}
// Store the channel logo URL
$channelLogos[$name] = $logoUrl;
// Organize channels into groups
if (!empty($group)) {
if (!isset($channelGroups[$group])) {
$channelGroups[$group] = array();
}
$channelGroups[$group][] = array('name' => $name, 'url' => $url);
}
}
}
// Display channel groups and channels
foreach ($channelGroups as $groupName => $groupChannels) {
echo '<div class="channel-group">';
echo '<h2>' . $groupName . '</h2>';
foreach ($groupChannels as $channel) {
echo '<div class="channel-box">';
$channelName = $channel['name'];
$channelUrl = $channel['url'];
if (!empty($channelLogos[$channelName])) {
echo '<img class="channel-logo" src="' . $channelLogos[$channelName] . '" alt="' . $channelName . '">';
}
echo '<h3>' . $channelName . '</h3>';
echo '<a class="watch-channel-link" href="' . $channelUrl . '" target="_blank">Watch Channel</a>';
echo '</div>';
}
echo '</div>';
}
}
?>
<style>
/* styles.css */
/* Add CSS styles for the image borders */
.channel-box {
border: 2px solid #333;
padding: 10px;
margin: 10px;
display: inline-block;
text-align: center;
background-color: #f0f0f0;
border-radius: 10px;
}
.channel-logo {
border: 2px solid #333;
max-width: 100%;
height: auto;
}
/* Add background color to the "Watch Channel" link */
.watch-channel-link {
background-color: #007bff;
color: #fff;
padding: 5px 10px;
text-decoration: none;
border-radius: 5px;
}
/* Add styles for channel groups */
.channel-group {
background-color: #ccc;
padding: 10px;
margin: 10px 0;
border-radius: 10px;
}
/* styles.css */
/* Add CSS styles for the M3U URL input field */
#m3u_url {
width: 100%;
padding: 10px;
margin: 10px 0;
border: 2px solid #333;
border-radius: 5px;
font-size: 16px;
}
/* Style the Submit button */
input[type="submit"] {
background-color: #007bff;
color: #fff;
padding: 10px 20px;
border: none;
border-radius: 5px;
font-size: 16px;
cursor: pointer;
}
input[type="submit"]:hover {
background-color: #0056b3;
}
a {
    text-decoration: none; /* Remove underline */
    font-weight: bold; /* Make the text bold */
    padding: 10px 20px; /* Add padding to the link */
    border-radius: 5px; /* Add rounded corners */
    transition: background-color 0.3s, color 0.3s; /* Add a smooth transition */
  }

  /* First link style */
  .link1 {
    background-color: #ff5733; /* Set background color for the first link */
    color: #f1f1f1; /* Set text color for the first link */
  }

  /* Second link style */
  .link2 {
    background-color: Blue; /* Set background color for the second link */
    color: #fff; /* Set text color for the second link */
  }

  /* Hover effect for both links */
  a:hover {
    background-color: #f1f1f1; /* Change background color on hover */
    color: #000; /* Change text color on hover */
  }

.marquee-container {
    background-color: #f1f1f1; /* Background color for the scrolling message */
    padding: 10px; /* Add padding for spacing */
  }

  /* Scrolling message style */
  marquee {
    font-size: 16px; /* Set the font size for the scrolling message */
    color: #ff5733; /* Change text color to orange-red */
    background-color: #0073e6; /* Background color for the scrolling text */
    padding: 5px 10px; /* Add padding to the scrolling text */
  }

</style>
<footer>
  <!-- Footer hyperlink -->
  <a href="https://t.me/Server15000" target="_blank" class="link2">Made by SERVER TV HUB</a>
</footer>
<br>
  <div class="marquee-container">
  <!-- Scrolling message -->
  <marquee behavior="scroll" direction="left">Please note:This not support Mac port m3u url </marquee>
  </div>
   </br>