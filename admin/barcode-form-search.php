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
 <style>
 ul.ui-autocomplete li a{text-align: right;}
 .jumbotron.custom{padding-bottom: 25px;padding-top: 25px;}
 .jumbotron.custompanel{text-align: center;border-bottom: 3px solid #000;border-top: 3px solid #000;padding-top: 10px;padding-bottom: 10px;font-size: 30pt;line-height: 20pt;}
 .jumbotron.custom ul li{list-style-type:none; display: grid;}
.jumbotron.custom ul li span{float: left;font-size: 20pt;line-height: 22pt;}
 </style>

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
 <div class = "jumbotron custom" style="text-align:center; margin-bottom:0px;">
    <ul>
        <li><span>سلطنة عمان</span></li>
        <li><span>وزارة التربية والتتعليم</span></li>
        <li><span>المديرية العامة للتربية والتعليم بمحافظة مسندم</span></li>
        <li><span>قسم المختبرات</span></li>
    </ul>
 </div>
 <div class = "jumbotron custompanel" style="text-align:center">باركود المواد الكيميائية</div>                   
<form role="form" action="barcode.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <input type="text" name="" placeholder="بحث" class="auto  form-control" id="barcodeid" style="text-align:right">
                <input type="hidden" id="hidden_auto_complete_barcode"  name="barcodeid">
                
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="email">:الباركود</label>
            
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <input type="text" class="subname form-control" name="subject">
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">:اسم الموضوع</label>
            
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            
            <div class="col-sm-5">
                <input type="text" class="formula form-control" name="formula">
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">:صيغة كيميائية</label>
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <textarea name="characteristics" rows="5" cols="50" class ="characteristics"></textarea>
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">:الخصائص العامة</label>
            
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <input type="text" class="category form-control" name="category">
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">:الفئة</label>
            
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
            <div class="imagearea" style="width:100px;height:100px;background:yellow;margin:0px auto;">
            </div>
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">:علامة التحذير</label>&nbsp;&nbsp;&nbsp;
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
            <input type="text" name="steps" id="" class="steps form-control"/>
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">:خطوات</label>
            
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <textarea name="procedures" rows="5" cols="50" class ="procedures"></textarea>
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">:إجراءات السلامة</label>
            
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <textarea name="notes" rows="5" cols="50" class ="notes"></textarea>
            </div>
            <label class="control-label col-sm-2" style="text-align:left;" for="pwd">:ملاحظات</label>
            
        </div>
    </form>
</div>
 </div>
        </div>
    </div>
    <!--/span-->
</div><!--/row--> 
<script type="text/javascript">
    //$("a#addAnother").on('click', function(){
    $(function() {//alert('hi');
        //autocomplete
        $(".auto.form-control").autocomplete({
            source: "barcode-search.php",
            minLength: 1,
            select: function(event, ui) {
                //alert(ui.item.value);
                $("#hidden_auto_complete_barcode").val(ui.item.value);
                var barcode = ui.item.value; //alert(bcodeid);
                $.get('barcode-search.php?barcode=' +barcode,
                    function(res) {//alert(res.warningMark);
                        //alert(res.procedures);
                       // alert("subname:"+res.subject+" formula:"+res.formula);
                        $(".subname").val(res.subject)
                        $(".formula").val(res.formula)
                        $(".characteristics").val(res.characteristics)
                        $(".category").val(res.steps)
                        $(".steps").val(res.category)
                        var img = document.createElement("IMG");
                        img.src = "../uploads/"+res.warningMark;
                        // $('#image').html(img); 
                        $(".imagearea").html(img)
                       // $(".wtag .img").attr("src","http://chem-barcode.com/usms/uploads/"+res.warningMark);
                      // $(".wtag .img").attr({src: "data:image/jpeg;base64," + res.warningMark}).appendTo("body");
                        //$("<Img>").attr({src: "data:image/jpeg;base64," + obx.photo_file}).appendTo("body");
                        $(".procedures").val(res.procedures)
                        $(".notes").val(res.notes)
                    },
                    'json');

            }
        });
    });
    </script>
    <?php include('footer.php'); ?>