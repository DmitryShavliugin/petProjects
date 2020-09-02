<?php include '../partials/header.php' ?>
<h2>Редактировать</h2>
<?php 
    if (isset($_POST['edit'])) { 
        $FIO = $_POST['driver']['name'];
        $BirthDate = $_POST['driver']['date'];
        $Add = $_POST['driver']['address'];
        $Num = $_POST['driver']['number'];
        $Cat = $_POST['driver']['category'];
        $Id = $_POST['driver']['Id'];

        $conn = new mysqli($servername, $username, $password);

        $sql = "use trafficdb;";
        $conn->query($sql);
        

        $sql = "UPDATE Drivers
                SET Name='". $FIO ."',
                    BirthDate='". $BirthDate ."',
                    Address='". $Add ."',
                    DriverLicense=". $Num .",
                    AvailableCategory='". $Cat ."'
                WHERE Id=". $Id .";";
        $conn->query($sql);
        echo $conn->error;

        $conn->close();

        echo '<script>location.replace("../drivers.php");</script>'; exit;
    } 

	if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        
		//Create connection
        $conn = new mysqli($servername, $username, $password);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        $sql = "use trafficdb;";
        $result = $conn->query($sql);


        $sql = "SELECT * FROM Drivers WHERE id=$id";
        $result = $conn->query($sql);       
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $name = $row['Name'];
                $Birth = $row['BirthDate'];
                $Add = $row['Address'];
                $Lic = $row['DriverLicense'];
                $Cat = $row['AvailableCategory'];
            }
        }

        $conn->close();
	}
?>


<div class="form-horizontal">
        <h4>Водитель</h4>
        <hr />
        <form action="edit.php" method="post">
            
            <div class="form-group">
                <label class="control-label col-md-2" for="driver[name]">ФИО водителя</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="driver[name]" value="<?php echo $name; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="driver[date]">Дата рождения</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="driver[date]" value="<?php echo $Birth; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="driver[address]">Адрес</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="driver[address]" value="<?php echo $Add; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="driver[number]">Номер водительского удостоверения</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="driver[number]" value="<?php echo $Lic; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="driver[category]">Категории</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="driver[category]" value="<?php echo $Cat; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="driver[Id]">Id</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" readonly name="driver[Id]" value="<?php echo $_GET['edit']; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="submit" name="edit" value="Сохранить" class="btn btn-default" value="<?php $row['name']?>" />
                </div>
            </div>


        </form>
    </div>

<div>
    <a href="../drivers.php">Назад</a>
</div>

<?php include '../partials/footer.php' ?>