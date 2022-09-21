<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="css/styleHomepage.css" rel="stylesheet" type="text/css">
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

        <!-- <div class="userWelcome"> -->
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
        <!-- </div> -->
    
        

    
        <div class="title">
            <a href="#"><img src="picture\title1.png" width="400px"></a>
            <ul class="list">
                <li><a href="#">首頁</a></li>
                <li><a href="upload.php">食譜上傳</a></li>
                

                <?php    
                    if (isset($_SESSION['id']) && isset($_SESSION['email'])){
                ?> 
                <li><a href="Member.php">會員中心</a></li>
                <li><a href="logout.php">登出</a></li>
                <?php 
                    }else{
                ?>
        
                <li><a href="login.php">登入</a></li>
                <?php        
                    }
                ?>

                <!-- <li><a href="logout.php">登出</a></li> -->
            </ul>
        </div>

        <!-- search-->
        <div class="searchBox">
            <table class = "searchText">
                <tr>
                <form method="POST" action="search.php">
                    <td>
                        <input type="search" class="search" name="search" id="search" placeholder="搜尋料理、廚師、類型或食材..." />
                    </td>
                    <td>
                        <button type="submit" class="searchbutton">
                        <span class="material-symbols-outlined">search</span>
                    </td>
                </form>
                </tr>   
            </table>
        </div>


        <!-- 食譜類別選拉單 -->
        <div class="menu_Row">
            <img src="picture/menuBar.png" class="dropBtn" width="70px">
            <div class="dropdown-content">
            <a href="japanese.php"><img src="picture/dish_japanese.png" width="70px"></a>
            <a href="chinese.php"><img src="picture/dish_chinese.png" width="70px"></a>
            <a href="italian.php"><img src="picture/dish_italian.png" width="70px"></a>
            <a href="korean.php"><img src="picture/dish_korean.png" width="70px"></a>
            <a href="american.php"><img src="picture/dish_american.png" width="70px"></a>
            <a href="dessert.php"><img src="picture/dish_dessert.png" width="70px"></a>
            <a href="other.php"><img src="picture/dish_other.png" width="70px"></a>
            </div>
        </div>

		 <!-- -------------------------------------SCROLL TO TOP START------------------------------------------------ -->

		 <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>


		<!-- ------------------------------------SCROLL TO TOP END----------------------------------------------- -->

        <div class="container">
            <div class="post">
                <!-- 日式料理 -->
                <div class="leftText">
                    <h2><img class="partText" src="picture\japanText1.png" width="400px"></h2> 
                    <a href="japanese.php" class="button">GO!</a>
                </div>
                <div class="rightPicture">
                    <a href="japanese.php"><img class="image" src="picture\japanese.jpg" width="500px"></a>
                </div>
            </div>
            
            <div class="post">
                <!-- 台式料理 -->
                <div class="leftPicture">
                    <a href="chinese.php"><img class="image" src="picture\taiwanese.png" width="500px"></a>
                </div>
                <div class="rightText">
                    <h2><img class="partText" src="picture\taiwanText1.png" width="400px"></h2> 
                    <a href="chinese.php" class="button">GO!</a>
                </div>
            </div>

            <div class="post">
                <!-- 義式料理 -->
                <div class="leftText">
                    <h2><img class="partText" src="picture\italyText1.png" width="400px"></h2> 
                    <a href="italian.php" class="button">GO!</a>
                </div>
                <div class="rightPicture">
                    <a href="italian.php"><img class="image" src="picture\italian.jpg" width="500px"></a>
                </div>
            </div>

            <div class="post">
                <!-- 韓式料理 -->
                <div class="leftPicture">
                    <a href="korean.php"><img class="image" src="picture\korea.jpg" width="500px"></a>
                </div>
                <div class="rightText">
                    <h2><img class="partText" src="picture\koreaText1.png" width="400px"></h2> 
                    <a href="korean.php" class="button">GO!</a>
                </div>
            </div>

            <div class="post">
                <!-- 美式料理 -->
                <div class="leftText">
                    <h2><img class="partText" src="picture\americaText.png" width="400px"></h2> 
                    <a href="american.php" class="button">GO!</a>
                </div>
                <div class="rightPicture">
                    <a href="american.php"><img class="image" src="picture\american.png" width="500px"></a>
                </div>
            </div>

            <div class="post">
                <!-- 甜點 -->
                <div class="leftPicture">
                    <a href="dessert.php"><img class="image" src="picture\dessert.png" width="500px"></a>
                </div>
                <div class="rightText">
                    <h2><img class="partText" src="picture\dessertText1.png" width="400px"></h2> 
                    <a href="dessert.php" class="button">GO!</a>
                </div>
            </div>

            <div class="post">
                <!-- 其他 -->
                <div class="leftText">
                    <h2><img class="partText" src="picture\others.png" width="400px"></h2> 
                    <a href="other.php" class="button">GO!</a>
                </div>
                <div class="rightPicture">
                    <a href="other.php"><img class="image" src="picture\other.png" width="500px"></a>
                </div>
            </div>
            
            
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
