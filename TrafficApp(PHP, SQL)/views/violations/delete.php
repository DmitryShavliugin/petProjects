<?php include '../partials/header.php' ?>

<h2>Удалить</h2>
<h3>Действительно желаете удалить?</h3>

<?php 
    if (isset($_POST['delete'])) { 
        $conn = new mysqli($servername, $username, $password);

        $sql = "use trafficdb;";
        $conn->query($sql);
        
        $id = $_GET['delete'];

        $sql = "DELETE FROM Violations WHERE Id = ". $id .";";
        $conn->query($sql);
        echo $conn->error;

        $conn->close();

        echo '<script>location.replace("../violations.php");</script>'; exit;
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


        $sql = "SELECT * FROM Violations WHERE id=$id";
        $result = $conn->query($sql);       
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $Date = $row['DateTime'];
                $Place = $row['Place'];
                $Desc = $row['Description'];
                $Summ = $row['Sum'];
            }
        }

        $conn->close();
	}
?>


<div>
    <h4>Штраф</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Дата
        </dt>

        <dd>
            <?php echo $Date; ?>
        </dd>

        <dt>
            Место
        </dt>

        <dd>
            <?php echo $Place; ?>
        </dd>

        <dt>
            Описание
        </dt>

        <dd>
            <?php echo $Desc; ?>
        </dd>

        <dt>
            Сумма штрафа
        </dt>

        <dd>
            <?php echo $Summ; ?>
        </dd>
    </dl>



        <div class="form-actions no-color">
            <?php echo'<form action="delete.php?delete='. $id  .'" method="post">'?>
                <input type="submit" name="delete" value="Удалить" class="btn btn-danger" /> |
                <a href="../violations.php">Назад</a>
            </form>
        </div>

</div>

<?php include '../partials/footer.php' ?>