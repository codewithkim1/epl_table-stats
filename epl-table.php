<?php

// Replace YOUR_API_KEY_HERE with your actual API key
$apiKey = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXX';

// Set up the API request headers
$headers = array(
  'X-Auth-Token: ' . $apiKey,
  'Content-Type: application/json',
);

// Set up the API request options
$options = array(
  'http' => array(
    'method' => 'GET',
    'header' => implode("\r\n", $headers),
  ),
);

// Create a stream context for the API request
$context = stream_context_create($options);

// Fetch the EPL table from the API
$table = file_get_contents('https://api.football-data.org/v2/competitions/2021/standings', false, $context);

// Decode the JSON data
$table = json_decode($table, true);

// Extract the data for the teams
$teams = $table['standings'][0]['table'];

// Print the table using Bootstrap and JavaScript
echo '<style>';
echo 'table { font-size: 14px; }';
echo 'th { background-color: #222; color: #fff; }';
echo 'td { border-top: 1px solid #ccc; }';
echo 'tr:nth-child(odd) { background-color: #f2f2f2; }';
echo 'tr:nth-child(even) { background-color: #fff; }';
echo '</style>';
echo '<table class="table table-striped">';
echo '<thead>';
echo '<tr>';
echo '<th scope="col">#</th>';
echo '<th scope="col">Team</th>';
echo '<th scope="col">Played</th>';
echo '<th scope="col">Won</th>';
echo '<th scope="col">Drawn</th>';
echo '<th scope="col">Lost</th>';
echo '<th scope="col">Points</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach ($teams as $i => $team) {
  $position = $i + 1;
  echo '<tr>';
  echo '<th scope="row">' . $position . '</th>';
  echo '<td>' . $team['team']['name'] . '</td>';
  echo '<td>' . $team['playedGames'] . '</td>';
  echo '<td>' . $team['won'] . '</td>';
  echo '<td>' . $team['draw'] . '</td>';
  echo '<td>' . $team['lost'] . '</td>';
  echo '<td>' . $team['points'] . '</td>';
 echo '</tr>';
}
echo '</tbody>';
echo '</table>';

?>
