<?php 
//open connection to the database
include ("functions.php");
include("./cms/db_connect.php");

//select 5 most recent posts
$myposts = [];
$sql = "SELECT post_id, title, post, DATE_FORMAT(postdate, '%e %b %Y at %H:%i') AS dateattime FROM posts ORDER BY postdate DESC, post_id DESC LIMIT 5";
$result = mysql_query($sql);
while($row = mysql_fetch_assoc($result)) {
	$myposts[] = $row;
}
?> 


<!doctype>
<html>
	<head>
		<meta charset="utf-8">
		<title>The Lone Lama</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href='http://fonts.googleapis.com/css?family=Poiret+One|Montez|Flamenco|The+Girl+Next+Door|Yesteryear|Monofett|Righteous|Londrina+Shadow' rel='stylesheet' type='text/css'>

		<script src="https://code.jquery.com/jquery.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="../dist/js/bootstrap.min.js"></script>
		<link href="../dist/css/bootstrap.css" rel="stylesheet">
		<link href="../css/font-awesome.min.css" rel="stylesheet">
		<style type="text/css"> @import url(../css/site.css); </style>

	</head>
	<body>
		<div class="container">
			
			<?php include("header.php"); ?>
			
			
			<!--this is the main part of the page-->
			<div class="row">
				<div class="col-sm-6 col-md-6">
					<div id="maincontent">
						<div id="posts">
							<?php 
							if(sizeof($myposts) > 0) {
								$post_id = $myposts[0]["post_id"];
								$title = $myposts[0]["title"];
								$entry = format($myposts[0]["post"]);
								$dateattime = $myposts[0]["dateattime"];
								echo "<h2 id='post$post_id'><a href='post.php?post_id=$post_id' rel='bookmark'>
								$title</a></h2>\n";
								echo "<h4>Posted on $dateattime</h4>\n";
								echo "<div class='post'>$entry</div>";
							} else {
								echo "<p>I haven't posted to my blog yet.</p>";
							}
							?>
						</div>
					</div>
					<!--maincontent ends-->
				</div><!--end col-6-->
				<div class="col-sm-6 col-md-6">
					<img alt="Boston skyline" src="../img/boston-skyline2.jpeg" id="mainImage" title="click image to stop animation">
					
				</div>
			</div><!--end row-->
			<div class="row">
				<div class="col-sm-6 col-md-6">
					<div id="recent">
						<h3>Recent posts</h3>
						<?php
						if(sizeof($myposts) > 0) {
							echo "<ul>\n";
							foreach($myposts as $post) {
								$post_id = $post["post_id"];
								$title = $post["title"];
								echo "<li><a href='post.php?post_id=$post_id' rel='bookmark'>
								$title</a></li>\n";
							}
							echo "</ul>";
						}
						?>
					</div><!--end recent-->
				</div><!--end col-6-->
				<div class="col-sm-6 col-md-6">
					<div id="sidebar">
						<div id="about">
							<h3>The Lone Lama Blog</h3>
							<p>Here at The Lone Lama we are dedicated to providing a beautiful and rare intellectual journey into the mind of the everyday person who also considers themselves a diamond in the rough, a unique find who wonders why everyone else can't see their greatness. In short, we are the lone llamas of the world.</p>
						</div>
					</div>
				<!--sidebar ends-->
				</div>
			</div><!--end row-->
				
				
			
			<?php include("footer.php"); ?>
		</div><!--end container-->
		<script src="script.js"></script>
	</body>
</html>