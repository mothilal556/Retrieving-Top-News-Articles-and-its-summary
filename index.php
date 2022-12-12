<!DOCTYPE html>
<html lang="en">
<?php include 'headtag.php' ?>
<body>

<div class="container">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<h2>Get Top News Articles</h2>
			<form action="index.php" method="post">
				<div class="form-group">
					<label for="email">No. of Articles you need:</label>
					<select name="count" class="form-control"  onchange='this.form.submit()'>
					<option value="">---</option>
					<?php
						for($i=20;$i>0;$i--)
						{
							echo "<option value='$i'>$i</option>";
						}
					?>
					</select>
				</div>
			</form>
		</div>
		<div class="col-sm-4"></div>
	</div>
</div>
<?php
if (!empty($_POST)) {
	$count=$_POST["count"];
	$query = "NewsArticles.py ".$count;
	$command = escapeshellcmd($query);
	$output = shell_exec($command);
?>
<center><div id="google_translate_element"></div></center>
<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-10">
			<h2>Top <?php echo $count; ?> News Articles</h2>
			<?php
				echo "$output";
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php
}
?>

<?php include 'footer.php' ?>
</body>
</html>
