<?php 
session_start();
include "db_conn.php";
$Member=$_SESSION['id'];
$sql_Member = "SELECT * FROM dish WHERE chef_id = $Member ORDER BY dish_id ASC " ;
$result = $conn->query($sql_Member);


if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

 ?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="css/styleHomepage.css" rel="stylesheet" type="text/css">
    <title>就是要cooking</title>
    <style>
        .change_pw img{
            margin:10px;
            width:200px;
        }
        .change_pw img:hover{
            width:210px;
        }
        .change_nick img{
            margin:10px;
            width:200px;
        }
        .change_nick img:hover{
            width:210px;
        }
        .oneDish{
            display: flex;
            flex-direction: column;
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 10px;
            /* margin: auto; */
            text-align: center;
        }
        .content{
            justify-content: space-between;

        }
        .recipelist{
            width: 90%;
            /* height: 500px; */
            color: #e7e7e7;
            font-size: 20px;
            justify-content:first baseline;
            text-align:justify;
            /* border: 1px solid #c3c3c3; */
            border:none;
            margin: 100px;
            display: flex;
            /* width: 700px; */
            /* margin-left: 20px; */
            flex-wrap: wrap;
            float: left;
        }
        .editbutton{
            height:30px;
            margin:10px;
        }
        .deletebutton{
            height:30px;
            margin:10px;
        }
    </style>
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
            <a href="Member.php"><img src="picture\title1.png" width="300px"></a>
            <ul class="list">
                <li><a href="index.php">首頁</a></li>
                <li><a href="upload.php">食譜上傳</a></li>

                <?php    
                    if (isset($_SESSION['id']) && isset($_SESSION['email'])){
                ?> 
                <li><a href="#">會員中心</a></li>
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
        
        <div class ="membertitle">
            <img src="picture\member_title.png" width="300px">
        </div>

        <div class ="change_pw">
              <a href="change_pw.php"><img src="picture\change_pw.png"></a>
        </div>

        <div class ="change_nick">
              <a href="change_nick.php"><img src="picture\change_nick.png"></a>
        </div>
        
        <br>
        <div class="recipelist">
              
            <?php
                if (($result->num_rows > 0) && ($Member!=""))
                {
                    while($row = mysqli_fetch_assoc($result)){
                    $output = "<div class='oneDish'>";
                    $output .= "<form method='POST' action='message_ud.php'>" ;
                        $output .= '<a href="recipe.php" ><img src="data:image/*;base64,'.base64_encode($row['image'] ).'"  height="220" width="220" /></a>'; 
                        
                        $output .= "<div class='content'>";
                            $output .= "<ul class='dishList'>";
                                $output .= "<div class='dishname'>";
                                    $output .= $row['dish_name'] . "<br>";
                                $output .= "</div>";

                                $output .= "<div class='chef'>";
                                    $output .= $row['dish_type'] . "<br>";
                                $output .= "</div>";

                            $output .= "</ul>";
                    
                            $output .="<button type= 'edit' class='editbutton' name ='Edit'= value = '{$row['dish_id']}' >Edit"; 
                            $output .="<button type='delete' class='deletebutton' name='Delect' value = '{$row['dish_id']}' >DELETE";
                        $output .= "</div>";

                    $output .= "</form></div>";

                  echo $output ;
                  }
                }else{ // 查無資料
                    echo "使用者還沒上傳食譜喔~";
                    exit();
                }
             ?>

        
        </div>

        

    </div>

</body>
</html>

<?php 
}else{
  echo "<script>

    alert('進入會員中心需先登入帳號喔~');

    window.location.href='index.php';

    </script>";
     exit();
}
?>
