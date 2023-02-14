<?php 
/*
    coding by : Muhammed 
    desingner: https://bootsnipp.com/snippets/bl71b
    pulgins: https://github.com/PHPOffice/PHPExcel
 
*/
# https://forum.turkishcode.com/konu-php-sadece-harf-ve-rakam.html
function illegalKarakterTemizle($metin)
{

    return preg_replace("/[^a-zA-Z0-9]+/", "", $metin);
}
$filterFile = isset($_FILES['filterFile']) ? $_FILES['filterFile'] : "";
$searchinFile = isset($_FILES['searchinFile']) ? $_FILES['searchinFile'] : "";
$status = empty($filterFile) ? false : (empty($searchinFile)? false: true);
$status = ($status==true) ? (isset($_POST["slct_filterFile"])? (isset($_POST["slct_searchinFile"])?true:false):false):false;
if (!$status ){
    echo json_encode(["status"=>false]);
    exit();
}
$tam_eslesme = isset($_POST["tam_eslesme"]) ? (($_POST["tam_eslesme"] =="1" or $_POST["tam_eslesme"]=="0")? $_POST["tam_eslesme"]:"0"):"0";
$slct_filterFile = in_array($_POST["slct_filterFile"],range('A', 'Z'))? $_POST["slct_filterFile"]:"A";
$slct_filterFile_w = in_array($_POST["filterFile_colmn_w"],range('A', 'Z'))? $_POST["filterFile_colmn_w"]:"A";
$slct_searchinFile = in_array($_POST["slct_searchinFile"],range('A', 'Z'))? $_POST["slct_searchinFile"]:"A";
$filterFile_path= "uploads/" . $filterFile['name'];
$searchinFile_path= "uploads/" . $searchinFile['name'];
$filterFile_up = move_uploaded_file($filterFile['tmp_name'], $filterFile_path) ? true:false;
$searchinFile_up = move_uploaded_file($searchinFile['tmp_name'], $searchinFile_path)? true:false; 
$status = ($filterFile_up==TRUE) ?(($searchinFile_up==true)?true:false):false;
if (!$status) {
    echo json_encode(["status" => false]);
    exit();
}
error_reporting(0);
set_time_limit(0); 
include "Classes/PHPExcel.php";
include "Classes/PHPExcel/IOFactory.php";
$filterFile_objPHPExcel = PHPExcel_IOFactory::load(__DIR__."/". $filterFile_path);
$filterFile_sheetData = $filterFile_objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
$searchinFile_objPHPExcel = PHPExcel_IOFactory::load(__DIR__."/". $searchinFile_path);
$searchinFile_sheetData = $searchinFile_objPHPExcel->getActiveSheet()->toArray(null, true, true, true);


$newData = [];  
$ii= 1 ; 
foreach($filterFile_sheetData as $ff):
    $counter = 0;
    $selected_colmn = $ff[$slct_filterFile];   
    if($selected_colmn == null or empty($selected_colmn)):
        $ii++; 
        continue;
    endif;
    if($selected_colmn == "STOK İSMİ"):
        $ii++;
        continue;
    endif;
    foreach($searchinFile_sheetData as $sf):
        if($tam_eslesme=="1"):
            if($sf[$slct_searchinFile] == $selected_colmn):
                $counter++;
            endif;
        elseif($tam_eslesme == "0"):
            $temiz_icerik = illegalKarakterTemizle(strtolower(trim($sf[$slct_searchinFile])));
            $temiz_aranan = illegalKarakterTemizle(strtolower(trim($selected_colmn)));
            if(strpos($temiz_icerik , $temiz_aranan ) !== false):
                $counter++;
            endif;
        endif;
    endforeach;  
    $filterFile_sheetData[$ii][$slct_filterFile_w] = $counter; 
    $filterFile_objPHPExcel->getActiveSheet()->SetCellValue($slct_filterFile_w.strval($ii), strval($counter));
    $ii++; 
endforeach; 
$filename= str_replace(["."],["_"],$filterFile['name']) . "_output.xlsx";
$objWriter = PHPExcel_IOFactory::createWriter($filterFile_objPHPExcel, 'Excel2007');
$objWriter->save(__DIR__."/downloads/".$filename);
echo json_encode(["status" =>true,"download"=>  "downloads/" . $filename]);
exit();