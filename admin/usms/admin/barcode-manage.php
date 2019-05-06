
<?php
error_reporting(1);
    session_start();//print_r($_SESSION);exit;
if(!isset($_SESSION["email"]))
{
    header("location:../login.php?unauthorized-access=1");
    exit();
}
?>
<?php
ob_start(); // redirecting problem solved
include('header.php');
include('../dbconnect.php'); 
?>

<?php
//pagination
if(isset($_GET["page"])){
    $page = $_GET["page"];

    if($page== "" || $page=="1"){
$page1=0;
}else{
    $page1=($page*10)-10;
}
}
?>
<style type="text/css">
.object_ok
{
border: 1px solid green; 
color: #333333; 
}

.object_error
{
border: 1px solid #AC3962; 
color: #333333; 
}

/* Input */
input
{
margin: 5 5 5 0;
padding: 2px; 

border: 1px solid #999999; 
border-top-color: #CCCCCC; 
border-left-color: #CCCCCC; 

color: #333333; 

font-size: 13px;
-moz-border-radius: 3px;
}
</style>
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
        <?php echo $msg->display();?>


<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-cog"></i> Barcode Listing</h2>
    </div>
    
    <?php 
    if(isset($_GET["page"])) {
    ?>
    <div class="records_content">
        <?php
$data = '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
                        <tr>
                            
                            <th class="text-center">No.</th>
                            <th class="text-center">Barcode</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Formula</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">warningMark</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>';

        $query = "SELECT id, barcode, subject, formula, category,  warningMark FROM barcodeDetails ORDER BY barcode ASC LIMIT $page1, 10";
$result= $conn->query($query);
    //exit(mysql_error());
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $numrows =$result->rowCount();
    //print_r($numrows);

    //for pagination count page
    $queryCountRows = "SELECT * from barcodeDetails";
    $queryCountResult = $conn->query($queryCountRows); 
    $queryCountResult->setFetchMode(PDO::FETCH_ASSOC);
    $countnumrows =$queryCountResult->rowCount(); 

    // if query results contains rows then featch those rows 
    if($numrows > 0)
    {
        $number = 0;
        if(isset($_GET["page"])){
            $pageNo = $_GET["page"];
            $number = 1;
            for($i=2;$i<=$pageNo;$i++){
                $number+=10;
            }
        }
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            if($row['barcode']<1){
            $data .= '<tr class="eachrow">
                <td class="text-center" style="color:#f00">'.$number.'</td>
                <td class="text-center" style="color:#f00">'.$row['barcode'].'</td>
                <td class="text-center" style="color:#f00">'.$row['subject'].'</td>
                <td class="text-center" style="color:#f00">'.$row['formula'].'</td>
                <td class="text-center" style="color:#f00">'.$row['category'].'</td>
                <td class="text-center" style="color:#f00"><img src="http://chem-barcode.com/usms/uploads/'.$row['warningMark'].'" /></td>
                <td class="text-center" style="color:#f00">
                    <a class="btn btn-info" href="barcode-edit.php?id='.$row['id'].'">
                        <i class="glyphicon glyphicon-edit icon-white"></i>
                        Edit
                    </a>
            
                </td>
                <td class="text-center" style="color:#f00">
                    <a class="btn btn-danger" href="#" onclick="DeleteBarcodeDetails('.$row['id'].')">
                        <i class="glyphicon glyphicon-trash icon-white"></i>
                        Delete
                    </a>
                </td>
            </tr>';
        }else{
            $data .= '<tr class="eachrow">
                <td class="text-center">'.$number.'</td>
                <td class="text-center" style="color:#f00">'.$row['barcode'].'</td>
                <td class="text-center" style="color:#f00">'.$row['subject'].'</td>
                <td class="text-center" style="color:#f00">'.$row['formula'].'</td>
                <td class="text-center" style="color:#f00">'.$row['category'].'</td>
                <td class="text-center" style="color:#f00"><img src="http://chem-barcode.com/usms/uploads/'.$row['warningMark'].'" /></td>
                <td class="text-center">
                    <a class="btn btn-info" href="barcode-edit.php?id='.$row['id'].'">
                        <i class="glyphicon glyphicon-edit icon-white"></i>
                        Edit
                    </a>
            
                </td>
                <td class="text-center">
                    <a class="btn btn-danger" href="#" onclick="DeleteBarcodeDetails('.$row['id'].')">
                        <i class="glyphicon glyphicon-trash icon-white"></i>
                        Delete
                    </a>
                </td>
            </tr>';
        }
            $number++;
        }
    }
    else
    {
        // records now found 
        $data .= '<tr class="eachrow"><td colspan="6">Records not found!</td></tr>';
    }

    $data .= '</table>';
   // pagination

        $totalpage =$countnumrows/10;
        $totalpage =ceil($totalpage);
        $currentpage    = (isset($_GET['page']) ? $_GET['page'] : 1);
        $firstpage      = 1;
        $lastpage       = $totalpage;
        $loopcounter = ( ( ( $currentpage + 2 ) <= $lastpage ) ? ( $currentpage + 2 ) : $lastpage );
        $startCounter =  ( ( ( $currentpage - 2 ) >= 3 ) ? ( $currentpage - 2 ) : 1 );

        if($totalpage > 1)
        {
            $data .= '<div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">';
            $data .= '<ul class="pagination">';
            $data .= '<li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="barcode-manage.php?page=1">First</a> </li>';
            for($i = $startCounter; $i <= $loopcounter; $i++)
            {
                if($i== $_GET["page"]){
                    $data .= '<li class="pagination-item is-active"> <a class="pagination-link" href="barcode-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
                }else{
                    $data .= '<li class="pagination-item"> <a class="pagination-link" href="barcode-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
                }
            }

            $data .= '<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="barcode-manage.php?page='.$totalpage.'">Last</a> </li>';
            $data  .= '</ul>';
            $data .= '</div>';
        }
        echo $data ;
    ?>
    </div>
    <?php }else{?>
    <div class="records_content"></div>
    <?php } ?>
    
    </div>
    </div>
    <!--/span-->
    </div><!--row-->


<!-- // Pagination current page selection and first item class add -->



<?php include('footer.php'); ?>
