<?php
include("./connect.php");
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="./login.css">
     <title></title>
   </head>
   <?php if(!isset($_SESSION['ss_mb_id'])){ ?>
   <body>
     <div class="login_form">
       <form class="" action="login_check.php" method="post">
         <h1>로그인</h1>
         <div class="line">
          <input type="text" name="id" value="" placeholder = "아이디">
          <input type="password" name="pw" value="" placeholder = "비밀번호">
         </div>
         <div class="sign">
           <input type="submit" name="" value="로그인">
           <a href="./register.php">회원가입</a>
         </div>
       </form>
     </div>
   <?php } else if($_SESSION['ss_mb_id'] === "admin"){?>
     <div class="login_form">
       <h1>관리자 계정</h1>
       <div class="notice">
         <a href="../noticeboard/noticeboard.php">게시판</a>
         <a href="./user_list.php">사용자 목록</a>
       </div>
     </div>
   <?php } else{ ?>
     <div class="login_form">
       <div class="sign">
         <a href="../noticeboard/noticeboard.php">게시판</a>
       </div>
       <h1>로그인을 환영합니다</h1>
       <?php $mb_id = $_SESSION['ss_mb_id'];
       $sql = "SELECT * FROM member WHERE mb_id = TRIM('$mb_id')";
       $result = mysqli_query($conn, $sql);
       $mb = mysqli_fetch_assoc($result);
       mysqli_close($conn);
      ?>
      <div class="id">
        아이디 : <?php echo $mb['mb_id'] ?>
      </div>
      <div class="name">
        이름 : <?php echo $mb['mb_name'] ?>
      </div>
      <div class="sign">
        <a href="./register.php?mode=modify">회원수정</a>
        <a href="./logout.php">로그아웃</a>
      </div>
     </div>
    <?php } ?>
   </body>
 </html>
