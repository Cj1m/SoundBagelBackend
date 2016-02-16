<?php
  $connection = mysqli_connect('mysql.hostinger.co.uk','u986542883_cj1m','rarepepes123','u986542883_bagel');

  $username = db_quote($_POST['username']);
  $email = db_quote($_POST['email']);
  $password = db_quote($_POST['password']);

  $options = [
    'cost' => 15
  ];

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT, $options);


  $exists_query = mysqli_query($connection,"SELECT * FROM USERS WHERE username='$username'");

  if(mysqli_num_rows($exists_query) == 1){
    echo "error: username already exists!";
  }else{
      $add_user_query_result = mysqli_query($connection,"INSERT INTO USERS (`id`,`email`,`username`,`password`) VALUES ('NULL','$email','$username','$hashedPassword')");
      echo "success";
  }



  //Injection Protection
  function db_quote($value) {
      global $connection;
      return mysqli_real_escape_string($connection,$value);
  }
?>
