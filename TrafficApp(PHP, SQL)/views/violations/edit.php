<?php include '../partials/header.php' ?>
<h2>Редактировать</h2>
<?php 
    if (isset($_POST['edit'])) { 
        $Id = $_POST['violations']['id'];
        $Date = $_POST['violations']['date'];
        $Place = $_POST['violations']['place'];
        $Desc = $_POST['violations']['desc'];
        $Summ = $_POST['violations']['summ'];
        $Car = $_POST['violations']['auto'];

        $conn = new mysqli($servername, $username, $password);

        $sql = "use trafficdb;";
        $conn->query($sql);
        

        $sql = "UPDATE Violations
                SET DateTime    =     '". $Date      ."',
                    Place       =     '". $Place      ."',
                    Description =     '". $Desc       ."',
                    Sum         =     '". $Summ      ."',
                    Car_Id      =     '". $Car     ."'
                WHERE Id=". $Id .";";
        $conn->query($sql);
        echo $conn->error;

        $conn->close();

        echo '<script>location.replace("../violations.php");</script>'; exit;
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


        $sql = "SELECT * FROM Violations WHERE id=$id";
        $result = $conn->query($sql);       
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $Id = $row['Id'];
                $Date = $row['DateTime'];
                $Place = $row['Place'];
                $Desc = $row['Description'];
                $Summ = $row['Sum'];
                $Car_Id = $row['Car_Id'];
            }
        }

        $conn->close();
	}
?>


<div class="form-horizontal">
        <h4>Штраф</h4>
        <hr />
        <form action="edit.php" method="post">
            
            <div class="form-group">
                <label class="control-label col-md-2" for="violations[date]">Дата</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="violations[date]" value="<?php echo $Date; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="violations[place]">Место</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="violations[place]" value="<?php echo $Place; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="violations[desc]">Описание</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="violations[desc]" value="<?php echo $Desc; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="violations[summ]">Сумма штрафа</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="violations[summ]" value="<?php echo $Summ; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="violations[auto]">Автомобиль</label>
                <div class="col-md-10">
                    <select class="form-control" id="driver" name="violations[auto]" required>
                        <?php 
                            $conn = new mysqli($servername, $username, $password);
                            $sql = "use trafficdb;";
                            $conn->query($sql);

                            $sql = "SELECT * FROM Cars;";
                            $result = $conn->query($sql);
                            echo $conn->error;

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    if ($row['Id'] == $Car_Id) {
                                        echo '<option selected value="'. $row['Id'] .'">'. $row['Brand'] .'</option>';
                                    }else{
                                    echo '<option value="'. $row['Id'] .'">'. $row['Brand'] .'</option>';
                                    }
                                }
                            }
                            $conn->close();
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="violations[id]">Id</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="violations[id]" readonly value="<?php echo $Id; ?>"/>
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
    <a href="../violations.php">Назад</a>
</div>

<?php include '../partials/footer.php' ?>