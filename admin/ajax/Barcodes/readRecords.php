<?php
	// include Database connection file
	include("../../../dbconnect.php");

	// Design initial table header
	$data = '<table class="table table-striped table-bordered bootstrap-datatable" id="example">
						<tr>
							<th class="text-center">.رقم</th>
                            <th class="text-center">الباركود</th>
                            <th class="text-center">موضوع</th>
                            <th class="text-center">معادلة</th>
                            <th class="text-center">الفئة</th>
                            <th class="text-center">علامة تحذير</th>
                            <th class="text-center">تحديث</th>
                            <th class="text-center">حذف</th>
						</tr>';
	
$query = "SELECT id, barcode, subject, formula, category,  warningMark FROM barcodeDetails ORDER BY barcode ASC LIMIT 0, 10";

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
    	$number = 1;
    	while($row = $result->fetch(PDO::FETCH_ASSOC))
    	{
			    $data .= '<tr class="eachrow">
				<td class="text-center" style="color:#f00">'.$number.'</td>
                <td class="text-center" style="color:#f00">'.$row['barcode'].'</td>
                <td class="text-center" style="color:#f00">'.$row['subject'].'</td>
                <td class="text-center" style="color:#f00">'.$row['formula'].'</td>
                <td class="text-center" style="color:#f00">'.$row['category'].'</td>
                <td class="text-center" style="color:#f00"><img src="http://localhost/usms/uploads/'.$row['warningMark'].'" /></td>
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

    		
    		$number++;
    	}
    }
    else
    {
    	// records now found
    	$data .= '<tr class="eachrow"><td colspan="6">Records not found!</td></tr>';
    }
    $data .= '</table>';
// pagination start
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
		if($i== 1){
			$defaultActive = "is-active";
		}else{
			$defaultActive = "";
		}
		$data .= '<li class="pagination-item '.$defaultActive.'"> <a class="pagination-link" href="barcode-manage.php?page='.$i.'">'.$i." ".'</a> </li>';
	}
	$data .= '<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="barcode-manage.php?page='.$totalpage.'">Last</a> </li>';
	$data  .= '</ul>';
	$data .= '</div>';
}
$data .= '</div>';
echo $data ;


    ?>