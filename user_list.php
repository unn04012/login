<?php
include('./connect.php');

if(!$_SESSION['ss_mb_id'] === "admin"){
  echo "<script> alert('관리자가 아닙니다'); </script>";
  echo "<script> location.replace('./logout.php');/<script>";
}

$sql = "SELECT * FROM member ";
$result = mysqli_query($conn, $sql);

for($i = 0; $row=mysqli_fetch_assoc($result); $i++){
  $list[$i] = $row;
  if($row == false){
    break;
  }
}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <style media="screen">
     .user_list{
       position : absolute;
       top : 50%;
       left : 50%;
       transform : translate(-50%, -50%);
       text-align : center;
     }
     table{
       text-align : center;
       border-collapse : collapse;
       border : 2px solid black;
     }
     td{
       padding : 20px;
     }
     th{
       padding : 10px 0;
       border-bottom : 1px solid black;
     }
     table tr{
       border : 1px solid gray;
     }
   </style>
   <body>
     <div class="user_list">
       <h1>사용자 목록</h1>
       <table>
         <thead>
           <th>번호</th>
           <th>아이디</th>
           <th>비밀번호</th>
           <th>이름</th>
           <th>이메일</th>
           <th>성</th>
           <th>가입시간</th>
         </thead>
         <tbody>
           <?php for($i=0; $i<count($list); $i++) {?>
           <tr>
              <td><?php echo $list[$i]['mb_no'] ?></td>
              <td><?php echo $list[$i]['mb_id'] ?></td>
              <td><?php echo $list[$i]['mb_password'] ?></td>
              <td><?php echo $list[$i]['mb_name'] ?></td>
              <td><?php echo $list[$i]['mb_email'] ?></td>
              <td><?php echo $list[$i]['mb_gender'] ?></td>
              <td><?php echo $list[$i]['mb_datetime'] ?></td>
           </tr>
         <?php } ?>
         </tbody>
       </table>
       <a href="./logout.php">로그아웃</a>
     </div>
   </body>
 </html>
