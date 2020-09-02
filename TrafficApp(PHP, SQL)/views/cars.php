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


echo '<h2>Машины</h2>';

echo '<p>
        <a href="cars/create.php">Создать</a>
    </p>';

echo '<table class="table">';
echo '<tr>';

echo '<table class="table">';
echo '<tr>';
      echo '<th>' . 'Марка' . '</th>';
      echo '<th>' . 'Модель' . '</th>';
      echo '<th>' . 'Год производства' . '</th>';
      echo '<th>' . 'Цвет' . '</th>';
      echo '<th>' . 'Гос. номер' . '</th>';
      echo '<th>' . 'Объем двигателя' . '</th>';
      echo '<th>' . 'Тип топлива' . '</th>';
      echo '<th>' . 'Владелец' . '</th>';
echo '</tr>';
echo '<tr>';

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//       echo '<th>' . $row['COLUMN_NAME'] . '</th>';
//     }
// }
echo '</tr>';
$sql = "SELECT Id, Brand, Model, Year, Color, Number, Engine, FuelType, Driver_Id FROM Cars;";
$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $sql = "SELECT * FROM Drivers WHERE Id = ". $row['Driver_Id']. ";";
            $carDriver = $conn->query($sql);
            $rowDriver = $carDriver->fetch_assoc();
            echo '<tr>';
            echo '<td>' . $row['Brand'] . '</td>';
            echo '<td>' . $row['Model'] . '</td>';
            echo '<td>' . $row['Year'] . '</td>';
            echo '<td>' . $row['Color'] . '</td>';
            echo '<td>' . $row['Number'] . '</td>';
            echo '<td>' . $row['Engine'] . '</td>';
            echo '<td>' . $row['FuelType'] . '</td>';
            echo '<td>' . $rowDriver['Name'] . '</td>';
            echo '<td>' . 
                        '<a href="cars/edit.php?edit='.   $row['Id'] . '">Редактировать</a> |
                         <a href="cars/delete.php?delete='. $row['Id']  .'">Удалить</a>' .
                 '</td>';
            echo '</tr>';
        }
    }
echo '</table>';

$conn->close();
?>

<?php include 'partials/footer.php' ?>