<?php

    $Doc_num = $_POST["doc_num"];
    $Doc_title = $_POST["doc_title"];
    $start_date = $_POST["start_date"];
    $end_date = ($_POST["end_date"]== "") ? NULL : $_POST["end_date"];
    $status = $_POST["status"];
    $document = ($_POST["document"]== "") ? NULL : "'".$_POST["document"]."'";

   



    require_once("dbconfig.php");
   

    $sql = "INSERT 
    INTO documents(doc_num, doc_title, doc_start_date, doc_to_date, doc_status, doc_file_name) 
    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssss", $Doc_num, $Doc_title, $start_date, $end_date , $status, $document);
    $stmt->execute();

    $sql ="SELECT *
            FROM documents
            WHERE doc_num = ?";
    
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $Doc_num);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();

   

    header("location: selectstaff.php?id=".$row->id);


    
    


?>