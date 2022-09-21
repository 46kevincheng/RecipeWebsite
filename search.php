<?php 
    session_start();
    include "db_conn.php";
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="css/styleSearch.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>就是要cooking</title>
    <style>
        .deleteBtn:hover{
            cursor:pointer ;
        }
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
        <?php   
            $isAdmin= 0;
            if (isset($_SESSION['id']) && isset($_SESSION['email'])){
            $id = $_SESSION['id'] ;
            $adminSQL = "SELECT admin FROM db_account WHERE id = $id " ;
            $res = $conn->query($adminSQL);
            $query = mysqli_fetch_assoc($res) ;
            $isAdmin = $query['admin'] ;
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
                ?> 
                <li><a href="Member.php">會員中心</a></li>
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
                        <input type="search" class="search" name="search" id="search" value="<?php searchText() ; ?>" placeholder="搜尋料理、廚師、類型或食材..." />
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

<?php

    function searchText(){
        if(isset($_POST['search'])){
            echo $_POST['search'] ;
        }else if(isset($_SESSION['dish'])){
            echo $_SESSION['dish'] ;
        }
    }
    if(isset($_POST['deleteBtn'])){
        $deleteID = $_POST['deleteBtn'] ;
        $deleteSql = "DELETE FROM dish WHERE dish_id = $deleteID ;" ;
        $run = $conn->query($deleteSql);
    }
    //echo "['dish']:" . $_SESSION['dish'] ;
    if(isset($_POST['search'])){
        $dish = $_POST['search'];
        $_SESSION['dish'] =  $_POST['search'];
    }else{
        $dish = $_SESSION['dish'] ;
    }
    $sql = "SELECT * FROM dish WHERE
        dish_name LIKE '%$dish%' OR
        chef LIKE '%$dish%' OR
        dish_type LIKE '%$dish%' OR
        ingredients LIKE '%$dish%'
        ORDER BY likes DESC, dish_type, chef, dish_id " ;
    $result = $conn->query($sql);

    if ($dish==""){ //未輸入搜尋資料，抓全部dish
        $sql = "SELECT * FROM dish ORDER BY likes DESC, dish_type, chef, dish_id " ;
        $result = $conn->query($sql);
    }
    if (($result->num_rows > 0))
    {
        while($row = mysqli_fetch_assoc($result)){
            $output ="<div class='outContainer'>";
            $output .= "<form method='POST' action='recipe.php'>" ;
                $output .="<button type='submit' class='content' name='dish_id' value='{$row['dish_id']}'>";   
                    //image
                    $output .= '<img src="data:image/*;base64,'.base64_encode($row['image'] ).'" class=\'column image\' width=256px height=192px ></image>' ;
                    $output .= "<div class='column middle'>" ;
                        //食譜名稱
                        $output .= "<div class='dishname'>" ;
                        $output .= $row['dish_name'] ;
                        $output .= "</div>" ;
                        //分類
                        $output .= "<div class='dishtype'>" ;
                        $output .= $row['dish_type'];
                        $output .= "</div>" ;
                        //創作者
                        $output .= "<div class='chef'>by " ;
                        $output .= $row['chef'];
                        $output .= "</div>" ;
                        $output .= "<div class='likes'>點讚數 " ;
                        $output .= $row['likes'];
                        $output .= "</div>" ;
                    $output .= "</div>" ;
                    //介紹
                    $output .= "<div class='column intro'>" ;
                    $output .= $row['intro'] ;
                    $output .= "</div>" ;
                $output .="</button>" ;

           
            
            $output .="</form>";
             
            $output .= "</div>";
            echo $output ;
            // if 登入者是 admin
             if($isAdmin==1){
                // delete button
                $dlt = "" ;
                $dlt .= "<div class='delete'>" ;
                    $dlt .= "<form method='POST' action='#'>" ;
                    $dlt .="<button type='submit' class='deleteBtn' name='deleteBtn' value='{$row['dish_id']}'>刪除</button>" ;
                    $dlt .="</form>" ;
                $dlt .= "</div>" ;
                echo $dlt ;
            }

        }
    }else{ // 有輸入search但無資料
        $noResult ="<div class=\"headerText\">" ;
        $noResult .="哇!您想找的相關料理尚未有人研發喔，快搶先上傳食譜當此道菜的第一位廚神!" ;
        $noResult .="</div>" ;
        echo $noResult ;
    }

?>
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
