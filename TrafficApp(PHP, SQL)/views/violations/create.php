<?php include '../partials/header.php' ?>

<?php 
if (isset($_POST['submit'])) { 
    $Date = $_POST['violations']['date'];
    $Place = $_POST['violations']['place'];
    $Desc = $_POST['violations']['desc'];
    $Summ = $_POST['violations']['summ'];
    $Car = $_POST['violations']['auto'];

    $conn = new mysqli($servername, $username, $password);
    $sql = "use trafficdb;";
    $conn->query($sql);
    

    $sql = "INSERT INTO Violations (DateTime, Place, Description, Sum, Car_Id)
                        VALUES ('$Date', '$Place', '$Desc', $Summ, '$Car');";
    $result = $conn->query($sql);
    echo $conn->error;

    $conn->close();

    echo '<script>location.replace("../violations.php");</script>'; exit;
} 
?> 





<h2>Создать</h2>

    <div class="form-horizontal">
        <h4>Штраф</h4>
        <hr />
        <form action="create.php" method="post">
            
            <div class="form-group">
                <label class="control-label col-md-2" for="violations[date]">Дата</label>
                <div class="col-md-10">
                <input type="datetime-local"
                        name="violations[date]" value="<?php echo date("Y-m-d");?>T<?php echo date("h:i")?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="violations[place]">Место</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="violations[place]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="violations[desc]">Описание</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="violations[desc]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="violations[summ]">Сумма штрафа</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="violations[summ]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="violations[auto]">Автомобиль</label>
                <div class="col-md-10">
                    <select class="form-control" id="driver" name="violations[auto]" required><option value="">- Выберите автомобиль -</option>
                        <?php 
                            $conn = new mysqli($servername, $username, $password);
                            $sql = "use trafficdb;";
                            $conn->query($sql);

                            $sql = "SELECT * FROM Cars;";
                            // echo 'lol';
                            $result = $conn->query($sql);
                            echo $conn->error;

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="'. $row['Id'] .'">'. $row['Brand'] .'</option>';
                                }
                            }
                            $conn->close();
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="submit" name="submit" value="Сохранить" class="btn btn-default" />
                </div>
            </div>


        </form>
    </div>

<div>
    <a href="../violations.php">Назад</a>
</div>

<?php include '../partials/footer.php' ?>