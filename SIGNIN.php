<?php
$db_host = 'localhost';
$db_name = 'sabit';
$db_user = 'root';
$db_password = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $email = $_POST["email"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $firstname = $_POST["firstName"];  // Corrected name
  $lastname = $_POST["lastName"];    // Corrected name
  $address = $_POST["address"];
  $city = $_POST["city"];
  
  // Validate data (add more validation as needed)
  if (empty($email) || empty($password) || empty($firstname) || empty($lastname)) {
    // Handle validation errors
    echo "All fields are required.";
  } else {
    // Connect to the database
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Insert user data into the database
    $sql = "INSERT INTO users (email, password, `first name`, `last name`, address, city) 
    VALUES ('$email', '$password', '$firstname', '$lastname', '$address', '$city')";

    
    if (mysqli_query($conn, $sql)) {
      echo "Registration successful!";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
  }
}
?>
