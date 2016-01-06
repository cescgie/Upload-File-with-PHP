<?php
require "Storage.php";
$db = new Storage();

	if(isset($_FILES['image'])){
		$errors= array();
		$file_name = $_FILES['image']['name'];
		$file_size =$_FILES['image']['size'];
		$file_tmp =$_FILES['image']['tmp_name'];
		$file_type=$_FILES['image']['type'];
		$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

		$expensions= array("jpeg","jpg","png","pdf");
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size > 2097152){
		$errors[]='File size must be excately 2 MB';
		}
		if(empty($errors)==true){
			$data['name'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file_name);
			$data['size'] = $file_size;
			$data['path'] = "files/".$file_name;
			$data['insert_at'] = date('Y-m-d H:i:s');

			$check_exist = $db->select('SELECT count(*) as count FROM images WHERE name = "'.$data['name'].'"');
			if($check_exist[0]['count'] != 1){
				$insert = $db->insert('images',$data);
				$upload = move_uploaded_file($file_tmp,"files/".$file_name);
				if($upload){
					echo "Success";
				}
			}else{
				echo "File exists";
			}
		}else{
			print_r($errors);
		}
	}

$select = $db->select("SELECT * FROM images ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
	<header>
		<title>Upload File</title>
	</header>
<body style="margin-left:50px;margin-top:50px;">
	<a href="index.php"><h1>Upload File</h1></a>
	<form action="" method="POST" enctype="multipart/form-data">
	  <input type="file" name="image"/>
	  <input type="submit" value="Submit"/>
	</form>

	<hr>

	<?php if(!sizeof($select)):?>
		<p>No data</p>
	<?php else:?>
		<table>
			<tr>
				<th>File</th>
				<th>Insert at</th>
			</tr>
		<?php foreach ($select as $key => $value): ?>
			<tr>
				<td><?= $value['name'];?></td>
				<td><?= $value['insert_at'];?></td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif;?>
</body>
</html>
