<?php 
//open connection to database
include("./cms/db_connect.php");

$q = (isset($_REQUEST["q"]))?$_REQUEST["q"]:"";
$q = trim(strip_tags($q));

if ($q != "") {
	//select posts grouped by month and year
	$sql = "SELECT post_id, title, summary, DATE_FORMAT(postdate, '%e %b %Y at %H:%i')
	AS dateattime FROM posts WHERE 
	MATCH (title,summary,post) AGAINST ('$q') LIMIT 50";
	$result = mysql_query($sql);
	$myposts = mysql_fetch_array($result);
}

//format search for HTML display
$q = stripslashes(htmlentities($q));

include("functions.php");
?>

<!doctype>
<html>
	<head>
		<meta charset="utf-8">
		<title>The Lone Lama</title>
		
		<link href='http://fonts.googleapis.com/css?family=Poiret+One|Montez|Flamenco|The+Girl+Next+Door|Yesteryear|Monofett|Righteous|Londrina+Shadow' rel='stylesheet' type='text/css'>
		<script src="https://code.jquery.com/jquery.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="../dist/js/bootstrap.min.js"></script>
		<link href="../dist/css/bootstrap.css" rel="stylesheet">
		
		<style type="text/css"> @import url(../css/site.css); </style>
	</head>
	<body>
		<div class="container">
			<?php include("header.php"); ?>
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<!--this is the main part of the page -->
					<div id="maincontent">
						
						<div id="posts">
							<h2>Search Results</h2>
							<div id="results">
								<?php
								if($myposts) {
									$numresults = mysql_num_rows($result);
									$plural1 = ($numresults==1) ? "is" : "are";
									$plural2 = ($numresults==1) ? "" : "s";
									echo "<p>There $plural1 <em>$numresults</em> post$plural2 matching your search for <cite>$q</cite>.</p>";
									echo "<dl>\n";
									do {
										$post_id = $myposts["post_id"];
										$title = $myposts["title"];
										$summary = $myposts["summary"];
									echo "<dt><a href='post.php?post_id=$post_id'>$title</a></dt>\n";
									echo "<dd>$summary</dd>\n";
									} while ($myposts = mysql_fetch_array($result));
									echo "</dl>";
								} else {
									echo "<p>There were no posts matching your search for <cite>$q</cite>.</p>";
								}
								?>
							</div>
						</div>
						
						<!--sidebar ends -->
					</div>
					<!--maincontent ends -->
				</div>
			</div>
		
		

		
		<?php include("footer.php"); ?>
		</div>
	</body>
</html>