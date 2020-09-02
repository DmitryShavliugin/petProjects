<?php include 'views/partials/header.php' ?>

<?php
//Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $sql = "drop database trafficdb;";
// $result = $conn->query($sql);

$sql = "show databases;";
$result = $conn->query($sql);

$flag = true;
foreach( $result as $row ) {
    if (join(', ', $row) == 'trafficdb') {
        // echo 'exists';
        $flag = false;
    }
    // echo join(', ', $row), "<br />\r\n";
}

if($flag){
    $sql = "CREATE DATABASE TrafficDb;";
    if($conn->query($sql)){
        // echo 'created';
    }else{
        // echo("Error description: " . $conn -> error);
    }

    $sql ="USE TrafficDb;";
    if($conn->query($sql)){
        // echo 'created';
    }else{
        echo("Error description: " . $conn -> error);
    }

    $sql = "CREATE TABLE Cars(
        Id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
        Brand nvarchar(70) NULL,
        Model nvarchar(70) NULL,
        Year nvarchar(70) NULL,
        Color nvarchar(70) NULL,
        Number nvarchar(70) NULL,
        Engine nvarchar(70) NULL,
        FuelType nvarchar(70) NULL,
        Driver_Id int NULL)";
    if($conn->query($sql)){
        // echo 'created';
    }else{
        echo("Error description: " . $conn -> error);
    }

    $sql = "CREATE TABLE Drivers(
        Id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
        Name nvarchar(70) NULL,
        BirthDate nvarchar(70) NULL,
        Address nvarchar(70) NULL,
        DriverLicense nvarchar(70) NULL,
        AvailableCategory nvarchar(70) NULL)";
    if($conn->query($sql)){
        // echo 'created';
    }else{
        echo("Error description: " . $conn -> error);
    }

    $sql = "CREATE TABLE Violations(
        Id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
        DateTime datetime NOT NULL,
        Place nvarchar(70) NULL,
        Description nvarchar(70) NULL,
        Sum decimal(18, 2) NOT NULL,
        Car_Id int NULL)";
    if($conn->query($sql)){
        // echo 'created1';
    }else{
        echo("Error description: " . $conn -> error);
    }

    $sql = "
        ALTER TABLE Cars ADD CONSTRAINT FK_Cars_Drivers_Driver_Id FOREIGN KEY(Driver_Id)
        REFERENCES Drivers (Id);";
    if($conn->query($sql)){
        // echo 'created 2';
    }else{
        echo("Error description: " . $conn -> error);
    }
    $sql = "
        ALTER TABLE Violations ADD CONSTRAINT FK_Violations_Cars_Car_Id FOREIGN KEY(Car_Id)
        REFERENCES Cars (Id);
        ";
    if($conn->query($sql)){
        // echo 'created';
    }else{
        echo("Error description: " . $conn -> error);
    }
}

$conn->close();
?>

<div class="jumbotron">
    <h1>Нарушители ПДД</h1>
</div>

<div class="row">
    <div class="col-md-4">
        <p>
            База данных нарушителей ПДД. Здесь Вы можете просмотреть информацию о владельцах автомобилей,
            о самих автомобилях, а так же совершенных нарушения правил дорожного движения.
        </p>
    </div>
</div>

<?php include 'views/partials/footer.php' ?>