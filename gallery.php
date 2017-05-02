<?php
require_once 'basic.php';
if(!$loggedIn) die();


$result5 = qM("SELECT * FROM `gallery` WHERE `user_id`=$id");
if($result5->num_rows){
	$row4 = $result5->fetch_assoc();
	$album_id = $row4['id'];
	$user_id = $row4['user_id'];
	$album_name = $row4['album_name'];
}
//da prevedem
?>
		
		<div class="main">
			<h3> Your Galery</h3>
			<?php 
				
				if(!is_dir("images/$id/$album_name")){
					mkdir("images/$id/$album_name", 0777);
				}
				
				if(isset($_POST['sub_album_name'])){
					$sub_album_name = sS($_POST['sub_album_name']);
					if ($sub_album_name == ''){
						$sub_album_name = 'default';
					}
				}
				
				if(isset($_FILES['image']['name'])){
					$result = qM("SELECT * FROM `$album_name`");
					if(($n = $result->num_rows) == 0){
						$pic_name = 1;
					}
					else{
						$row = $result->fetch_assoc();
						$pic_name = $n + 1;
					}
					$saveto = "images/$id/$album_name/".$pic_name.".jpg";
					$date = date("Y-m-d H:i:s");
					move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
					qM("INSERT INTO `$album_name`(`date_update`, `pic_path`, `pic_name`, `album_name`) VALUES('$date', '$saveto', $pic_name, '$sub_album_name')");
					$typeok = TRUE;
					switch ($_FILES['image']['type']){
						case "image/gif":
							$src = imagecreatefromgif($saveto);
							break;
						case "image/jpeg": case "image/pjpeg":
							$src = imagecreatefromjpeg($saveto);
							break;
						case "image/png":
							$src = imagecreatefrompng($saveto);
							break;
						default:
							$typeok = FALSE;
							break;
					}
					if($typeok){
						list($w, $h) = getimagesize($saveto);
						$max = 100;
						$tw = $w;
						$th = $h;
						$x1 = $x2 = 0;
						if($w > $h && $w > $max){
							$tw = $max;
							$th = $h * $max / $w;
							$x1 = $max/2 - $tw/2;
							$x2 = $max/2 - $th/2;
						}
						elseif($h > $w && $h > $max){
							$th = $max;
							$tw = $max / $h * $w;
							$x1 = $max/2 - $tw/2;
							$x2 = $max/2 - $th/2;
						}
						elseif($w > $max){
							$tw = $th = $max;
							$x1 = $max/2 - $tw/2;
							$x2 = $max/2 - $th/2;
						}
						$x1 = $max/2 - $tw/2;
						$x2 = $max/2 - $th/2; //zbog w = h
						$tmp = imagecreatetruecolor($max, $max); //$tw, $th
						$white = imagecolorallocate($tmp, 255, 255, 255);//boji u belo
						imagefill($tmp, 0, 0, $white);//boji u belo
						imagecopyresampled($tmp, $src, $x1, $x2, 0, 0, $tw, $th, $w, $h);
						imageconvolution($tmp, array(array(-1, -1, -1),
								array(-1, 16, 1),
								array(-1, -1, -1)), 8, 0);
					
						imagejpeg($tmp, $saveto);
						imagedestroy($tmp);
						imagedestroy($src);
					}
				}
				if(isset($_GET['picn'])){
					dI($album_name, $_GET['picn']);
				}

				
			?>
			
			<form method="post" action="gallery.php" enctype="multipart/form-data" >

				<label for="image">Add image:</label>
				<input type="file" name="image" id="image"><br>
				
				Create new album by typing the name or enter the name of already existing ones:
				<select name="owner">
				<?php 
					$sql = qM("SELECT DISTINCT `album_name` FROM `$album_name`");
					while ($row = $sql->fetch_assoc()){
						$an = $row['album_name'];
						echo "<option value=$an>" . $an . "</option>";
					}
				?>
				</select>,<br>in contrary pictures will be placed in default album.<br>
				Album name <input type="text" name="sub_album_name" id="sub_album_name"><br>
				<input type="submit" value="Save Profile">
			</form>
		</div><br><br>
		<?php sI($album_name); ?>
	</body>
</html>