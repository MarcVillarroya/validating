<?php
$db = new mysqli('127.0.0.1','marcvillarroya1','marcvillarroya1','carsite');
if($db->connect_errno){
    echo "error";
}
mysqli_select_db($db,'carsite') or die(mysqli_error($db));


if (!isset($_GET['do']) || $_GET['do'] != 1) {
    switch ($_GET['type']) {
    case 'car':
        echo 'Are you sure you want to delete this car?<br/>';
        break;
    case 'config':
        echo 'Are you sure you want to delete this configuration?<br/>';
        break;
    } 
    echo '<a href="' . $_SERVER['REQUEST_URI'] . '&do=1">yes</a> '; 
    echo 'or <a href="admin.php">no</a>';
} else {
    switch ($_GET['type']) {
    case 'carconfig':
        $query = 'UPDATE carconfig SET
                carconfig_label = 0 
            WHERE
                carconfig_id = ' . $_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $query = 'DELETE FROM carconfig 
            WHERE
                carconfig_id = ' . $_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
?>
<p style="text-align: center;">Your person has been deleted.
<a href="admin.php">Return to Index</a></p>
<?php
        break;
    case 'car':
        $query = 'DELETE FROM car 
            WHERE
                car_id = ' . $_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
?>
<p style="text-align: center;">Your car has been deleted.
<a href="admin.php">Return to Index</a></p>
<?php
        break;
    }
}
?>