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


echo '<h2>Водители</h2>';

echo '<p>
        <a href="drivers/create.php">Создать</a>
    </p>';

echo '<table class="table">';
echo '<tr>';

echo '<table class="table">';
echo '<tr>';
      echo '<th>' . 'ФИО водителя' . '</th>';
      echo '<th>' . 'Дата рождения' . '</th>';
      echo '<th>' . 'Адрес' . '</th>';
      echo '<th>' . 'Номер водительского удостоверения' . '</th>';
      echo '<th>' . 'Категории' . '</th>';
echo '</tr>';
echo '<tr>';

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//       echo '<th>' . $row['COLUMN_NAME'] . '</th>';
//     }
// }
echo '</tr>';
$sql = "SELECT Id, Name, BirthDate, Address, DriverLicense, AvailableCategory FROM Drivers;";
$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['Name'] . '</td>';
            echo '<td>' . $row['BirthDate'] . '</td>';
            echo '<td>' . $row['Address'] . '</td>';
            echo '<td>' . $row['DriverLicense'] . '</td>';
            echo '<td>' . $row['AvailableCategory'] . '</td>';
            echo '<td>' . 
                        '<a href="drivers/edit.php?edit='.   $row['Id'] . '">Редактировать</a> |
                         <a href="drivers/delete.php?delete='. $row['Id']  .'">Удалить</a>' .
                 '</td>';
            echo '</tr>';
        }
    }
echo '</table>';

$conn->close();
?>

<?php include 'partials/footer.php' ?>