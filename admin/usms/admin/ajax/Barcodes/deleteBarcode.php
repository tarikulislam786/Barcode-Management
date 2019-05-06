<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("../../../dbconnect.php");

    // get user id
    $id = $_POST['id'];
        $stmt = $conn->prepare("SELECT warningMark FROM barcodeDetails WHERE id=".$id); //print_r($stmt);
        $stmt->execute();
        $row = $stmt->fetch();
        $warningMark = $row['warningMark'];
    // delete User
    unlink("../../../uploads/".$warningMark);
    $query = "DELETE FROM barcodeDetails WHERE id = '$id'";
    
    /*if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }*/
    $conn->query($query);
}
?>