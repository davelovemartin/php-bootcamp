<?php
# save to the database credentials
$db = new mysqli('localhost', 'dave', 'BFg?~%;Fs.r-', 'myDatabase');
# check our connection to the database and return error if broken
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
# select all rows from the table myTable
$sql2 = <<<SQL
  SELECT *
  FROM `newTable`
SQL;

$data = array();

# check our query will actually run
if(!$result2 = $db->query($sql2)){
    die('There was an error running the second query [' . $db->error . ']');
}
while($row2 = $result2->fetch_assoc()){
  $data[] = $row2;
}
echo json_encode($data);
$result2->free();
