<?php 
    session_start();
    include "db_conn.php";
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="css/styleRecipe.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>就是要cooking</title>
    <style>
        .text{
            resize:none;
            width:800px;
            height:100px;
        }
        .container{
            font-size:25px;
        }
    </style>
</head>

<body>
    <div class="wrap">
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
                <li><a href="upload.php">食譜上傳</a></li>

                <?php    
                    if (isset($_SESSION['id']) && isset($_SESSION['email'])){
                ?> <li><a href="logout.php">登出</a></li>
                <?php 
                    }else{
                ?>
                <li><a href="index.php">登入</a></li>
                <?php        
                    }
                ?>
            </ul>
        </div>


        <!-- 顯示食譜  -->
        <div class="container">
            <?php 

                if(isset($_POST['Delect'])){
                    
                    $dish_id=$_POST['Delect'];
                    //$_SESSION['dish_id']=$dish_id;
                    $sql=" DELETE FROM dish WHERE dish_id=  '$dish_id'";
                    $conn->query($sql);
                    mysqli_query($conn, $sql);
                    echo "<script> alert('成功刪除食譜~');
                    window.location.href='member.php'; </script>";
                }

                if(isset($_POST['Edit'])){
                    $dish_id=$_POST['Edit'];
                    $_SESSION['dish_id']=$dish_id;                   
                }else if(isset($_SESSION['dish_id'])){
                    $dish_id=$_SESSION['dish_id'];
                }
                if(isset($_POST['updateBtn'])){
                    $u_sql=" UPDATE dish SET  ";
                    if(isset($_POST['nname']) && $_POST['nname']!=""){
                        $nname = $_POST['nname'] ;
                        $u_sql .= " dish_name='$nname' , "  ; 
                    }
                    if(isset($_POST['u_type']) && $_POST['u_type']!="請選擇..."){
                        $u_type = $_POST['u_type'] ;
                        $u_sql .= " dish_type='$u_type' , "  ; 
                    }
                    if(isset($_POST['u_intro']) && $_POST['u_intro']!=""){
                        $u_intro = $_POST['u_intro'] ;
                        $u_sql .= " intro='$u_intro' , "  ; 
                    }
                    if(isset($_POST['u_servings']) && $_POST['u_servings']!=""){
                        $u_servings = $_POST['u_servings'] ;
                        $u_sql .= " servings='$u_servings' , "  ; 
                    }
                    if(isset($_POST['u_ingre']) && $_POST['u_ingre']!=""){
                        $u_ingre = $_POST['u_ingre'] ;
                        $u_sql .= " ingredients='$u_ingre' , "  ; 
                    }
                    if(isset($_POST['u_steps']) && $_POST['u_steps']!=""){
                        $u_steps = $_POST['u_steps'] ;
                        $u_sql .= " steps='$u_steps' , "  ; 
                    }
                    $chef_id = $_SESSION['id'] ;
                    $u_sql .= " chef_id = '$chef_id' WHERE dish_id = '$dish_id' ; "  ; 
                    //echo $u_sql . "<br>" ;
                    $result = $conn->query($u_sql);
                }

                
                $sql = "SELECT * FROM dish WHERE dish_id = $dish_id " ;
                $result = $conn->query($sql);
                if ($result->num_rows > 0)
                {
                    while($row = mysqli_fetch_assoc($result)){
                        $output_u = "" ;
                            $output_u .= "<form method='POST' action='#'>" ;
                            $output_u .= '<img src="data:image/*;base64,'.base64_encode($row['image'] ).'" height="200" width="200" />' . "<br>";
                            $output_u .= "食譜名稱: " . $row['dish_name'] . "<br>" ;
                            $output_u .= "<textarea class='text' name='nname' type='text'></textarea><br> " ;
                            $output_u .= "食譜介紹: " . $row['intro'] . "<br>";
                            $output_u .= "<textarea class='text' name='u_intro' type='text'></textarea> <br>" ;
                            $output_u .= "份量: " . $row['servings'] . "<br>";
                            $output_u .= "<textarea class='text' name='u_servings' type='text'></textarea> <br>" ;
                            $output_u .= "食材: " . $row['ingredients'] . "<br>";
                            $output_u .= "<textarea class='text' name='u_ingre' type='text'></textarea> <br>" ;
                            $output_u .= "步驟: " . $row['steps'] . "<br>";
                            $output_u .= "<textarea class='text' name='u_steps' type='text'></textarea> <br>" ;
                            $output_u .= "食譜分類: " . $row['dish_type'] . "<br>";
                            $output_u .= "<select name = 'u_type' class='option'>
                            <option>請選擇...</option>
                            <option value = '其他'>其他</option>
                            <option value = '日式料理'>日式料理</option>
                            <option value = '中式料理'>中式料理</option>
                            <option value = '義式料理'>義式料理</option>
                            <option value = '韓式料理'>韓式料理</option>
                            <option value = '美式料理'>美式料理</option>
                            <option value = '甜點'>甜點</option>
                            </select><br>" ;

                            $output_u .= "<button type='submit' class='content' name='updateBtn' value='{$row['dish_id']}'>確認更新</button>" ;
                            $output_u .="</form>" ;
                        echo $output_u;
                    }
                } 
            ?>
        </div>

    </div>
</body>
</html>