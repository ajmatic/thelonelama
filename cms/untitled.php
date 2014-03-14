<p>
			Title: <input type="text" name="title" size="40" value="<?php if (isset($title)) {echo $title;} ?>" />
			</p>
			<p>
				Date/time: <input type="text" name="postdate" size="40" value="<?php if (isset($postdate)) {echo $postdate;} ?>" />yyyy-mm-dd hh:mm:ss
			</p>
			<p>
				Summary:<br />
				<textarea name="summary" rows="5" cols="60"><?php if (isset($summary)) {echo $summary;} ?></textarea>
			</p>
			<p>
				Post:<br />
				<textarea name="post" rows="20" cols="60"><?php if (isset($post)) {echo $post;} ?></textarea>
			</p>

			<p>
				<?php 
				switch ($editmode) {
					case true:
						echo "<input type='hidden' name='post_id' value='$post_id' />";
						echo "<input type='Submit' name='submitUpdate' value='Update post' />";
						break;
					case false:
						echo "<input type='Submit' name='submitAdd' value='Add post' />";
						break;
				}
				?>
			</p>
			<button type="submit" class="btn btn-primary" name="postcomment">