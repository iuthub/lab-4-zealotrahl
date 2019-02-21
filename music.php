<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>

		<div id="listarea">
			<ul id="musiclist">
				<?php 
					$playlist = false;

					if(isset($_GET["playlist"]) && $_GET["playlist"]){

						$filename = $_GET["playlist"];
						$file_contents = file_get_contents("songs/".$filename);

						$music = explode("\n", $file_contents);

						$musicFiles = $music;
						$playlist = true;

					}else{
						$musicFiles = glob("songs/*.mp3");
					}

				?>

					<?php 

						foreach ($musicFiles as $filename) {
							$filename = $playlist ? "songs/".$filename : $filename;
					 ?>
							<li class="mp3item">
								<a href="<?= $filename ?>"> <?= basename($filename) ?></a>
								<?php 
									$size = filesize($filename);

									if($size){
										$text = $size;
										$type = "b";


										if($size > 1023 && $size <= 1048575){
											$text = round($size/1024, 1);
											$type = "kb";
										}
										else if($size > 1048575){
											$text = round($size/1048575, 1);
											$type = "mb";
										}

										echo "($text "."$type)";


									}
								 ?>
							</li>
					<?php } ?>


				
				<li class="playlistitem">
					<a href="music.php">All music</a>
				</li>
				<?php 
					foreach (glob("songs/*.txt") as $filename) {
				 ?>
					 <li class="playlistitem">
					 	<a href="music.php?playlist=<?= basename($filename) ?>"><?= basename($filename) ?></a>
					 </li>
				<?php } ?>

			</ul>
		</div>
	</body>
</html>
