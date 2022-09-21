<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

 ?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="css/styletest.css" rel="stylesheet" type="text/css">
        <title>就是要cooking</title>
</head>

<body>
    <div class="wrap">
        <?php 
            // session_start();
        ?>
        <?php    if (isset($_SESSION['id']) && isset($_SESSION['email'])){
        ?> <div id="userWelcome">Welcome &nbsp<?php echo $_SESSION['name']; ?></div>
        <?php 
            }else{
        ?>
        
            <div id="userWelcome">Welcome &nbsp</div>
        <?php        
            }
        ?>

        <div class="title">
            <a href="index.php"><img src="picture\title1.png" width="300px"></a>
            <ul class="list">
                <li><a href="index.php">首頁</a></li>
                <li><a href="#">食譜上傳</a></li>

                <?php    
                    if (isset($_SESSION['id']) && isset($_SESSION['email'])){
                ?> <li><a href="Member.php">會員中心</a></li>
                <li><a href="logout.php">登出</a></li>
                <?php 
                    }else{
                ?>
        
                <li><a href="index.php">登入</a></li>
                <?php        
                    }
                ?>
                <!-- <li><a href="logout.php">登出</a></li> -->
            </ul>
        </div>

        <div class="Upload">
            <form id="Uploadform" method="POST" action="uploadDB.php" enctype="multipart/form-data">
                <table>
                <tr>
                    <td width="25%"><div class="Uploadleft">
                        <strong><p>食譜名稱 </p><strong>
                        <input class="leftline" name="dish_name" type="text">
                    </div></td>

                    <td width="25%"><div class="Uploadright">
                        <strong><p>照片</p><strong>
                        <label for="file" id="file">檔名: </label>
                        <input type="file" name="file" id="file" accept="image/*" />
                    </div></td>
                </tr>

                <tr>
                    <td><div class="Uploadleft">
                        <strong><p>食譜種類</p><strong><br>
                        <select name = "dish_type" class="option">
                            <option>請選擇...</option>
                            <option value = "日式料理">日式料理</option>
                            <option value = "中式料理">中式料理</option>
                            <option value = "義式料理">義式料理</option>
                            <option value = "韓式料理">韓式料理</option>
                            <option value = "美式料理">美式料理</option>
                            <option value = "甜點">甜點</option>
                            <option value = "其他">其他</option>
                        </select>
                        </div>
                    </td>

                    <td><div class="Uploadright">
                        <strong><p>餐點份量</p></strong><br>
                        <input class="leftline" name="serving" type="text">
                        </div>
                    </td>
                </tr>

                <tr><td>
                    <div class="Uploadleft">
                    <strong><p>簡單介紹</p></strong><br>
                    <textarea class="centerline" name="intro" cols="95" rows="10"></textarea>
                    </div>
                </td></tr>

                </table>

                
                <div class="Uploadleft">
                    <strong><p>食材</p></strong>
                    <div id="ingredient">
                        <strong><p>1.</p></strong>
                        <!-- <input class="leftline" name="ingre_name[]" type="text" placeholder="輸入食材名稱">
                        <input class="leftline" name="ingre_num[]" type="text" placeholder="輸入份量">
                        <select class ="leftline" name = "ingre_size[]"> -->
                        <input class="leftline" name="ingre[0][0]" type="text" placeholder="輸入食材名稱">
                        <input class="leftline" name="ingre[0][1]" type="text" placeholder="輸入份量">
                        <select class ="leftline" name = "ingre[0][2]">
                            <option>請選擇單位</option>
                            <option value = g>g</option>
                            <option value = 匙>匙</option>
                            <option value = 包>包</option>
                            <option value = 顆>顆</option>
                        </select>
                    
                    </div><br><br>
                    <input type="button" class="button" id="add" name="add" value="+" onClick="addInput('ingredient');">
                </div>
                

                
                <div class="Uploadleft">
                    <strong><p>作法</p></strong><br>
                    <textarea class="centerline" name="step" cols="95" rows="20"></textarea>
                </div><br>
                

                
                <div class="Uploadleft">
                    <input name="send" class="button"  type="submit" value="上傳">
                </div>
                

                <!-- </table> -->
            </form>
        </div>

        



    </div>





    <script>
        function myalert()
        {
            window.location.href="uploadDB.php" ;
        }

        var counter = 1;
        var count=2;
        var limit = 100;
        
        function addInput(divName) {
            if (counter === limit) {
                alert("You have reached the limit of adding " + counter + " inputs");
            } else {
                var newdiv = document.createElement("div");
                // newdiv.innerHTML = "<strong><p>"+ count++ +".</p></strong><input class='leftline' name='ingreName' type='text' placeholder='輸入食材名稱'><input class='leftline' name='ingreNum' type='text' placeholder='輸入份量'><select class ='leftline' name = 'ingreSize'><option>請選擇單位</option><option value = g>g</option><option value = 匙>匙</option><option value = 包>包</option><option value = 顆>顆</option></select><br>";
                newdiv.innerHTML = "<strong><p>"+ count++ +".</p></strong><input class='leftline' name='ingre[" + count + "][0]' type='text' placeholder='輸入食材名稱'><input class='leftline' name='ingre[" + count + "][1]' type='text' placeholder='輸入份量'><select class ='leftline' name = 'ingre[" + count + "][2]'><option>請選擇單位</option><option value = g>g</option><option value = 匙>匙</option><option value = 包>包</option><option value = 顆>顆</option></select><br>";
                document.getElementById(divName).appendChild(newdiv);
                counter++;
            }
        }
    
    </script>
</body>
</html>

<?php 
}else{
  echo "<script>

    alert('上傳食譜需先登入帳號喔~');

    window.location.href='index.php';

    </script>";
     exit();
}
?>