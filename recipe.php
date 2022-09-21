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
        #myBtn {
			display: none;
			position: fixed;
			bottom: 20px;
			right: 30px;
			z-index: 99;
			font-size: 18px;
			border: none;
			outline: none;
			background-color: #8077D5;
			color: white;
			cursor: pointer;
			padding: 15px;
			border-radius: 4px;
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
            <a href="index.php"><img src="picture\title1.png" width="400px"></a>
            <ul class="list">
                <li><a href="index.php">首頁</a></li>
                <li><a href="upload.php">食譜上傳</a></li>

                <?php    
                $isAdmin= 0;
                    if (isset($_SESSION['id']) && isset($_SESSION['email'])){
                        $id = $_SESSION['id'] ;
                        $adminSQL = "SELECT admin FROM db_account WHERE id = $id " ;
                        $res = $conn->query($adminSQL);
                        $query = mysqli_fetch_assoc($res) ;
                        $isAdmin = $query['admin'] ;
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

        <div class="searchBox">
            <table class = "searchText">
                <tr>
                <form method="POST" action="search.php">
                    <td>
                        <input type="search" class="search" name="search" id="search" placeholder="搜尋料理、廚師、類型或食材..." />
                    </td>
                    <td>
                        <button class="searchButton" type="submit">
                        <span class="material-symbols-outlined">search</span>
                    </td>
                </form>
                </tr>   
            </table>
        </div>

        <!-- -------------------------------------SCROLL TO TOP START------------------------------------------------ -->

		<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

<!-- ------------------------------------SCROLL TO TOP END----------------------------------------------- -->

        <!-- 顯示食譜  -->
        <div class="container">
            <?php 
                if(isset($_POST['dish_id'])){
                    $_SESSION['dish_id'] = $_POST['dish_id'] ;
                    $dish_id = $_SESSION['dish_id'] ;
                }else{
                    $dish_id = $_SESSION['dish_id'] ;
                }        
                $sql = "SELECT * FROM dish WHERE dish_id = $dish_id " ;
                $result = $conn->query($sql);
                if ($result->num_rows > 0)
                {
                    while($row = mysqli_fetch_assoc($result)){
                        $output = "" ;
                        $output .= "<div class='row'>" ;
                            // 圖片
                            $output .= "<div class='column image'>" ;
                            $output .= '<img src="data:image/*;base64,'.base64_encode($row['image'] ).'" width="500" height="400" />' . "<br>";
                            $output .= "</div>" ;

                            $output .= "<div class='recipe_intro'>";
                                $output .= "<div class='row1'>";
                                    // 食譜名稱
                                    $output .= "<div class='column dishname'>" ;
                                    $output .= $row['dish_name'] . "<br>" ;
                                    $output .= "</div>" ;
                                    // 創作者
                                    $output .= "<div class='column chef'>" ;
                                    $output .= 'By&nbsp ' . $row['chef'] . "<br>";
                                    $output .= "</div>" ;
                                    // 點愛心數
                                    $output .= "<div class='column heartBtn'>" ;
                                    $output .= "<img src='picture/heart.png' width=30px>" ;
                                    $output .= $row['likes'] . "<br>";
                                    $output .= "</div>" ;
                                    $output .= "<div class='heartBtn_Text'>按讚次數</div>";
                                $output .= "</div>";
                            
                                // $output .= "</div>" ;

                                // $output .= "<div class='row'>" ;
                                $output .= "<div class='row1'>";
                                    // 分類
                                    $output .= "<div class='column type'>" ;
                                    $output .= "類型 : " . $row['dish_type']. "<br>";
                                    $output .= "</div>" ;
                                    // 份量
                                    $output .= "<div class='column serve'>" ;
                                    $output .= "份量 : " .$row['servings']. "人份". "<br>";
                                    $output .= "</div>" ;
                                $output .= "</div>";
                                // 介紹
                                $output .= "<div class='rowIntro'>";
                                    $output .= "<div class='intro'>" ;
                                    $output .= $row['intro'] . "<br>";
                                    $output .= "</div>" ;
                                $output .= "</div>";

                                //食譜點愛心
                                if(isset($_POST['heartButton'])){
                                    $updateLike = "UPDATE dish SET likes = likes + 1 WHERE dish_id = $dish_id " ;
                                    $update = $conn->query($updateLike);
                                    echo "<script> alert('謝謝您的讚美~');
                                    window.location.href='recipe.php'; </script>";
                                }

                                $output .= "<div class='rowHeart'>";
                                    $output .= "<form method='POST' action='#'>";
                                        $output .= "<div class='hearty'>";
                                        $output .= "<button type='submit' name='heartButton' class='heartButton'>";
                                        $output .= "<img src='picture/like.png' width=100px></button>";
                                        $output .= "</div>";
                                    $output .= "</form>";
                                $output .= "</div>";

                            $output .= "</div>";
                            
                            
                        $output .= "</div>" ;
                        

                        $output .= "<div class='ingre_cont'>" ; 
                            // 食材
                            $output .= "<div class='ingreTitle'>食材</div>" ; 
                            $output .= "<div class='ingre'>" ;
                                $ingre = explode(',', $row['ingredients']); 
                                foreach($ingre as $str){
                                    $output .= "<img src='picture/blueDish.png' width=30px>";
                                    $output .= "<div class='ingreText'>";
                                        $output .=  $str . "<br>";
                                    $output .= "</div>";
                                }
                                //$output .= $row['ingredients'] . "<br>";
                            $output .= "</div>" ;
                        $output .= "</div>" ;
                        $output .= "<div class='step_cont'>" ; 
                            // 步驟
                            $output .= "<div class='stepTitle'>步驟</div>" ; 
                            $output .= "<div class='steps'>" ;
                                $step = preg_split('/\s\n/', $row['steps'] ) ;
                                foreach($step as $ss){
                                    $output .=  $ss . "<br>";
                                }
                                //$output .= $row['steps'] . "<br>";
                            $output .= "</div>" ;
                        $output .= "</div>" ;

                        echo $output;
                    }
                }

                // -------------------------------------------------------------------------------------------------------------------------------
                // 上傳留言
                if(isset($_POST['commentButton'])){
                    if($_POST['commentText'] !== ""){
                        if(isset($_SESSION['name'])){
                            $uName = $_SESSION['name'] ;
                        }else{
                            $uName = "匿名者" ;
                        }
                        $text = $_POST['commentText'] ;
                        $updateComment = "INSERT INTO comment (dish_id, user_name, comment, date) VALUES ('$dish_id','$uName','$text',now()) " ;
                        $insert = $conn->query($updateComment);
                        echo "<script> alert('謝謝您的評論~');
                        window.location.href='recipe.php'; </script>";
                    }else{ // 未填寫留言
                        echo "<script> alert('您尚未留言喔~')</script>";
                    }
                }
                
                //留言點讚
                if(isset($_POST['likeButton'])){
                    $comment_id = $_POST['likeButton'] ;
                    $updateLike = "UPDATE comment SET heart = heart + 1 WHERE comment_id = $comment_id " ;
                    $update = $conn->query($updateLike);
                    echo "<script> alert('謝謝您的讚~');
                    window.location.href='recipe.php'; </script>";
                }
                if(isset($_POST['deleteBtn'])){
                    $deleteID = $_POST['deleteBtn'] ;
                    $deleteSql = "DELETE FROM comment WHERE comment_id = $deleteID ;" ;
                    $run = $conn->query($deleteSql);
                    echo "<script> alert('已刪除留言');
                    window.location.href='recipe.php'; </script>";
                }
            ?>
        </div>

        <!-- 上傳留言 -->
        <form method='POST' action='#'>  
        <div class='uploadComment'>  <!-- row  -->
            <textarea class="inputText" name="commentText" placeholder="發表留言..."></textarea>
            <!-- </div> -->
            <button type="submit" class='commentbutton' name='commentButton'>上傳</button>
        </div>
        </form>

        <!-- 留言區 -->
        <div class='commentSection'>
        <form method='POST' action='#'>     
            <?php
                $commentSQL = "SELECT * FROM comment WHERE dish_id = $dish_id " ;
                $res = $conn->query($commentSQL);
                if ($res->num_rows > 0)
                {
                    while($row = mysqli_fetch_assoc($res)){
                        $output = "" ;
                        $output .= "<div class='com_container'>" ;//一則留言
                            $output .= "<div class='comment'>" ;//留言內容
                                $output .= $row['comment'] ;
                            $output .= "</div>" ;

                            $output .= "<div class='commentData'>" ;//留言資料
                                $output .= "<div class='column name'>" ;
                                    $output .= $row['user_name'] ;
                                $output .= "</div>" ;

                                $output .= "<div class='column date'>" ;
                                    $output .= $row['date'] ;
                                $output .= "</div>" ;

                                $output .= "<div class='column like'>" ;
                                    $output .= "<button type='submit' class='likeButton' name='likeButton' value='{$row['comment_id']}'>
                                    <img src='picture/likeButton.png' class='likeButton' width=20px></button>" ;
                                    // $output .= "<button type='submit' class='likeButton' name='likeButton' value='{$row['comment_id']}'></button>" ;
                                        $output .= $row['heart'] ;
                                $output .= "</div>" ;

                                if($isAdmin==1){
                                    // delete button
                                    $dlt = "" ;
                                    $dlt .= "<div class='delete'>" ;
                                        $dlt .= "<form method='POST' action='#'>" ;
                                        $dlt .="<button type='submit' class='deleteBtn' name='deleteBtn' value='{$row['comment_id']}'>刪除</button>" ;
                                        $dlt .="</form>" ;
                                    $dlt .= "</div>" ;
                                    echo $dlt ;
                                }
                            $output .= "</div>" ;
                        $output .= "</div>" ;

                        $output .= "<br><br>" ;
                        echo $output ;
                        
                    }
                }
            ?>
        </form>
        </div>
    </div>
</body>


<script>
	//Get the button
	var mybutton = document.getElementById("myBtn");
	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
		if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
			mybutton.style.display = "block";
		} else {
			mybutton.style.display = "none";
		}
	}

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}

</script>
</html>
