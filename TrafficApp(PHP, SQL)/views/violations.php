<?php include 'partials/header.php' ?>



<?php
//Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "use trafficdb;";
$result = $conn->query($sql);

echo '<h2>Штрафы</h2>';

echo '<p>
        <a href="violations/create.php">Создать</a>
    </p>';

echo '<table class="table">';
echo '<tr>';

echo '<table class="table">';
echo '<tr>';
      echo '<th>' . 'Дата' . '</th>';
      echo '<th>' . 'Автомобиль' . '</th>';
      echo '<th>' . 'Владелец' . '</th>';
      echo '<th>' . 'Место' . '</th>';
      echo '<th>' . 'Гос. номер' . '</th>';
      echo '<th>' . 'Описание' . '</th>';
      echo '<th>' . 'Сумма штрафа' . '</th>';
echo '</tr>';
echo '<tr>';

echo '</tr>';


$sql = "SELECT Id, DateTime, Place, Description, Sum, Car_Id FROM Violations;";
$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $sql = "SELECT * FROM Cars WHERE Id = ". $row['Car_Id']. ";";
        $CarQuery = $conn->query($sql);
        $CarInfo = $CarQuery->fetch_assoc();
        $DriverInfo = $CarInfo['Driver_Id'];
        $CarNum = $CarInfo['Number'];

        $sql = "SELECT * FROM Drivers WHERE Id = ". $DriverInfo . ";";
        $DriverQuery = $conn->query($sql);
        $Driver = $DriverQuery->fetch_assoc();
        echo '<tr>';
        echo '<td>' . $row['DateTime'] . '</td>';
        echo '<td>' . $CarInfo['Brand'] . ' ' . $CarInfo['Model'] . '</td>';
        echo '<td>' . $Driver['Name'] . '</td>';
        echo '<td>' . $row['Place'] . '</td>';
        echo '<td>' . $CarNum . '</td>';
        echo '<td>' . $row['Description'] . '</td>';
        echo '<td>' . $row['Sum'] . '</td>';
        echo '<td>' . 
        '<a href="violations/edit.php?edit='.   $row['Id'] . '">Редактировать</a> |
         <a href="violations/delete.php?delete='. $row['Id']  .'">Удалить</a>' .
        '</td>';
        echo '</tr>';
        }
    }
echo '</table>';

$conn->close();
?>

















<?php include 'partials/footer.php' ?>