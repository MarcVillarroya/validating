<?php
$db = new mysqli('127.0.0.1','marcvillarroya1','marcvillarroya1','carsite');
if($db->connect_errno){
    echo "error";
}
mysqli_select_db($db,'carsite') or die(mysqli_error($db));
if (isset($_GET['error']) && $_GET['error'] != '') {
    echo '<div id="error">' . $_GET['error'] . '</div>';
    }
if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
            car_id, car_name, car_type, car_year, car_brand, car_configuration
        FROM
            car
        WHERE
        car_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    
    $row = mysqli_fetch_assoc($result);
    extract($row);

    $car_name =  $row['car_name'];
    $car_year = $row['car_year'];
    $car_brand = $row['car_brand'];
    $car_type = $row['car_type'];
    $car_configuration = $row['car_configuration'];
} else {
    //set values to blank
    $car_name = '';
    $car_year = date('Y');
    $car_brand = '';
    $car_type = '';
    $car_configuration = '';
}
?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> Car</title>
 </head>
 <body>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=car"
   method="post">
   <table>
    <tr>
     <td>Car name</td>
     <td><input type="text" name="car_name"
      value="<?php echo $car_name; ?>"/></td>
      
    </tr>
     <tr>
     <td>Car brand</td>
     <td><input type="text" name="car_brand"
      value="<?php echo $car_brand; ?>"/></td>
    </tr><tr>
     <td>Car type</td>
     <td><select name="car_type">

<?php
// select the movie type information
$query = 'SELECT
        cartype_id, cartype_label
    FROM
        cartype
    ORDER BY
        cartype_label';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
// populate the select options with the results
while ($row = mysqli_fetch_assoc($result)) {
    //foreach ($row as $value) {
        if ($row['cartype_id'] == $car_type) {
            echo '<option value="' . $row['cartype_id'] .
                '" selected="selected">';
        } else {
            echo '<option value="' . $row['cartype_id'] .
            '">';
        }
        echo $row['cartype_label'] . '</option>';
   // }
}
?>
      </select></td>
    </tr><tr>
     <td>Car configuration</td>
     <td><select name="car_configuration">



<?php
// select the movie type information
$query = 'SELECT
        carconfig_id, carconfig_label
    FROM
        carconfig
    ORDER BY
        carconfig_label';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
// populate the select options with the results    


while ($row = mysqli_fetch_assoc($result)) {
    var_dump($row);
    //foreach ($row as $value) {
        if ($row['carconfig_id'] == $car_configuration) {
            echo '<option value="' . $row['carconfig_id'] .
                '" selected="selected">';
        } else {
            echo '<option value="' . $row['carconfig_id'] . '">';
        }
        echo $row['carconfig_label'] . '</option>';
   // }
}
?>
      </select></td>
    </tr><tr>
     <td>Car Year</td>
     <td><select name="car_year">

    
<?php
// populate the select options with years
for ($yr = date("Y"); $yr >= 1970; $yr--) {
    if ($yr == $car_year) {
        echo '<option value="' . $yr . '" selected="selected">' . $yr .
            '</option>';
    } else {
        echo '<option value="' . $yr . '">' . $yr . '</option>';
    }
}
?>
      </select></td>
    </tr><tr>
     <td colspan="2" style="text-align: center;">
<?php
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="car_id" />';
}
?>
      <input type="submit" name="submit"
       value="<?php echo ucfirst($_GET['action']); ?>" />
     </td>
    </tr>
   </table>
  </form>
 </body>
</html>