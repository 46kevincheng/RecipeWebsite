<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="css/styleother.css" rel="stylesheet" type="text/css">
    <link href="css/responsive.css" rel="stylesheet" type="text/css">
    <title>就是要cooking</title>
</head>

<body>
    <div class="wrap">
        <?php 
            session_start();
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
            <a href="index.php"><img src="picture\title1.png" width="400px"></a>
            <ul class="list">
                <li><a href="index.php">首頁</a></li>
                <li><a href="upload.php">食譜上傳</a></li>

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
            </ul>
        </div>
        <div class ="top"><img src="picture\otherbanner1.png" ></div>

        <!-- menu -->
        <div class="menu">
            <ul>
                <li>
                    <div class="type">
                        <div class="menupicture"><img src="picture\othermenu1.png" height="250" width="160px"></div>
                        <a href="japanese.php">日式料理</a>
                    </div>
                </li>
            </ul>
            <ul>
                <li>
                    <div class="type">
                        <div class="menupicture"><img src="picture\othermenu1.png" height="250" width="160px"></div>
                        <a href="chinese.php">中式料理</a>
                    </div>
                </li>
            </ul>
            <ul>
                <li>
                    <div class="type">
                        <div class="menupicture"><img src="picture\othermenu1.png" height="250" width="160px"></div>
                        <a href="italian.php">義式料理</a>
                    </div>
                </li>
            </ul>
            <ul>
                <li>
                    <div class="type">
                        <div class="menupicture"><img src="picture\othermenu1.png" height="250" width="160px"></div>
                        <a href="korean.php">韓式料理</a>
                    </div>
                </li>
            </ul>
            <ul>
                <li>
                    <div class="type">
                        <div class="menupicture"><img src="picture\othermenu1.png" height="250" width="160px"></div>
                        <a href="american.php">美式料理</a>
                    </div>
                </li>
            </ul>
            <ul>
                <li>
                    <div class="type">
                        <div class="menupicture"><img src="picture\othermenu1.png" height="250" width="160px"></div>
                        <a href="dessert.php">甜點</a>
                    </div>
                </li>
            </ul>
            <ul>
                <li>
                    <div class="type">
                        <div class="menupicture"><img src="picture\othermenu1.png" height="250" width="160px"></div>
                        <a href="#">其它</a>
                    </div>
                </li>
            </ul>
        </div>
        
        
        
        
        <div class="recipelist">
            
            <?php 
                include "db_conn.php";
                $sql = "SELECT * FROM dish WHERE dish_type LIKE '%其他%'";
                $result = $conn->query($sql);

                if (($result->num_rows > 0))
                {
                    while($row = mysqli_fetch_assoc($result)){
                        $output = "<div class='oneDish'>";
                        $output .= "<form method=\"POST\" action=\"recipe.php\">" ;
                            $output .="<button type='submit' class='content' name='dish_id' value='{$row['dish_id']}'>"; 
                            //recipe Image
                            $output .= '<img src="data:image/*;base64,'.base64_encode($row['image'] ).'"  height="220" width="220" />';
                            $output .= "</button>";
                            $output .= "<div class='content'>";
                                $output .= "<ul class='dishList'>";
                                $output .= "<div class='dishname'>";
                                $output .= '<li>'.$row['dish_name'] .'</li>';
                                $output .= "</div>";

                                $output .= "by";
                                $output .= "<div class='chef'>";
                                $output .= '<li>'.$row['chef'] .'</li>';
                                $output .= "</div>";

                                $output .= "</ul>";
                            $output .= "</div>";
                        $output .= "</form></div>";

                        echo $output;
                    }
                }else{ // 查無資料
                    $noResult ="<div class=\"headerText\">" ;
                    $noResult .="哇!您想找的相關料理尚未有人研發喔，快搶先上傳食譜當此道菜的第一位廚神!" ;
                    $noResult .="</div>" ;
                    echo $noResult ;
                }

            ?>
            
        </div> 

    </div>





</body>
</html>







