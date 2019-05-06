<?php
error_reporting(1);
ob_start(); // redirecting problem solved
 include('../dbconnect.php');
 include('header.php');
 ?>
 <?php 
if(!isset($_SESSION["email"]))
{
    header("location:../login.php?unauthorized-access=1");
    exit();
}
 ?>

<?php 
if(isset($_GET["id"])){
    $id = $_GET["id"];
    
    if (!empty($id)) {
       // $query = "SELECT id, barcode, subject, formula, category,  warningMark FROM barcodeDetails WHERE id=".$id;
        $stmt = $conn->prepare("SELECT id, barcode, subject, formula, category, steps, procedures, notes, characteristics, warningMark FROM barcodeDetails WHERE id=".$id); //print_r($stmt);
        $stmt->execute();
        $row = $stmt->fetch();
        $barcode = $row['barcode'];
        $subject = $row['subject'];
        $formula = $row['formula'];
        $category = $row['category'];
        $characteristics = $row['characteristics'];
        $steps = $row['steps'];
        $procedures = $row['procedures'];
        $notes = $row['notes'];
        $warningMark = $row['warningMark'];//print_r($role);
        if(!empty($row['barcode'])) // referred to as 
        {
            $barcode = $row['barcode'];
        }
        if(!empty($row['subject']))  // referred to as 
        {
            $subject = $row['subject'];
        }
        if(!empty($row['formula']))
        {
            $formula = $row['formula'];
        }
        if(!empty($row['category']))
        {
            $category = $row['category'];
        }

        if(!empty($row['characteristics'])){
            $characteristics = $row['characteristics'];
        }
        if(!empty($row['steps'])){
            $steps = $row['steps'];
        }
        if(!empty($row['procedures'])){
            $procedures = $row['procedures'];
        }
        if(!empty($row['notes'])){
            $notes = $row['notes'];
        }
        if(!empty($row['warningMark'])){
            $warningMark = $row['warningMark'];
        }

    }



}
?>


 <?php 
if(count($_POST)>0 || count($_FILES)>0) {
if(isset($_POST) || !empty($_FILES) || !empty($_POST)){//print_r($_FILES);
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

    
    if(isset($_FILES) && !empty($_FILES))  {
        if (($_FILES["fileField"]["type"] == "image/gif")
        || ($_FILES["fileField"]["type"] == "image/jpeg")
        || ($_FILES["fileField"]["type"] == "image/png" ))
        {
            $UpdateQueryUser = "Update barcodeDetails set warningMark='$image' WHERE id=" . $id;//print_r($UpdateQueryUser);exit;
            $result = $conn->query($UpdateQueryUser);
            unlink("../uploads/".$warningMark); // if new image uploaded delete the previous one

            $target = $_SERVER['DOCUMENT_ROOT'] . '/usms/uploads/';//print_r($target);exit;
            move_uploaded_file($_FILES['fileField']['tmp_name'], $target.$newname);//exit();
        }
        else
        {
            echo "Sorry, Files must be either JPEG, GIF, or PNG and less than 10,000 kb";
        }
    }
        $UpdateQueryUser = "Update barcodeDetails set subject='$subject', formula='$formula', characteristics='$characteristics', category='$category', steps='$steps', procedures='$procedures', notes='$notes' WHERE id=" . $id;//print_r($UpdateQueryUser);exit;
        $result = $conn->query($UpdateQueryUser);
    if (!empty($result)) {
        echo 'Updated Successful.';
                    //unset($_POST);
    } else {
            echo 'Problem in updating.!';
    }
        
        header("Location:barcode-manage.php?success=1");
    
    //header("location:inventory_list.php");
    //exit();
}
}
 ?>
 <div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Barcodes</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i>&nbsp;Update barcode</h2>
            </div>
 <div class="box-content">
                
<form role="form" method = "POST" action="barcode-edit.php?id=<?php echo $id;?>" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Barcode:</label>
            <div class="col-sm-10">
                <input type="number" value="<?php echo $barcode;?>" name="barcode" class="auto  form-control" id="barcode">
                
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Subject Name:</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $subject;?>" class="subname form-control" name="subject">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Chemical formula:</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $formula;?>" class="formula form-control" name="formula">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">General characteristics:</label>
            <div class="col-sm-10">
                <textarea name="characteristics" rows="5" cols="50" class ="characteristics"><?php echo $characteristics;?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Category:</label>
            <div class="col-sm-10">
                <input type="text" value="<?php echo $category;?>" class="category form-control" name="category">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Warning tag:</label>&nbsp;&nbsp;&nbsp;
            <div class="col-sm-3">
                <?php 
                $strPath ='http://chem-barcode.com/usms/uploads/';?>
                <img src="<?php  echo $strPath.= $warningMark; ?>" 
            </div>
            <input type="file" name="fileField" id="fileField" />
        </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Steps:</label>
            <input type="text" value="<?php echo $steps;?>" name="steps" id="" />
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Safety procedures:</label>
            <div class="col-sm-10">
                <textarea name="procedures" rows="5" cols="50" class ="procedures"><?php echo $procedures;?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Notes:</label>
            <div class="col-sm-10">
                <textarea name="notes" rows="5" cols="50" class ="notes"><?php echo $notes;?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2"></div>&nbsp;&nbsp;&nbsp;
            <input type="submit" name="submit" />
        </div>
    </form>
</div>
 </div>
        </div>
    </div>
    <!--/span-->
</div><!--/row--> 