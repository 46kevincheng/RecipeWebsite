<?php 
    session_start();
    include "db_conn.php";


    if(isset($_POST['dish_name']) && isset($_POST['dish_type']) && isset($_POST['serving']) && 
        isset($_POST['ingre']) && isset($_POST['step']) && isset($_SESSION['id'])){

    $username = $_SESSION['name']; 
    $dish_name = $_POST['dish_name'] ;
    $dish_type = $_POST['dish_type'];
    $serving = $_POST['serving'] ;
    $chef_id = $_SESSION['id'] ;
    
    $ingre = $_POST['ingre'] ;
    $ingredient = "" ;
    foreach ($ingre as $bike){
        foreach($bike as $value){
            $ingredient .= $value ;
        }
        $ingredient .= "," ;
    }
    $rec = rtrim($ingredient,",");
    //echo $rec ."<br>";
    $ingre_step = $_POST['step'] ;
    $intro = $_POST['intro'] ;

    // image
    //建立upload資料夾
    $targetDir = "upload/";
    if(!file_exists($targetDir)){

        mkdir($targetDir, 0777, true);

    }

    $imageName = $_FILES["file"]["name"];

    $imageData = addslashes(file_get_contents($_FILES['file']['tmp_name']));
    $targetFilePath = $targetDir . $imageName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    // sql to insert into DB
    $sql = "
    INSERT INTO dish(dish_name, chef, dish_type, servings, ingredients, steps, intro, image, chef_id)
    VALUES ('$dish_name','$username','$dish_type','$serving','$rec','$ingre_step','$intro','$imageData','$chef_id')" ;

    //echo $sql. "<br>" ;
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                alert('上傳成功');
                window.location.href='index.php'</script>";
        }else {
            echo "資料庫連線失敗" ;
            // echo "<script>
            // alert('資料庫連線失敗');
            // history.go(-1)</script>";
        }
    }else{
        echo "<script>
            alert('請選擇上傳照片');
            history.go(-1)</script>";
    }
    $conn->close();

    
    }else{
        echo "<script>
        alert('有空白欄位尚未填寫喔~');
        history.go(-1)</script>";
    }
?>