<?php
include("./connect.php");
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
     <style media="screen">
     body{
       margin : 0;
       padding : 0;
     }
     .login_form{
       position : absolute;
       top : 50%;
       left : 50%;
       transform : translate(-50%, -50%);
     }
     table{
       border : 2px solid black;
       padding : 20px;
     }
     .td_center{
       text-align : center;
     }
     </style>
   </head>
   <?php if(!isset($_SESSION['ss_mb_id'])){ ?>
   <body>
     <div class="login_form">
       <table>
         <tr>
           <th>아이디</th>
           <td><input type="text" name="id" value=""></td>
         </tr>
         <tr>
           <th>비밀번호</th>
           <td><input type="password" name="pw" value=""> </td>
         </tr>
         <tr>
           <td colspan = "2" class = "td_center">
             <input type="submit" name="" value="로그인">
             <a href="./register.php">회원가입</a>
           </td>
         </tr>
       </table>
     </div>
   <?php } else {?>
     <h1>로그인을 환영합니다</h1>
     <?php $mb_id = $_SESSION['ss_mb_id'];
     $sql = "SELECT * FROM member WHERE mb_id = TRIM('$mb_id')";
     $result = mysqli_query($conn, $sql);
     $mb = mysqli_fetch_assoc($result);

     mysqli_close($conn);
      ?>
      <table>
        <tr>
          <th>아이디</th>
          <td><?php echo $mb['$mb_id'] ?></td>
        </tr>
        <tr>
          <th>이름</th>
          <td><?php echo $mb['$mb_name'] ?></td>
        </tr>
        <tr>
          <td colspan="2" class = "td_center">
            <a href="./register.php?mode=modify">회원가입</a>
            <a href="./logout.php">로그아웃</a>
          </td>
        </tr>
      </table>
    <?php } ?>
   </body>
 </html>
