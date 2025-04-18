<?php
$size = 10;

// Start the table
echo '<table border="1">';

// Print the table headers
echo '<tr>';
echo '<th>x</th>';
for ($i = 1; $i <= $size; $i++) {
  echo '<th>' . $i . '</th>';
}
echo '</tr>';

// Print the table rows
for ($i = 1; $i <= $size; $i++) {
  echo '<tr>';
  echo '<th>' . $i . '</th>';
  for ($j = 1; $j <= $size; $j++) {
    echo '<td>' . $i * $j . '</td>';
  }
  echo '</tr>';
}

// End the table
echo '</table>';