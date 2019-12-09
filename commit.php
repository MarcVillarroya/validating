<?php
$db = new mysqli('127.0.0.1','marcvillarroya1','marcvillarroya1','carsite');
if($db->connect_errno){
    echo "error";
}
mysqli_select_db($db,'carsite') or die(mysqli_error($db));
?>
<html>
 <head>
  <title>Commit</title>
 </head>
 <body>
<?php
switch ($_GET['action']) {
case 'add':
    switch ($_GET['type']) {
    case 'car':
        $error = array();
        $sum = 0;
 
                if(empty($_POST['car_name'])){
                    $error[] = urlencode('Introduce el nombre del coche.');
                    $sum= $sum + 1;
                }
                if(is_numeric($_POST['car_name'])){
                    $error[] = urlencode('El nombre del coche no puede ser un numero.');
                    $sum= $sum + 1;
                }
                $nombre = $_POST['car_name'];
                $minombre = $nombre;
                $findme = '<';
                $pos = strpos($minombre, $findme);
                if($pos !== false){
                    $sum= $sum + 1;
                    $error[] = urlencode('El nombre del coche no puede contener el signo < !!.');
                }
                $minombre = $nombre;
                $findme = '>';
                $pos = strpos($minombre, $findme);
                if($pos !== false){
                    $sum= $sum + 1;
                    $error[] = urlencode('El nombre del coche no puede contener el signo > !!.');
                }

                if(empty($_POST['car_brand'])){
                    $error[] = urlencode('Introduce la marca del coche.');
                }
                if(is_numeric($_POST['car_brand'])){
                    $error[] = urlencode('La marca del coche no puede ser un numero.');
                }
                $nombre = $_POST['car_brand'];
                $minombre = $nombre;
                $findme = '<';
                $pos = strpos($minombre, $findme);
                if($pos !== false){
                    $error[] = urlencode('La marca del coche no puede contener el signo < !!.');
                }
                $minombre = $nombre;
                $findme = '>';
                $pos = strpos($minombre, $findme);
                if($pos !== false){
                    $error[] = urlencode('La marca del coche no puede contener el signo > !!.');
                }

                if(empty($error)){

                  
                    
                        $query = "INSERT INTO car (car_name,car_type ,car_year ,car_brand , car_configuration) VALUES ('" . $_POST['car_name'] . "',
                        " . $_POST['car_type'] . ",
                        " . $_POST['car_year'] . ",
                        '" . $_POST['car_brand'] . "',
                        " . $_POST['car_configuration'] .");";

                 
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        
                            
                          
                }else{
                    header('Location: car.php?action=add&id='.$_POST['car_id'].'&error='.join($error, urlencode('<br/>')));
                }
        

        break;
        
    

    case 'carconfig':
        $error = array();
 
                if(empty($_POST['carconfig_label'])){
                    $error[] = urlencode('Introduce la configuracion del coche.');
                }
                if(is_numeric($_POST['carconfig_label'])){
                    $error[] = urlencode('La configuracion del coche no puede ser un numero.');
                }
                $nombre = $_POST['carconfig_label'];
                $minombre = $nombre;
                $findme = '<';
                $pos = strpos($minombre, $findme);
                if($pos !== false){
                    $error[] = urlencode('La configuracion del coche no puede contener el signo < !!.');
                }
                $minombre = $nombre;
                $findme = '>';
                $pos = strpos($minombre, $findme);
                if($pos !== false){
                    $error[] = urlencode('La configuracion del coche no puede contener el signo > !!.');
                }
                if(empty($error)){
                   
                        $query = "INSERT INTO
                        carconfig
                            (carconfig_label)
                        VALUES
                            ('" . $_POST['carconfig_label'] . "');";

                            $result = mysqli_query($db, $query) or die(mysqli_error($db));
                            
                }else{
                    header('Location: carconfig.php?action=add&id='.$_POST['carconfig_id'].'&error='.join($error, urlencode('<br/>')));
                }
        
                
        break;
        }
    break;

    
                    
    
case 'edit':
    switch ($_GET['type']) {
    case 'car':
        $query = "UPDATE car SET
                car_name = '" . $_POST['car_name'] . "',
                car_year = " . $_POST['car_year'] . ",
                car_brand = '" . $_POST['car_brand'] . "',
                car_type = " . $_POST['car_type'] . ",
                car_configuration = " . $_POST['car_configuration']."
            WHERE
                car_id = " . $_POST['car_id'] . ";";
        break;
    case 'carconfig':
            $query = "UPDATE carconfig SET
            carconfig_label = '" . $_POST['carconfig_label'] . "'
        WHERE
            carconfig_id = " . $_POST['carconfig_id'] . ";";
    break;
    }
    break;
}

?>
  <p>Done!</p>
  <a href="http://localhost/administrativepages/admin.php">Volver al index</a>
 </body>
</html>