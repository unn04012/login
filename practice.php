<?php
include('./connect.php');

$sql_no = "SELECT * FROM upload_file";
$result_no = mysqli_query($conn, $sql_no);
$list = mysqli_fetch_assoc($result_no);
$number = $list['file_no'];


echo $list['file_no'].'</br>';
echo $list['file_name'].'</br>';
echo $list['file_path'].'</br>';
 ?>
