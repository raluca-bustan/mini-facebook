
 <?php
 session_start();
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));     
        
        //Create connection and select DB
        $db =  mysqli_connect('localhost', 'root', '', 'user');
        
        // Check connection
        if($db->connect_error){
            die("Connection failed: " . $db->connect_error);
        }
        
        $dataTime = date("Y-m-d H:i:s");
        $username = $_SESSION['username'];
        //Insert image content into database
        $insert = $db->query("INSERT into images (File, ID_user, Date) VALUES ('$imgContent', (SELECT id FROM users WHERE username='$username'),'$dataTime')");
        if($insert){
           header('location: profile.php');
        }else{
            echo "File upload failed, please try again.";
        } 
    }else{
        echo "Please select an image file to upload.";
    }
}
?>
