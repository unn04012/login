<?php
include("./connect.php");

$mode = $_POST['mode'];

if($mode != 'insert' && $mode != 'modify'){
  echo "<script> alert('mode 값이 제대로 넘어오지 않았습니다.'); </script>";
  echo "<script> location.replace('./register.php'); </script>";
  exit;
}

switch($mode){
  case 'insert':
    $mb_id = trim($_POST['id']);
    $title = "회원 가입";
    break;
  case 'modify' :
    $mb_id = trim($_POST['ss_mb_id']);
    $title = "회원 수정";
    break;
}

$mb_password        =    trim($_POST['pw']);
$mb_password_re     =    trim($_POST['pw_re']);
$mb_name            =    trim($_POST['name']);
$mb_email           =    trim($_POST['email']);
$mb_gender          =    trim($_POST['gender']);
$mb_datetime        =    date('Y-m-d H:i:s', time());
$mb_modify_datetime =    date('Y-m-d H:i:s', time());

if(!$mb_id){
  echo "<script> alert('아이디가 제대로 넘어오지 않았습니다.'); </script>";
  echo "<script> location.replace('./register.php'); </script>";
  exit;
}

if(!$mb_password){
  echo "<script> alert('비밀번호가 제대로 넘어오지 않았습니다.'); </script>";
  echo "<script> location.replace('./register.php'); </script>";
  exit;
}

if($mb_password != $mb_password_re ){
  echo "<script> alert('비밀번호가 일치하지 않습니다.'); </script>";
  echo "<script> location.replace('./register.php'); </script>";
  exit;
}

if(!$mb_name){
  echo "<script> alert('이름이 제대로 넘어오지 않았습니다.'); </script>";
  echo "<script> location.replace('./register.php'); </script>";
  exit;
}

if(!$mb_email){
  echo "<script> alert('이메일이 제대로 넘어오지 않았습니다.'); </script>";
  echo "<script> location.replace('./register.php'); </script>";
  exit;
}

$sql = "SELECT PASSWORD('$mb_password') AS pass";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$mb_password = $row['pass'];

if($mode == "insert"){    // 회원가입인 상태
  $sql = "SELECT * FROM member WHERE mb_id = '$mb_id'";
  $result = mysqli_query($conn, $sql);


  if(mysqli_num_rows($result) > 0){
    echo "<script> alert('이미 사용중인 아이디입니다'); </script>";
    echo "<script> location.replace('./register.php'); </script>";
    exit;
  }

  $sql = "INSERT INTO member
                  SET mb_id = '$mb_id',
                      mb_password = '$mb_password',
                      mb_name = '$mb_name',
                      mb_email = '$mb_email',
                      mb_gender = '$mb_gender',
                      mb_datetime  ='$mb_datetime' ";
  $result = mysqli_query($conn, $sql);

}else if($mode == "modify"){
  $sql = "UPDATE member
            SET mb_password = '$mb_password',
                mb_name = '$mb_name',
                mb_email = '$mb_email',
                mb_gender = '$mb_gender',
                mb_datetime  ='$mb_datetime' ;
            WHERE mb_id = '$mb_id'";
  $result = mysqli_query($conn, $sql);
}
if($result){
  echo "<script> alert('".$title."이 완료 되었습니다'); </script>";
  echo "<script> location.replace('./login.php'); </script>";
  exit;
}else {
  echo "생성 실패 : ".mysqli_error($conn);
  mysqli_close($conn);
}
 ?>
