<?php
error_reporting(1);
ob_start(); // redirecting problem solved
 include('../dbconnect.php');

 ?>


<?php
/*session_start();//print_r($_SESSION);exit;
if(!isset($_SESSION["email"]))
{
    header("location:../login.php?unauthorized-access=1");
    exit();
}*/ 
?>
<?php
 /*
$email=$_SESSION["email"];

$query = "SELECT role from users where email="."'$email'";//print_r($query);

$result= $conn->query($query);//print_r($result);
//exit(mysql_error());
$result->setFetchMode(PDO::FETCH_ASSOC);
$countmach =$result->rowCount();
//echo $countmach;
if($countmach ==1) {//print_r("login successful");exit;
    $row = $result->fetch();//print_r($row);exit;
    $role = $row['role'];//print_r($role);
    if($role>1) // if student
    {
        //echo "Un authorized access.";
        header('Location:error.php');
    }
}*/
?>

<?php
/* $email=$_SESSION["email"];

$query = "SELECT role from users where email="."'$email'";//print_r($query);

$result= $conn->query($query);//print_r($result);
//exit(mysql_error());
$result->setFetchMode(PDO::FETCH_ASSOC);
$countmach =$result->rowCount();
//echo $countmach;
if($countmach ==1) {//print_r("login successful");exit;
    $row = $result->fetch();//print_r($row);exit;
    $role = $row['role'];//print_r($role);
    if($role>1) // if student
    {
        //echo "Un authorized access.";
        header('Location:error.php');
    }
}*/ 
?>







 <?php 
//if(isset($_FILES['fileField']['name']) && isset($_POST['caption'])){//print_r($_FILES);
if(isset($_POST['barcode'])){//print_r($_FILES);
    $barcode = $_POST['barcode'];
    $subject = $_POST['subject'];
    $formula = $_POST['formula'];
    $characteristics = $_POST['characteristics'];
    $category = $_POST['category'];
    $steps = $_POST['steps'];
    $procedures = $_POST['procedures'];
    $notes = $_POST['notes'];
    $image= $_FILES['fileField']['name'];//print_r($image);exit;
    $newname= $_FILES['fileField']['name'];
    $sql = "INSERT INTO `barcodeDetails` (`barcode`, `subject`, `formula`, `characteristics`,`category`,`warningMark`,`steps`,`procedures`,`notes`)VALUES('$barcode', '$subject','$formula','$characteristics','$category','$image','$steps','$procedures','$notes')";//print_r($sql);exit;
        $count = $conn->exec($sql);//print_r($count);exit;
        echo 'Added Successful.';
    if (($_FILES["fileField"]["type"] == "image/gif")
        || ($_FILES["fileField"]["type"] == "image/jpeg")
        || ($_FILES["fileField"]["type"] == "image/png" ))
    {

        $target = $_SERVER['DOCUMENT_ROOT'] . '/usms/uploads/';//print_r($target);exit;
        move_uploaded_file($_FILES['fileField']['tmp_name'], $target.$newname);//exit();
       // header("Location:authors-manage.php?success=1");
    }
    else
    {
        echo "Sorry, Files must be either JPEG, GIF, or PNG and less than 10,000 kb";
    }

    //header("location:inventory_list.php");
    //exit();
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <script src="js/jquery.min.js"></script> <!-- no need -->
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
    <style>
        input[type='text'] {
            width: 20%;
        }
        form { margin: 100px auto; width: 800px; border: solid blue; display: block;}
    </style>
</head>
<body>
<div class="container">
    <form role="form" action="index.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Barcode:</label>
            <div class="col-sm-10">
                <input type="number" name="barcode" class="auto  form-control" id="barcode" style="width:20%">
                
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Subject Name:</label>
            <div class="col-sm-10">
                <input type="text" class="subname form-control" name="subject">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Chemical formula:</label>
            <div class="col-sm-10">
                <input type="text" class="formula form-control" name="formula">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">General characteristics:</label>
            <div class="col-sm-10">
                <textarea name="characteristics" rows="5" cols="50" class ="characteristics"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Category:</label>
            <div class="col-sm-10">
                <input type="text" class="category form-control" name="category">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Warning tag:</label>
            <input type="file" name="fileField" id="fileField" />
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Steps:</label>
            <input type="text" name="steps" id="" />
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Safety procedures:</label>
            <div class="col-sm-10">
                <textarea name="procedures" rows="5" cols="50" class ="procedures"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Notes:</label>
            <div class="col-sm-10">
                <textarea name="notes" rows="5" cols="50" class ="notes"></textarea>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" />
        </div>
    </form>
</div>

</body>
</html>

