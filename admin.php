<?php
$db = new mysqli('127.0.0.1','marcvillarroya1','marcvillarroya1','carsite');
if($db->connect_errno){
    echo "error";
}
mysqli_select_db($db,'carsite') or die(mysqli_error($db));
?>
<html>
 <head>
  <title>car database</title>
  <style type="text/css">
   th { background-color: #999;}
   .odd_row { background-color: #EEE; }
   .even_row { background-color: #FFF; }
  </style>
 </head>
 <body>
 <table style="width:100%;">
  <tr>
   <th colspan="2">Cars<a href="car.php?action=add">[ADD]</a></th>
  </tr>
<?php
$query = 'SELECT * FROM car';
$result = mysqli_query($db, $query) or die (mysqli_error($db));
$odd = true;
while ($row = mysqli_fetch_assoc($result)) {
    echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row">';
    $odd = !$odd; 
    echo '<td style="width:75%;">'; 
    echo $row['car_name'];
    echo '</td><td>';
    echo ' <a href="car.php?action=edit&id=' . $row['car_id'] . '"> [EDIT]</a>'; 
    echo ' <a href="delete.php?type=car&id=' . $row['car_id'] . '"> [DELETE]</a>';
    echo '</td></tr>';
}
?>
  <tr>
    <th colspan="2">Car configuration <a href="carconfig.php?action=add"> [ADD]</a></th>
  </tr>
<?php
$query = 'SELECT * FROM carconfig';
$result = mysqli_query($db, $query) or die (mysqli_error($db));
$odd = true;
while ($row = mysqli_fetch_assoc($result)) {
    echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row">';
    $odd = !$odd; 
    echo '<td style="width: 25%;">'; 
    echo $row['carconfig_label'];
    echo '</td><td>';
    echo ' <a href="carconfig.php?action=edit&id=' . $row['carconfig_id'] .
        '"> [EDIT]</a>'; 
    echo ' <a href="delete.php?type=carconfig&id=' . $row['carconfig_id'] .
        '"> [DELETE]</a>';
    echo '</td></tr>';
}
?>
  </table>
 </body>
</html>