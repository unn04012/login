<?php
include("./connect.php");
if(isset($_SESSION['ss_mb_id']) && $_GET['mode'] == 'modify'){
  $mb_id = $_SESSION['ss_mb_id'];

  $sql = "SELECT * FROM member WHERE mb_id = '$mb_id'";
  $result = mysqli_query($conn, $sql);
  $mb = mysqli_fetch_assoc($result);
  mysqli_close($conn);

  $mode = "modify";
  $title = "회원수정";
  $modify_mb_info = "readonly";
}else{
  $mode = "insert";
  $title = "회원가입";
  $modify_mb_info = '';
}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Register</title>
     <style media="screen">
     body{
       margin : 0;
       padding : 0;
     }
     .form{
       position : absolute;
       top : 50%;
       left : 50%;
       transform : translate(-50%, -50%);
     }
     .form h1{
       text-align  :center;
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
   <body>
     <div class="form">
       <h1> <?php echo $title ?> </h1>
       <form class="" action="./register_update.php" onsubmit = "return fregisterform_submit(this);" method="post">
         <input type="hidden" name="mode" value="<?php echo $mode ?>">
         <table>
           <tr>
             <th>아이디</th>
             <td><input type="text" name="id" value="<?php echo $mb['mb_id'] ?>"<?php echo $modify_mb_info ?>> </td>
           </tr>
           <tr>
             <th>비밀번호</th>
             <td><input type="password" name="pw" value=""> </td>
           </tr>
           <tr>
             <th>비밀번호 확인</th>
             <td><input type="password" name="pw_re" value=""> </td>
           </tr>
           <tr>
             <th>이름</th>
             <td><input type="text" name="name" value="<?php echo $mb['mb_name'] ?>" <?php echo $modify_mb_info ?>> </td>
           </tr>
           <tr>
             <th>이메일</th>
             <td><input type="email" name="email" value="<?php echo $mb['mb_email'] ?>"> </td>
           </tr>
           <tr>
             <th>성별</th>
             <td>
               <label for=""><input type="radio" name="mb_gender" value="남자"<?php echo ($mb['mb_gender'] == "남자") ? "checked":"" ?>>남자</label>
               <label for=""><input type="radio" name="mb_gender" value="여자"<?php echo ($mb['mb_gender'] == "여자") ? "checked":"" ?>>여자</label>
             </td>
           </tr>
         </table>
       </form>
     </div>
     <script type="text/javascript">
      function fregisterform_submit(f){
        if(f.id.value.length < 1){
          alert("아이디를 1글자 이상 입력하십시오.");
          f.id.focus();
          return false;
        }
        if(f.name.value.length < 1){
          alert("이름을 입력하십시오");
          f.name.focus();
          return false;
        }
        if(f.mb_password.value.length < 3){
          alert("비밀번호를 3글자 이상 입력하십시오.");
          f.pw.focus();
          return false;
        }
        if(f.pw.value !== f.pw_re.value){
          alert("비밀번호가 같지 않습니다.");
          f.pw_re.focus();
          return false;
        }
        if(f.pw.value.length > 0){
          if(f.pw_re.value.length < 3){
            alert("비밀번호를 3글자 이상 입력하십시오");
            f.pw_re.focus();
            return false;
          }
        }
      }
     </script>
   </body>
 </html>
