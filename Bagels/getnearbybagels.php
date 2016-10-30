<?php
  //yumyum
  $connection = mysqli_connect('mysql.hostinger.co.uk','u986542883_cj1m','rarepepes123','u986542883_bagel');

  $lat = is_number($_POST['lat']);
  $lng = is_number($_POST['long']);
  $radius = is_number($_POST['radius']);

  $result = mysqli_query($connection,"SELECT *, ( 6371 * acos( cos( radians($lat) ) * cos( radians( lat_pos ) ) * cos( radians( lng_pos ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat_pos ) ) ) ) AS distance FROM BAGELS HAVING distance < $radius ORDER BY distance;");


  $rows = array();
  if(mysqli_num_rows($result) == 1){
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    print json_encode($rows);
  }




  //Injection Protection
  function db_quote($value) {
      global $connection;
      return mysqli_real_escape_string($connection,$value);
  }
  function is_number($value){
     if(is_numeric($value)){
      return (float) $value;
     }else{
       exit();
     }
  }
?>

