<?php
include 'log_config.php';
if(isset($_POST['action']) && !empty($_POST['action'])) { //control module, html file sends requests with certain string and this will determine which function to call
    $action = $_POST['action'];
    switch($action) {
		case 'init': init(); break; //fetch user info and fill in profile
		case 'cards' : generateCards();break; //generate content
		case 'fetchvid' : fetchVideo();break;
		case 'eProfile' : changeBio();break; //update new self bio
		case 'viewP' : viewProfile();break;
		case 'upload' : uploadContent();break;
		case 'delete' : deleteContent();break;
		case 'cardsSearch' : cardSearch();break;
    }
}
function init(){
	$username = $_POST['name'];
	$user_info = array();
	$conn = new mysqli('athena.ecs.csus.edu','bridge_user','bridge_db','bridge'); // Opens Database
	if ($conn->connect_error) { // Connection Check
     die("Connection to database failed: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM site_members,creators,students WHERE site_members.username = $username;"; // Prepare Query
	$result = $conn->query($sql); // Sends Query

	if ($result->num_rows > 0) { //Checks if Query table is empty
		while($row = $result->fetch_assoc()) { // Fetches the first row
			array_push($user_info, $row); // Push the first row into the array
		}
	}
	$result = json_encode($user_info);
	echo $result; // Returns the array

	$conn->close(); // Close Connection
}
function fetchVideo(){
	$video = array();
	$title = $_POST['title'];
	$conn = new mysqli('athena.ecs.csus.edu','bridge_user','bridge_db','bridge'); // Opens Database
	if ($conn->connect_error) { // Connection Check
     die("Connection to database failed: " . $conn->connect_error);
	}
	$sql = "SELECT content FROM content WHERE description = $title;"; // Prepare Query
	$result = $conn->query($sql); // Sends Query

	if ($result->num_rows > 0) { //Checks if Query table is empty
		while($row = $result->fetch_assoc()) { // Fetches the first row
			array_push($user_info, $row); // Push the first row into the array
		}
	}
	$vid = substr($video['content'],-11);
	$result = json_encode($vid);
	echo $result; // Returns the array

	$conn->close(); // Close Connection
}
function viewProfile(){
	$user_info = array();
	$username = $_POST['uName'];
	$conn = new mysqli('athena.ecs.csus.edu','bridge_user','bridge_db','bridge'); // Opens Database
	if ($conn->connect_error) { // Connection Check
     die("Connection to database failed: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM site_members,creators,students WHERE username = $username"; // Prepare Query
	$result = $conn->query($sql); // Sends Query

	if ($result->num_rows > 0) { //Checks if Query table is empty
		while($row = $result->fetch_assoc()) { // Fetches the first row
			array_push($user_info, $row); // Push the first row into the array
		}
	}
	$result = json_encode($user_info);
	echo $result; // Returns the array

	$conn->close(); // Close Connection
}

function generateCards(){ //function to generate video cards, may possibly split fetching database data to different function
    $content = array();
	$myuser = $_POST['me'];
	$myusername = $myuser['username'];
	$myusertype = $myuser['acc_type'];
	$conn = new mysqli('athena.ecs.csus.edu','bridge_user','bridge_db','bridge'); // Opens Database
	if ($conn->connect_error) { // Connection Check
     die("Connection to database failed: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM content;"; // Grab all content from database, will refine later
	$result = $conn->query($sql); // receive list of content

	if ($result->num_rows > 0) { //while list is not empty
		while($row = $result->fetch_assoc()) { // fetch row
			array_push($content, $row); // push row into array
		}
	}
	$conn->close(); // Close Connection
	foreach($content as $row){ //card generation, will post content based on fetched database info
		if($row['kind'] == 'Video'){
		$vid = substr($row['content'],-11);
		$title = $row['description'];
		$author = $row['username'];
		$date = $row['date_posted'];
		$views = $row['views'];
		$likes = $row['likes'];
		echo "<div class=\"card mx-auto\" style=\"width: 20rem;\">
			<img class=\"card-img-top del\" src=\"images/x.png\">
            <img class=\"card-img-top play\" src=\"images/play.png\" alt=\"Thumbnail\" data-toggle =\"modal\" data-target = \"#Player\">
            <div class=\"card-block\">
              <h3 class=\"card-title\">$title</h3>
              <div class=\"card-footer text-muted\">
              <button type = \"button\" class = \" btn viewp\">By: $author</button>
              <p>Uploaded </p>
              <p>$views Views</p>
              <p>$likes Likes</p>
              </div>
              </div>
              </div>";
	           }
	if($row['kind'] == 'Post'){
	$content = $row['description'];
	$author = $row['username'];
	$date = $row['date_posted'];
    echo "<div class=\"card mx-auto\" style=\"width: 20rem;\">
            <div class=\"card-block\">
              <div class=\"card-footer text-muted\">
			  <img class=\"card-img-top del\" src=\"images/x.png\">
			  <p>$content</p>
              <p class = \"viewp\">By: $author</p>
              <p>$likes Likes</p>
              </div>
              </div>
              </div>";
	           }
   if($row[1] == 'Announcement'){
	$content = $row['description'];
	$author = $row['username'];
	$date = $row['date_posted'];
     echo "<div class=\"card mx-auto\" style=\"width: 20rem;\">
             <div class=\"card-block\">
			 <img class=\"card-img-top del\" src=\"images/x.png\">
               <h3 class=\"card-title\">$row[1]</h3>
               <div class=\"card-footer text-muted\">
               <p class = \"viewp\">By: $author</p>
               <p>Uploaded $row[7]</p>
               <p>$row[8] Views</p>
               <p>$row[9] Likes</p>
               </div>
               </div>
               </div>";
 	           
	}
  }

}
function cardSearch() {
	$content = array();
	
	$method = $_POST['mode']; //Can be content, username, or field.
	//Describes which column to search for content
	if ($method == "content") { //This is to properly state which colum we're checking
		$column = "description";
	} else if ($method == "username") {
		$column = "username";
	} else if ($method == "field") {
		$column = "field";
	} else {
		$column = "description";
	}
	
	$terms = "%".$_POST['terms']."%"; //Fetch our search terms
	//The % is for the LIKE sql term. It'll find our search term anywhere in the column we specify
	
	$conn = new mysqli('athena.ecs.csus.edu','bridge_user','bridge_db','bridge'); // Opens Database
	if ($conn->connect_error) { // Connection Check
     die("Connection to database failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM content WHERE ".$column." LIKE '".$terms."';";

	$result = $conn->query($sql); // receive list of content
	if($result->num_rows == 0) {
		echo "No results found";
		return;
	}
	if ($result->num_rows > 0) { //while list is not empty
		while($row = $result->fetch_assoc()) { // fetch row
			array_push($content, $row); // push row into array
		}
	}
	$conn->close(); // Close Connection
	//everything from here on works just like generateCards.
	//Until we patch up different content types, we'll only see video cards.
  foreach($content as $row){
	if($row['kind'] == 'Video'){
	$vid = substr($row['content'],-11);
	$title = $row['description'];
	$author = $row['username'];
	$date = $row['date_posted'];
	$views = $row['views'];
	$likes = $row['likes'];
    echo "<div class=\"card mx-auto\" style=\"width: 20rem;\">
			<img class=\"card-img-top del\" src=\"images/x.png\">
            <img class=\"card-img-top play\" src=\"images/play.png\" alt=\"Thumbnail\" data-toggle =\"modal\" data-target = \"#Player\">
            <div class=\"card-block\">
              <h3 class=\"card-title\">$title</h3>
              <div class=\"card-footer text-muted\">
              <p class = \"viewp\">By: $author</p>
              <p>Uploaded </p>
              <p>$views Views</p>
              <p>$likes Likes</p>
              </div>
              </div>
              </div>";
	           }
		}
	}
function changeBio(){ //changes user's bio and returns it back to the page to change on the fly
	$newBio = $_POST['newBio'];
	$username = $_POST['name'];
	$conn = new mysqli('athena.ecs.csus.edu','bridge_user','bridge_db','bridge'); // Opens Database
	if ($conn->connect_error) { // Connection Check
     die("Connection to database failed: " . $conn->connect_error);
	}
	$sql = "UPDATE site_members SET bio = $newBio WHERE username = $username;"; // Query to update bio with new bio
	$result = $conn->query($sql); // returns success msg, no need to use further
	$conn->close(); // Close Connection
}
function uploadContent(){ //uploads content to database
	$date = date("m d,Y");
	$time = date("h:i a");
	$cType = $_POST['type'];
	$cWho = $_POST['who'];
	$cField = $_POST['field'];
	$cDesc = $_POST['desc'];
	if($_POST['type'] == eternship) $et = 1;
	else $et = 0;
	$conn = new mysqli('athena.ecs.csus.edu','bridge_user','bridge_db','bridge'); // Opens Database
	if ($conn->connect_error) { // Connection Check
     die("Connection to database failed: " . $conn->connect_error);
	}
    if($_POST['type'] == video){
     $vID = substr($_POST['URL'],31,11); //store youtube's video ID into database, every URL is the same other than ID
	 $sql = "INSERT INTO content (kind,username,field,content,description,time_posted,date_posted,views,likes,eternship) VALUES ($cType,$cWho,$vID,$cField,$cDesc,$date,$time,0,0,$et;"; // insert video info into database
    }
    if($_POST['type'] == post){
	 $sql = "INSERT INTO content (kind,username,field,content,description,time_posted,date_posted,views,likes,eternship) VALUES ($cType,$cWho,\"post\",$cField,$cDesc,$date,$time,0,0,$et;"; // insert post info into database
    }
	$result = $conn->query($sql);

	$conn ->close();
}

function deleteContent(){
	$deltitle = $_POST['title']; //find content to delete by info in content
	$conn = new mysqli('athena.ecs.csus.edu','bridge_user','bridge_db','bridge'); // Opens Database
	if ($conn->connect_error) { // Connection Check
     die("Connection to database failed: " . $conn->connect_error);
	}
	$sql = "DELETE FROM content WHERE content = $deltitle;"; // Query to update bio with new bio
	$result = $conn->query($sql); // returns success msg, no need to use further
	$conn->close(); // Close Connection
}
?>
