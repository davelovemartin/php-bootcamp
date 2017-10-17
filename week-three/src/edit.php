<!DOCTYPE HTML>
<?php
	$myName = "Dave";
	$myJobTitle = "UWE Alumni and Indie Web Developer";
	$date = Date(Y);

	# save to the database credentials
	$db = new mysqli('localhost', 'my_username', 'changeme', 'my_database');
#
	# check our connection to the database and return error if broken
	if($db->connect_errno > 0){
	    die('Unable to connect to database [' . $db->connect_error . ']');
	}
#
	# select all rows from the table myTable
	$sql = <<<SQL
    SELECT *
    FROM `my_table`
SQL;

	# check our query will actually run
	if(!$result = $db->query($sql)){
	    die('There was an error running the query [' . $db->error . ']');
	}

?>
<html>
	<head>
		<title><?php echo $myName . "'s website"; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body id="top">

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="/index.php" class="image avatar"><img src="images/avatar.jpg" alt="" /></a>
					<h1><strong>I am <?php echo $myName; ?>:</strong> <?php echo $myJobTitle; ?>.</h1>
				</div>
			</header>

		<!-- Main -->
			<div id="main">

				<!-- One -->
					<section id="one">
						<section>
							<h1>Edit</h1>
							<div class="table-wrapper">
								<form name="form1" method="post" action="">
									<table>
										<thead>
											<tr>
												<th>&nbsp;</th>
												<th>Title</th>
												<th>Description</th>
												<th>Filename</th>
											</tr>
										</thead>
										<tbody>
<?php
	while($row = $result->fetch_assoc()){

echo '<tr>
<td><input type="hidden" name="id[]" value=' . $row['id'] . ' readonly></td>
<td><input name="title[]" type="text" id="title" value="' . $row['title'] . '"></td>
<td><input name="description[]" type="text" id="description" value="' . $row['description'] . '"></td>
<td><input name="filename[]" type="text" id="filename" value="' . $row['filename'] . '"></td>
</tr>';
}
# free up system resources
$result->free();
?>
										</tbody>
									</table>
									<input type="submit" name="submit" class="button big" value="Save">
								</form>
							</div>

					</section>
<?php

// if form has been submitted, process it
if($_POST["submit"]){
   // get data from form
	 $row = $_POST['id'];
	 $title = $_POST['title'];
	 $description = $_POST['description'];
	 $filename = $_POST['filename'];

	 // loop through all array items
   foreach($_POST['id'] as $value){
       // minus value by 1 since arrays start at 0
               //update table
			$update_sql = "UPDATE `my_table` SET `title`='$title[$value]', `description`='$description[$value]', `filename`='$filename[$value]' WHERE id='$value'";

			if(!$result = $db->query($update_sql)){
			    die('There was an error running the query [' . $db->error . ']');
			}

   }
	 // redirect user

	 header("Location:index.php");
}
// print_r($_POST);
?>

			</div>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; <?php echo $date; ?></li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
<?php
	# close the connection to your database
	$db->close();
?>
