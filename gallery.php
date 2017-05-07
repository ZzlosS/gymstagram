<?php
require_once 'basic.php';
if(!$loggedIn) die();

$result5 = qM("SELECT * FROM `pictures` WHERE `user_id`=$id");
if($result5->num_rows){
	$row4 = $result5->fetch_assoc();
	$pic_id = $row4['id'];
	$user_id = $row4['user_id'];
	$album_name = $row4['album_name'];
    $pic_desc = $row4['pic_desc'];
    $pic_like = $row4['pic_like'];
}

//da prevedem
?>
		
		<div class="main">
			<h3> Your Gallery</h3> <!-- ubaci u recnik -->
			<?php
				if(!is_dir("images/$id/album")){
					mkdir("images/$id/album", 0777);
				}

				if(isset($_POST['sub_album_name'])){
					$sub_album_name = sS($_POST['sub_album_name']);
					if($sub_album_name == ''){
					    $sub_album_name = 'Default';
                    }
				}

				if(isset($_POST['desc'])){
				    $desc = sS($_POST['desc']);
                }

				if(isset($_FILES['image']['name'])){
					/*$result = qM("SELECT * FROM `pictures`");
					if(($n = $result->num_rows) == 0){
						$pic_name = 1;
					}
					else{
					    $b = qM("SELECT MAX(id) FROM `pictures`");
					    $c = $b->fetch_all();
						$pic_name = $c + 1;
					}*/
                    $name = date("YmdHis");
					$saveto = "images/$id/album/".$name.".jpg";
                    $date = date("Y-m-d H:i:s");
					move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
					qM("INSERT INTO `pictures`(`user_id`, `date_update`, `pic_path`, `album_name`, `pic_desc`) 
                              VALUES('$id', '$date', '$saveto', '$sub_album_name', '$desc')");
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
				if(isset($_GET['id'])){
					dI($_GET['id']);
				}

				
			?>
			
			<form method="post" action="gallery.php" enctype="multipart/form-data" >

				<label for="image">Add image:</label>
				<input type="file" name="image" id="image"><br>
				
				<label>Create new album by typing the name or enter the name of already existing ones:
				<select name="owner">
				<?php 
					$sql = qM("SELECT DISTINCT `album_name` FROM `pictures` WHERE `user_id`=$id");
                    echo "<option value='default'>Default</option>";
                    while ($row = $sql->fetch_assoc()) {
                        $an = $row['album_name'];
                        echo "<option value=$an>" . $an . "</option>";
                    }
				?>
				</select>,<br>in contrary pictures will be placed in Default album.</label><br>
                <label>Album name <input type="text" name="sub_album_name" id="sub_album_name"></label> <br>
                <label>Description <input type="text" name="desc" id="desc"></label> <br>
                <input type="submit" value="Save Profile">
			</form>
		</div><br><br>
		<?php sI($id); ?>
	</body>
</html>