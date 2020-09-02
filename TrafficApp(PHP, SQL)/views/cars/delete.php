<?php include '../partials/header.php' ?>

<h2>Удалить</h2>
<h3>Действительно желаете удалить?</h3>

<?php 
    if (isset($_POST['delete'])) { 
        $conn = new mysqli($servername, $username, $password);

        $sql = "use trafficdb;";
        $conn->query($sql);
        
        $id = $_GET['delete'];

        $sql = "DELETE FROM Cars WHERE Id = ". $id .";";
        $conn->query($sql);
        echo $conn->error;

        $conn->close();

        echo '<script>location.replace("../cars.php");</script>'; exit;
    } 

	if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        
		//Create connection
        $conn = new mysqli($servername, $username, $password);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        $sql = "use trafficdb;";
        $conn->query($sql);


        $sql = "SELECT * FROM Cars WHERE id=$id";
        $result = $conn->query($sql);       
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
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


<div>
    <h4>Автомобиль</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Марка
        </dt>

        <dd>
            <?php echo $Brand; ?>
        </dd>

        <dt>
            Модель
        </dt>

        <dd>
            <?php echo $Model; ?>
        </dd>

        <dt>
            Год производства
        </dt>

        <dd>
            <?php echo $Year; ?>
        </dd>

        <dt>
            Цвет
        </dt>

        <dd>
            <?php echo $Color; ?>
        </dd>

        <dt>
            Гос. номер
        </dt>

        <dd>
            <?php echo $Number; ?>
        </dd>

        <dt>
            Объем двигателя
        </dt>

        <dd>
            <?php echo $Engine; ?>
        </dd>

        <dt>
            Тип топлива
        </dt>

        <dd>
            <?php echo $FuelType; ?>
        </dd>

    </dl>



        <div class="form-actions no-color">
            <?php echo'<form action="delete.php?delete='. $id  .'" method="post">'?>
                <input type="submit" name="delete" value="Удалить" class="btn btn-danger" /> |
                <a href="../cars.php">Назад</a>
            </form>
        </div>

</div>

<?php include '../partials/footer.php' ?>