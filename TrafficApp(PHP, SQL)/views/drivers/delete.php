<?php include '../partials/header.php' ?>

<h2>Удалить</h2>
<h3>Действительно желаете удалить?</h3>

<?php 
    if (isset($_POST['delete'])) { 
        $conn = new mysqli($servername, $username, $password);

        $sql = "use trafficdb;";
        $conn->query($sql);
        
        $id = $_GET['delete'];

        $sql = "DELETE FROM Drivers WHERE Id = ". $id .";";
        $conn->query($sql);
        echo $conn->error;

        $conn->close();

        echo '<script>location.replace("../drivers.php");</script>'; exit;
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


<div>
    <h4>Водитель</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            ФИО водителя
        </dt>

        <dd>
            <?php echo $name; ?>
        </dd>

        <dt>
            Дата рождения
        </dt>

        <dd>
            <?php echo $Birth; ?>
        </dd>

        <dt>
            Адрес
        </dt>

        <dd>
            <?php echo $Add; ?>
        </dd>

        <dt>
            Номер водительского удостоверения
        </dt>

        <dd>
            <?php echo $Lic; ?>
        </dd>

        <dt>
            Категории
        </dt>

        <dd>
            <?php echo $Cat; ?>
        </dd>

    </dl>



        <div class="form-actions no-color">
            <?php echo'<form action="delete.php?delete='. $id  .'" method="post">'?>
                <input type="submit" name="delete" value="Удалить" class="btn btn-danger" /> |
                <a href="../drivers.php">Назад</a>
            </form>
        </div>

</div>

<?php include '../partials/footer.php' ?>