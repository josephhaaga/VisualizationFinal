<?php
    include 'database.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT name, name_count, ethnicity FROM BabyNames";
    $result = $conn->query($sql);
    $data = array();
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          array_push($data, $row);
      }
    } else {
      echo "0 results";
    }
    $conn->close();
    echo json_encode($data);
    mysql_close($server);
?>
