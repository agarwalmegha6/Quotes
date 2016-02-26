<html>
<head>
  <link rel="stylesheet" href="styles.css">
  </head>
<body>
<?php
//Providing server, user and password.
$servername = "localhost";
$username = "root";
$password = "";

// Create connection.
$conn = new mysqli($servername, $username, $password);

// Check connection.
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select database.
if(!($conn->select_db("quotes"))) {
    echo "Selecting Database failed.";
}

//Checks the source for the POST and adds or updates the database accordingly.
if (isset($_POST["add_quote"])) {
$quote = $_POST["quote_added"];
$author = $_POST["author_added"];
$sql = "INSERT INTO quote (added, quote, author, rating, flagged)
    values(now(), '$quote', '$author', 0, 'f')";
    if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

else if (isset($_POST["flagged"])) {
	$get_id = $_POST["id"];
	$sql = "UPDATE quote SET flagged = 'n' WHERE id = $get_id";
	$conn->query($sql);
}

else if (isset($_POST["upvote"])) {
	$get_upvote = $_POST["id"];
	$sql = "UPDATE quote SET rating = rating + 1  WHERE id=$get_upvote";
	$conn->query($sql);
}

else if (isset($_POST["downvote"])) {
	$get_downvote = $_POST["id"];
	$sql = "UPDATE quote SET rating = rating - 1  WHERE id= $get_downvote";
	$conn->query($sql);
}
?>
<h1>Quotes</h1>
<a href="quotes.php?mode=new" style = "float:right">New</a>
<br>
<?php

// Stores the records from the table in associative arrays.
$sql = "SELECT id, quote, author, rating, flagged FROM quote ORDER BY rating DESC";
$result = $conn->query($sql);
$array=array();

$index = 0;
// Prints the records one by one along with a form to generate inputs for flag and vote.
while ($row = mysqli_fetch_assoc($result)) 
{
    $array[$index] = $row;?>
    <?php if(strcmp($array[$index]['flagged'],'n') !== 0) { ?>
    <div id = "show_div">
    <div id = "show_left">
        <div id = "show_quote"><?php echo '"'.$array[$index]['quote'].'"'; ?></div>
        <div id = "show_author"><?php echo '-'.' '.$array[$index]['author']; ?></div>
    </div>
    <div id = "show_right">
    <div id = "show_rating"><?php echo $array[$index]['rating']; ?></div> 
    <form action = "showQuotes.php" method = "post">
    <input type="hidden" name="id" value="<?= $array[$index]['id']?>">
    <div id = "show_flag" ><input type="submit" name="flagged" value="Flag"></div>
    <div id = "show_vote" ><input type="submit" name="upvote" value="+">
    <input type="submit" name="downvote" value="-"></div>
</form>
    </div>
	</div>
    <br>
    <?php } ?>
    <?php
    $index++;
}
// Closes connection.
$conn->close();
?>
</body>
</html>