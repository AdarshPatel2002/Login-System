<?php
   $server = 'localhost';
   $username = 'root';
   $password = '';
   $database = 'users';

   $connect = mysqli_connect($server, $username, $password, $database);

   if (!$connect)
      die ("Error connecting to server \n" . mysqli_connect_error());
?>