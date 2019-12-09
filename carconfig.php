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
            carconfig_label
        FROM
            carconfig
        WHERE
        carconfig_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {
    //set values to blank
    $carconfig_label = 0;
}
?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> Carconfig</title>
 </head>
 <body>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=carconfig"
   method="post">
   <table>
    <tr>
     <td>Car config label</td>
     <td><input type="text" name="carconfig_label"
      value="<?php echo $carconfig_label; ?>"/></td>
    </tr>
     
    </tr><tr>
     <td colspan="2" style="text-align: center;">
<?php
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="carconfig_id">';
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