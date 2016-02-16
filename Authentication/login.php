<?php
  $connection = mysqli_connect('mysql.hostinger.co.uk','u986542883_cj1m','rarepepes123','u986542883_bagel');

  $username = db_quote($_POST['username']);
  $password = db_quote($_POST['password']);

  
  $query = mysqli_query($connection,"SELECT * FROM USERS WHERE username='$username'");

  if(mysqli_num_rows($query) == 1){
    $user_record = mysqli_fetch_assoc($query);
    $hashedPassword = $user_record["password"];
    if(password_verify($password, $hashedPassword)){
      echo "success";
    }else{
      echo "error: incorrect password!";
    }
  }else{
    echo "error: user does not exist!";
  }




  //Injection Protection
  function db_quote($value) {
      global $connection;
      return mysqli_real_escape_string($connection,$value);
  }
?>
