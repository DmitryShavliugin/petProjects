<?php include '../partials/header.php' ?>
<h2>Редактировать</h2>
<?php 
    if (isset($_POST['edit'])) { 
        $Id = $_POST['car']['id'];
        $Brand = $_POST['car']['mark'];
        $Model = $_POST['car']['model'];
        $Year = $_POST['car']['year'];
        $Color = $_POST['car']['color'];
        $Number = $_POST['car']['number'];
        $Engine = $_POST['car']['engine'];
        $FuelType = $_POST['car']['fuel'];
        $Driver_Id = $_POST['car']['driver'];

        $conn = new mysqli($servername, $username, $password);

        $sql = "use trafficdb;";
        $conn->query($sql);
        

        $sql = "UPDATE Cars
                SET Brand     =     '". $Brand      ."',
                    Model     =     '". $Model      ."',
                    Year      =     '". $Year       ."',
                    Color     =     '". $Color      ."',
                    Number    =     '". $Number     ."',
                    Engine    =     '". $Engine     ."',
                    FuelType  =     '". $FuelType   ."',
                    Driver_Id =     '". $Driver_Id  ."'
                WHERE Id=". $Id .";";
        $conn->query($sql);
        echo $conn->error;

        $conn->close();

        echo '<script>location.replace("../cars.php");</script>'; exit;
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


        $sql = "SELECT * FROM Cars WHERE id=$id";
        $result = $conn->query($sql);       
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $Id = $row['Id'];
                $Brand = $row['Brand'];
                $Model = $row['Model'];
                $Year = $row['Year'];
                $Color = $row['Color'];
                $Number = $row['Number'];
                $Engine = $row['Engine'];
                $FuelType = $row['FuelType'];
                $Driver_Id = $row['Driver_Id'];
            }
        }

        $conn->close();
	}
?>


<div class="form-horizontal">
        <h4>Автомобиль</h4>
        <hr />
        <form action="edit.php" method="post">
            
            <div class="form-group">
                <label class="control-label col-md-2" for="car[mark]">Марка</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[mark]" value="<?php echo $Brand; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[model]">Модель</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[model]" value="<?php echo $Model; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[year]">Год производства</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[year]" value="<?php echo $Year; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[color]">Цвет</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[color]" value="<?php echo $Color; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[number]">Гос. номер</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[number]" value="<?php echo $Number; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[engine]">Объем двигателя</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[engine]" value="<?php echo $Engine; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[fuel]">Тип топлива</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[fuel]" value="<?php echo $FuelType; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[driver]">Водитель</label>
                <div class="col-md-10">
                    <select class="form-control" id="driver" name="car[driver]" required>
                        <?php 
                            $conn = new mysqli($servername, $username, $password);
                            $sql = "use trafficdb;";
                            $conn->query($sql);

                            $sql = "SELECT * FROM Drivers;";
                            // echo 'lol';
                            $result = $conn->query($sql);
                            echo $conn->error;

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    if ($row['Id'] == $Driver_Id) {
                                        echo '<option selected value="'. $row['Id'] .'">'. $row['Name'] .'</option>';
                                    }else{
                                    echo '<option value="'. $row['Id'] .'">'. $row['Name'] .'</option>';
                                    }
                                }
                            }
                            $conn->close();
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[id]">Id</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[id]" readonly value="<?php echo $Id; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="submit" name="edit" value="Сохранить" class="btn btn-default" />
                </div>
            </div>


        </form>
    </div>

<div>
    <a href="../cars.php">Назад</a>
</div>

<?php include '../partials/footer.php' ?>