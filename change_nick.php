<!DOCTYPE html>
<html>
<head>
	<title>change_nick</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
     <form action="change_nick_db.php" method="post">
     	<h2>更改暱稱</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          

          <label>新暱稱</label>
        <input type="text" 
                name="nick_name" 
                placeholder="nick_name"><br>

          <label>輸入密碼</label>
          <input type="password" 
                 name="nick_password" 
                 placeholder="password"><br>

        <button type="submit">Change</button>
          <a href="Member.php" class="ca"> 回會員頁</a>
     </form>
</body>
</html>