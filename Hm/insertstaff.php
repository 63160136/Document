<?php
require_once("dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะเพิ่ม
if ($_POST){
    $code = $_POST['stf_code'];
    $name = $_POST['stf_name'];

    // insert a record by prepare and bind
    // The argument may be one of four types:
    //  i - integer
    //  d - double
    //  s - string
    //  b - BLOB

    // ในส่วนของ INTO ให้กำหนดให้ตรงกับชื่อคอลัมน์ในตาราง actor
    // ต้องแน่ใจว่าคำสั่ง INSERT ทำงานใด้ถูกต้อง - ให้ทดสอบก่อน
    $sql = "INSERT 
            INTO staff (stf_code, stf_name) 
            VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $code, $name);
    $stmt->execute();

    // redirect ไปยัง actor.php
    header("location: showdata.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>insert</title>
</head>
<body>
    <div class = "container">
    <div class ="form-group">
        <h1>Insert</h1>
    </div>
    
     <form action="insertstaff.php" method="POST">
       <div class ="form-group">
            <label for="stf_code">stf code</label>
            <input type="text" class="f1" name="stf_code" id="stf_code" >
        </div> 
       
        <div class ="form-group">
            <label for="stf_name">stf name</label>
            <input type="text" class="f1" name="stf_name" id="stf_name" required>
        </div>

        <div class="form-group">
            <input type="submit" id="submit" value="submit" class="btn btn-success">
            <input type="reset"  value="ล้างข้อมูล"class="btn btn-primary">
        </div>
        <div class="form-group">
            <a href="showdata.php">Home</a>
        </div>

     </form>
     <hr>
</div>
</body>
</html>