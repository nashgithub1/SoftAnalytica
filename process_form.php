
<?php session_start();
require 'database.php';
//var_dump($_SESSION);die();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_id = $_SESSION['user_id'];  // Assuming user_id is stored in the session after login
  $name = $_POST['name'];
  $university = $_POST['university'];
  $faculty = $_POST['faculty'];
  $age = $_POST['age'];
  $mobileNumber = $_POST['mobileNumber'];
  $gpa = $_POST['gpa'];
  $activities = $_POST['activities'];
  $homeNumber = $_POST['homeNumber'];
  $streetAddress = $_POST['streetAddress'];
  $city = $_POST['city'];
  $districtName = $_POST['districtName'];

   // Insert data into the database
   $sql = <<<SQL
   INSERT INTO user_profiles (user_id, name, university, faculty, age, mobile_number, gpa, activities, home_number, street_address, city, district_name)
   VALUES ($user_id, '$name', '$university', '$faculty', $age, '$mobileNumber', $gpa, '$activities', '$homeNumber', '$streetAddress', '$city', '$districtName')
   SQL;
//var_dump($sql);die();
if ($mysqli->query($sql) === TRUE) {
echo "Profile successfully created.";
header("Location: login.php");
} else {
echo "Error: " . $mysqli->error;
}

$mysqli->close();
} else {
echo "Invalid request method.";
}
?>