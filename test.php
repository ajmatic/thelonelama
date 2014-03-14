<!doctype>
<html>
<form " method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?> class="form-horizontal" role="form">
	    <div class="form-group">
	      <div class="col-sm-10">
	        <input type="text" name="title" value="<?php if (isset($title)) {echo $title;} ?>"/>

			<input type="text" name="postdate" value="<?php if (isset($postdate)) {echo $postdate;} ?>" />yyyy-mm-dd hh:mm:ss />
			<?php
				if (isset($message)) {
					echo "<p class='message'>".$_POST["message"]."</p>";
				}
			?>
	      </div>
	    </div>
	    <div class="form-group">
	      <div class="col-sm-10">
	        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
	      </div>
	    </div>
	    <div class="form-group">
	      <div class="col-sm-10">
	        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
	      </div>
	    </div>
	    <div class="form-group">
	      <div class="col-sm-10">
	        <input type="text" class="form-control" id="website" name="website" placeholder="Website">
	      </div>
	    </div>
	    <div class="form-group">
	      <div class="col-sm-10">
	        <textarea class="form-control" rows="3" id="comment" name="comment" placeholder="Comments"></textarea>
	      </div>
	    </div>
	    <div class="form-group">
	      <div class="col-sm-offset-2 col-sm-10">
	        <button type="submit" class="btn btn-primary" name="postcomment">Submit</button>
	        
	      </div>
	    </div>
	</form>

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
        <button type="submit" class="btn btn-primary" name="postcomment"><?php 
				switch ($editmode) {
					case true:
						echo "<input type='hidden' name='post_id' value='$post_id' />";
						echo "<input type='Submit' name='submitUpdate' value='Update post' />";
						break;
					case false:
						echo "<input type='Submit' name='submitAdd' value='Add post' />";
						break;
				}
				?></button>
        
      </div>
    </div>

</html>