<?php
include($_SERVER["DOCUMENT_ROOT"] . "/cms/session.php");
include($_SERVER["DOCUMENT_ROOT"] . "/functions.php");
//If magic quotes is turned on then strip slashes
if (get_magic_quotes_gpc()) {
	foreach ($_POST as $key => $value) {
		$_POST[$key] = stripslashes($value);
	}
}

//Extract form submission
$title = (isset($_POST["title"]))?$_POST["title"]:"";
$postdate = (isset($_POST["postdate"]))?$_POST["postdate"]:"";
$summary = (isset($_POST["summary"]))?$_POST["summary"]:"";
$post = (isset($_POST["post"]))?$_POST["post"]:"";
$submitAdd = (isset($_POST["submitAdd"]))?$_POST["submitAdd"]:"";

//Open connection to database
include("db_connect.php");

//Prepare data for database
$db_title = trim(addslashes($title));
$db_postdate = trim(addslashes($postdate));
$db_summary = trim(addslashes($summary));
$db_post = trim(addslashes($post));

//If form has been submitted, insert post into database
if ($submitAdd) {
	$sql = "INSERT INTO posts
		(title, postdate, summary, post)
		VALUES ('$db_title', '$db_postdate', '$db_summary', '$db_post')";
	$result = mysql_query($sql);
	if (!$result) {
		$message = "Failed to insert post. MySQL said " . mysql_error();
	} else {
		$message = "Successfully inserted post '$title'.";
		//$message .= "<br />" . makerssfeed();
	}
}

//Get post_id from query string
$post_id = (isset($_REQUEST["post_id"]))?$_REQUEST["post_id"]:"";

//If post_id is a number get post from database
if (preg_match("/^[0-9]+$/", $post_id)) {
	$editmode = true;

	//If form has been submitted, update post
	if (isset($_POST["submitUpdate"])) {
		$sql = "UPDATE posts SET
		title = '$db_title',
		postdate = '$db_postdate',
		summary = '$db_summary',
		post = '$db_post'
		WHERE post_id = $post_id";
	$result = mysql_query($sql);
	if (!$result) {
		$message = "Failed to update post. MySQL said " . mysql_error();
	} else {
		$message = "Successfully updated post '$title'.";
		//$message .= "<br />" . makerssfeed(); 
	}
	}

	$sql = "SELECT title, postdate, summary, post FROM posts WHERE post_id=$post_id";
	$result = mysql_query($sql);
	$mypost = mysql_fetch_array($result);

	if($mypost) {
		$title = $mypost["title"];
		$postdate = $mypost["postdate"];
		$summary = $mypost["summary"];
		$post = $mypost["post"];
	} else {
		$message = "No post matching that post_id.";
	}
} else {
	$editmode = false;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta charset="utf-8">
		
		<link href='http://fonts.googleapis.com/css?family=Bilbo+Swash+Caps|Felipa|Swanky+and+Moo+Moo|Just+Me+Again+Down+Here' rel='stylesheet' type='text/css'>
		<script src="https://code.jquery.com/jquery.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="../dist/js/bootstrap.min.js"></script>
		<link href="../dist/css/bootstrap.css" rel="stylesheet">
		
		<style type="text/css"> @import url(../cms/css/cms.css); </style>

		<title>
			<?php 
			switch ($editmode) {
			case true:
				echo "Edit a post";
				break;
			case false:
				echo "Add a post";
				break;
			}
			?>
			 - BLog CMS
		</title>
		<style type="text/css"> @import url(../cms/css/cms.css); </style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-md-8">
					<h1>
						<?php 
						switch ($editmode) {
							case true:
								echo "Edit a post";
								break;
							case false:
								echo "Add a post";
								break;
						}
						?>
					</h1>
					<?php 
					if (isset($message)) {
						echo "<p class='message'>$message</p>";
					}
					?>
					<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
						<div class="form-group">
					      <div class="col-sm-10">
					        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php if (isset($title)) {echo $title;} ?>">
					      </div>
					    </div>
					    <div class="form-group">
					      <div class="col-sm-10">
					        <input type="text" class="form-control" id="date" name="postdate" placeholder="yyyy-mm-dd" value="<?php if (isset($postdate)) {echo $postdate;} ?>" >
					      </div>
					    </div>
					    <div class="form-group">
					      <div class="col-sm-10">
					        <textarea class="form-control" rows="3" id="summary" name="summary" placeholder="Summary"><?php if (isset($summary)) {echo $summary;} ?></textarea>
					      </div>
					    </div>
					    <div class="form-group">
					      <div class="col-sm-10">
					        <textarea class="form-control" rows="3" id="post" name="post" placeholder="Post"><?php if (isset($post)) {echo $post;} ?></textarea>
					      </div>
					    </div>
					    <div class="form-group">
					      <div class="col-sm-offset-2 col-sm-10">
					        <?php 
									switch ($editmode) {
										case true:
											echo "<input type='hidden' name='post_id' value='$post_id' />";
											
											echo "<button type='Submit' name='submitUpdate' value='Update post' />Update Post</button>";
											break;
										case false:
											echo "<button type='Submit' name='submitAdd' value='Add post' />Add Post</button>";
											break;
									}
									?>
					        
					      </div>
					    </div>
					</form>
				</div>
				<?php include("nav.inc") ?>
			</div><!--end row-->
		</div><!--end container-->
		
	</body>
</html>
