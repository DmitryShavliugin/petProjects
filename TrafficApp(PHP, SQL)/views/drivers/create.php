<?php include '../partials/header.php' ?>

<?php 
if (isset($_POST['submit'])) { 
    $FIO = $_POST['driver']['name'];
    $BirthDate = $_POST['driver']['date'];
    $Add = $_POST['driver']['address'];
    $Num = $_POST['driver']['number'];
    $Cat = $_POST['driver']['category'];

    $conn = new mysqli($servername, $username, $password);

    $sql = "use trafficdb;";
    $conn->query($sql);
    

    $sql = "INSERT INTO Drivers (Name, BirthDate, Address, DriverLicense, AvailableCategory)
                        VALUES ('$FIO', '$BirthDate', '$Add', '$Num', '$Cat');";
    $result = $conn->query($sql);
    echo $conn->error;

    $conn->close();

    echo '<script>location.replace("../drivers.php");</script>'; exit;
} 
?> 





<h2>Создать</h2>

    <div class="form-horizontal">
        <h4>Водитель</h4>
        <hr />
        <form action="create.php" method="post">
            
            <div class="form-group">
                <label class="control-label col-md-2" for="driver[name]">ФИО водителя</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="driver[name]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="driver[date]">Дата рождения</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="driver[date]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="driver[address]">Адрес</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="driver[address]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="driver[number]">Номер водительского удостоверения</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="driver[number]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="driver[category]">Категории</label>
                <div class="col-md-10">
                        <input class="form-control text-box single-line" required name="driver[category]"/>
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
    <a href="../drivers.php">Назад</a>
</div>

<?php include '../partials/footer.php' ?>