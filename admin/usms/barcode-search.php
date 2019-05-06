<?php
// Connection data (server_address, database, name, poassword)
$hostdb = 'localhost';
$namedb = 'chem_usms';
$userdb = 'chem_chem';
$passdb = 'lpoLPO+0159';

if (isset($_GET['term'])){
    $return_arr = array();

    try {
        $conn = new PDO("mysql:host=".$hostdb.";dbname=".$namedb, $userdb, $passdb);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT barcode FROM barcodeDetails WHERE barcode LIKE :term');
        $stmt->execute(array('term' => '%'.$_GET['term'].'%'));

        while($row = $stmt->fetch()) {
            $return_arr[] =  $row['barcode'];
//            $return_arr[] =  $row['subject'];
//            $return_arr[] =  $row['formula'];
//            $return_arr[] =  $row['characteristics'];
//            $return_arr[] =  $row['category'];
//            $return_arr[] =  $row['warningMark'];
//            $return_arr[] =  $row['procedures'];
//            $return_arr[] =  $row['notes'];
            // $return_arr['id'] =  $row['id'];
        }

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    /* Toss back results as json encoded array. */
     echo json_encode($return_arr);

}if (isset($_GET['barcode'])){
    $barcode= $_GET['barcode'];
    $return_arr = array();

    try {
        $conn = new PDO("mysql:host=".$hostdb.";dbname=".$namedb, $userdb, $passdb);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT barcode, subject,formula,characteristics, category,  warningMark, procedures, notes FROM barcodeDetails WHERE barcode='.$barcode);
        $stmt->execute(array('barcode' => $barcode));

        while($row = $stmt->fetch()) {

            $return_arr['barcode'] =  $row['barcode'];
            $return_arr['subject'] =  $row['subject'];
            $return_arr['formula'] =  $row['formula'];
            $return_arr['characteristics'] =  $row['characteristics'];
            $return_arr['category'] =  $row['category'];
           // $return_arr['warningMark'] =  $row['warningMark'];
            $return_arr['procedures'] =  $row['procedures'];
            $return_arr['notes'] =  $row['notes'];
        }
       // print_r($return_arr);
       //echo json_encode($return_arr);
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
//echo $return_arr;

    /* Toss back results as json encoded array. */
    echo json_encode(array('barcode'=>$return_arr['barcode'],'subject'=>$return_arr['subject'], 'formula'=>$return_arr['formula'], 'characteristics'=>$return_arr['characteristics'], 'category'=>$return_arr['category'],'warningMark'=>$return_arr['warningMark'],'procedures'=>$return_arr['procedures'],'notes'=>$return_arr['notes']));
//echo json_encode($return_arr);
}
?>