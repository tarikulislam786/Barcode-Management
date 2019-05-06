<?php
error_reporting(1);
ob_start(); // redirecting problem solved
 include('../dbconnect.php');
 include('header.php');
 ?>
 <?php 
 session_start();//print_r($_SESSION);exit;
if(!isset($_SESSION["email"]))
{
    header("location:../login.php?unauthorized-access=1");
    exit();
}
 ?>
<?php
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
    if($role>1) // if student/ teacher
    {
        //echo "Un authorized access.";
        header('Location:error.php');
    }
}
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
        header("Location:barcode-manage.php?success=1");
    }
    else
    {
        echo "Sorry, Files must be either JPEG, GIF, or PNG and less than 10,000 kb";
    }

    //header("location:inventory_list.php");
    //exit();
}
 ?>


 <div>
    <ul class="breadcrumb" style="float:right;">
        <li>
            <a href="#">الباركود</a>
        </li>
        <li>
            <a href="#">الصفحة الرئيسية</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2 style="float:right"><i class="glyphicon glyphicon-edit"></i>&nbsp;إضافة الباركود</h2>
            </div>
 <div class="box-content">
                
<form role="form" action="barcode.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <input type="number" name="barcode" class="auto  form-control" id="barcode">
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="email">: الباركود</label>
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <input type="text" class="subname form-control" name="subject">
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">: اسم الموضوع</label>
            
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <input type="text" class="formula form-control" name="formula">
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">: صيغة كيميائية</label>
            
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <textarea name="characteristics" rows="5" cols="50" class ="characteristics"></textarea>
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">: الخصائص العامة</label>
            
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <input type="text" class="category form-control" name="category">
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">: الفئة</label>
            
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <input type="file" style="float: right;" name="fileField" id="fileField" />
            </div>      
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">: علامة التحذير</label>&nbsp;&nbsp;&nbsp;
            
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
            <input type="text" name="steps" class="steps form-control" />
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">: خطوات</label>
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <textarea name="procedures" rows="5" cols="50" class ="procedures"></textarea>
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">: إجراءات السلامة</label>
            
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <textarea name="notes" rows="5" cols="50" class ="notes"></textarea>
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">: ملاحظات</label>
            
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
            <input type="submit" name="submit" value="عرض"/>
            </div>
            <div class="col-sm-2"></div>&nbsp;&nbsp;&nbsp;

        </div>
    </form>
</div>
 </div>
        </div>
    </div>
    <!--/span-->
</div><!--/row--> 
<?php include('footer.php'); ?>