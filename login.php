
<?php
$name=$_POST["name"];
$password=$_POST["password"];

print($name);
print("<br>");
print($password);
print("<br>");

$conn=new mysqli("localhost","root","","mybank");

if ($conn->connect_error) {
     echo "Connection failed:". $mysqli->connect_error;
  }
  else{
  echo "Connected successfully";
  }
$query="select name,password from form where name='$name'";

$result=$conn->query($query);

  if($result->num_rows > 0){
    $row=$result->fetch_assoc();
    $storedname=$row['name'];
    $storedPassword=$row['password'];

    if(password_verify($password,$storedPassword)){
      echo "login succcessfull";
    }
    else{
      echo "login not successfull";
    }
    }
    else{
      echo "user no found";
    }
    $conn->close();

    ?>