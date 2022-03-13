<?php
require_once("dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะลบ
if ($_POST){
   

    

    $id = $_POST['id'];
    $Doc_num = $_POST["doc_num"];
    $Doc_title = $_POST["doc_title"];
    $start_date = $_POST["start_date"];
    $end_date = ($_POST["end_date"]== "") ? NULL : $_POST["end_date"];
    $status = $_POST["status"];
    $document = ($_POST["document"]== "") ? NULL : $_POST["document"];
    $sql = "UPDATE documents 
            SET doc_num = ?,
                doc_title = ?,
                doc_start_date = ?,
                doc_to_date = ? ,
                doc_status = ? ,
                doc_file_name = ?
            WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssssi", $Doc_num, $Doc_title, $start_date, $end_date, $status, $document, $id);
    $stmt->execute();

    header("location: showdoc.php");

} else {   
    $id = $_GET['id'];
    $sql = "SELECT *
            FROM documents
            WHERE id = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();

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
    <title>Document</title>
</head>
<body>
    <div class = "container">
<div class ="form-group">
        <h1>Edit</h1>
    </div>
    
     <form action="editdoc.php" method="POST">

        <div class ="form-group">
            <label for="doc_num">Doc_num</label>
            <input type="text" class="f1" name="doc_num" id="doc_num" value="<?php echo $row->doc_num;?>" required>
        </div>
        <div class ="form-group">
            <label for="doc_title">Doc_title</label>
            <input type="text" class="f1" name="doc_title" id="doc_title" value="<?php echo $row->doc_title;?>" required>
        </div>

        <div class ="form-group">
            <label for="start_date">Start date</label>               
            <input type="date" class="f2" name="start_date" id="start_date" value="<?php echo $row->doc_start_date;?>" required>

        </div>
        <div class ="form-group">
            <label for="end_date">End date</label>               
            <input type="date" class="f2" name="end_date" id="end_date" value="<?php echo $row->doc_to_date;?>">
        </div>
        <div class ="form-group">
            <label for="status">status</label>
            <?php
                if($row->doc_status == "Active"){
                    echo "<input type='radio' class='f3' name='status' id='status' value='Active' checked > Active";
                    echo "<input type='radio' name='status' id='status' value='Expire'> Expire";
                }else{
                    echo "<input type='radio' class='f3' name='status' id='status' value='Active'> Active";
                    echo "<input type='radio' name='status' id='status' value='Expire' checked > Expire";
                }
            ?>
        </div>
        <div class ="form-group">
            <label for="document">name_document</label>
            <input type="text" class="f1" name="document" id="document" value="<?php echo $row->doc_file_name;?>">
        </div>
        <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $row->id;?>">
        <input type="submit" id="submit" value="update" class="btn btn-primary">
        </div>
        <div class="form-group">
            <a href="showdoc.php">Home</a>
        </div>
            
     </form>
     </div>
    <hr>
</body>
</html>