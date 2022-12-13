<!DOCTYPE html>
<html lang="en">
<?php include 'headtag.php' ?>
<body>

<div class="container">
	<hr/>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-5">
			<h4><center><b>Get Top News Articles by<br/>Category / Keyword</b></center></h4>
			<form action="index.php" method="post">
				<div class="form-group">
					<input type="text" name="keyword" value="" placeholder="Search Keyword" class="form-control" >
				</div>
				<div class="form-group">
				<b>Category:</b>
					<select name="category" class="form-control" >
					<option value="">---</option>
					<?php
						$cat = array("Business","Entertainment","General","Health","Science","Technology");
						for($i=0;$i<count($cat);$i++)
						{
							echo "<option value='$cat[$i]'>$cat[$i]</option>";
						}
					?>
					</select>
				</div>
				<div class="form-group">
				<b>No. of Articles you need:</b>
					<select name="count" class="form-control" >
					<?php
						for($i=20;$i>0;$i--)
						{
							if($i==10)
								echo "<option selected value='$i'>$i</option>";
							else
								echo "<option value='$i'>$i</option>";
						}
					?>
					</select>
				</div>
				<div class="form-group">
				<b>From Date</b>
					<input type="date" name="fromdate" min="2022-11-13" max="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" class="form-control" >
				</div>
				<div class="form-group">
				<b>To Date</b>
					<input type="date" name="todate" min="2022-11-13" max="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" class="form-control" >
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Search" class="btn btn-primary" >
				</div>
			</form>
		</div>
		<div class="col-sm-4"></div>
	</div>
</div>
<hr/>
<?php
if (!empty($_POST)) {
	$keyword=$_POST["keyword"];
	$category=$_POST["category"];
	$count=$_POST["count"];
	$fromdate=$_POST["fromdate"];
	$todate=$_POST["todate"];
?>
<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<table class="table table-hover table-bordered" >
				<tr>
					<th>Category</th><td><?php echo $category; ?></td>
					<th>From Date</th><td><?php echo $fromdate; ?></td>
				</tr>
				<tr>
					<th>Keyword</th><td><?php echo $keyword; ?></td>
					<th>To Date</th><td><?php echo $todate; ?></td>
				</tr>
			</table>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
<?php
		
	if(!strcmp($keyword,"")){
		$keyword="None";
	}
	if(!strcmp($category,"")){
		$category="None";
	}
		
	$query = "NewsArticles.py $keyword $category $count $fromdate $todate";
	$command = escapeshellcmd($query);
	$output = shell_exec($command);
?>
<hr/>
<center><div id="google_translate_element"></div></center>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<?php
				echo "$output";
			?>
		</div>
	</div>
</div>
<hr/>
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
