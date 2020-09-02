<?php include '../partials/header.php' ?>

<?php 
if (isset($_POST['submit'])) { 
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
    

    $sql = "INSERT INTO Cars (Brand, Model, Year, Color, Number, Engine, FuelType, Driver_Id)
                        VALUES ('$Brand', '$Model', '$Year', '$Color', '$Number', '$Engine', '$FuelType', '$Driver_Id');";
    $result = $conn->query($sql);
    echo $conn->error;

    $conn->close();

    echo '<script>location.replace("../cars.php");</script>'; exit;
} 
?> 





<h2>Создать</h2>

    <div class="form-horizontal">
        <h4>Автомобиль</h4>
        <hr />
        <form action="create.php" method="post">
            
            <div class="form-group">
                <label class="control-label col-md-2" for="car[mark]">Марка</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[mark]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[model]">Модель</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[model]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[year]">Год производства</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[year]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[color]">Цвет</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[color]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[number]">Гос. номер</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[number]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[engine]">Объем двигателя</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[engine]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[fuel]">Тип топлива</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="car[fuel]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="car[driver]">Водитель</label>
                <div class="col-md-10">
                    <select class="form-control" id="driver" name="car[driver]" required><option value="">- Выберите владельца -</option>
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
                                    echo '<option value="'. $row['Id'] .'">'. $row['Name'] .'</option>';
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
    <a href="../cars.php">Назад</a>
</div>

<?php include '../partials/footer.php' ?>