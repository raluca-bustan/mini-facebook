<?php 
session_start();
$db = new mysqli('localhost','root','','user');

 if($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}

	$us= $_SESSION['username'];

	$_SESSION['index']=0;
	$_SESSION['array']=array();

	if($_SESSION['page']==0) //home page
		//display images in order
		$_SESSION['show'] = $db->query("select count(l.ID_img) as nr,i.Date,u.username,u.id,i.ID_img,i.File 
			FROM images i join users u on u.id=i.ID_user 
					left join likes l on i.ID_img=l.ID_img 
					group by i.ID_img
					order by nr desc,Date DESC");
	else //profile page
		$_SESSION['show'] = $db->query("select count(l.ID_img) as nr,i.Date,u.username,u.id,i.ID_img,i.File 
			FROM images i join users u on u.id=i.ID_user 
						left join likes l on i.ID_img=l.ID_img 
			where i.ID_user=(select id from users where username='$us')
			group by i.ID_img
			order by nr desc,Date DESC");

		//array of images
	 while($row=mysqli_fetch_array($_SESSION['show']))
	 {
	 	$_SESSION['array'][$_SESSION['index']] = $row;
	 	$_SESSION['index']++;
	 }

	 echo $_SESSION['index'];

	 $_SESSION["con"]=0;

	if($_SESSION['page']==0)
		header('location: index.php');
	else
		header('location: profile.php');
		
?>