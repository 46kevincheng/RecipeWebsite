<!DOCTYPE html>
<html>
<head>
	<title>change_pw</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
     <form action="change_pw_db.php" method="post">
     	<h2>更改密碼</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          

          <label>舊密碼</label>
        <input type="text" 
                name="old_password" 
                placeholder="old password"><br>
          
     	<label>新密碼</label>
     	<input type="password" 
                 name="new_password" 
                 placeholder="new_password"><br>

          <label>確認新密碼</label>
          <input type="password" 
                 name="re_new_password" 
                 placeholder="Re_new_password"><br>

        <button type="submit">Change</button>
          <a href="Member.php" class="ca">放棄修改 回會員頁</a>
     </form>
</body>
</html>