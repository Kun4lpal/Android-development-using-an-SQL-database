<?php

//function to get database
function getDB(){
  $dbhost = "localhost";
  $dbuser="root";
  $dbpass = "";
  $dbname = "androidmoviesdb";
  $conn = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
  
  if($conn->connect_error){
  die("Connection Failed!".$conn->connect_error."\n");
  }
  
  return $conn;
}


function getMovies(){
$conn = getDB();
$sql = "SELECT * FROM Movies ORDER BY name ASC";

if(!$result = $conn->query($sql)){
die('There was an error running the query ['.$conn->error.']/n');
}

$res_arr = array();

while ($row =  $result->fetch_assoc()){
        $row_array['id'] = $row['id'];
        $row_array['name'] = $row['name'];
        $row_array['description'] = $row['description'];
        $row_array['rating'] = $row['rating'];
        $row_array['url'] = $row['url'];

        array_push($res_arr,$row_array);
}

echo json_encode($res_arr); // json encoding
$conn->close();
}


function del($mid){
	//echo "Hello Movies!";
$conn = getDB();
$stmt = $conn->prepare("DELETE  FROM Movies
                         WHERE id = ?");
$stmt->bind_param("s", $mid);
if ($stmt->execute()) {
echo "Movie deleted."; 
}else{
echo "Movie not found";
}
$conn->close();
}

function addInstance($id, $name, $desc, $rating){
	// //echo "Hello Movies!";
 $conn = getDB();
$stmt = $conn->prepare("INSERT INTO Movies(id,name,description,rating)
                           VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $id,$name,$desc,$rating);
if ($stmt->execute()) {
echo "Movie Added.";
}else{
echo "Movie not Added.";
}
$conn->close();

}

function addMovie($data)
{
    $conn = getDB();//get DB connection.
    //create prepare statement
    if (!$result = $conn->prepare("INSERT INTO Movies VALUES (?,?,?,?,?,?,?,?,?,?,?)")) {
        die("Connection failed" . $conn->connect_error);
    }
    //bind param
    $result->bind_param("sssssssssss", $data['primaryID'], $data['id'], $data['name'], $data['description'], $data['stars'], $data['length'], $data['image'], $data['year'], $data['rating'], $data['director'], $data['url']);
    //execute query
    if ($result->execute()) {
        $return_arr = "Movie added.";
    } else {
        $return_arr = "Movie could not be added.";
    }
    echo json_encode($return_arr);
    
    $conn->close();
}


function aboveRating($rating){
 $conn=getDB();
 //echo "Hello Movies!";
 	if($statement = $conn->prepare("SELECT * FROM Movies 
 									WHERE rating >= ?
 									ORDER BY rating DESC")){
 			$statement->bind_param("s",$rating);
 			$statement->execute();
 			$res= $statement->get_result();
 			$res_arr = array();

	while ($row =  $res->fetch_assoc()){
        		array_push($res_arr,$row);
		}
		$statement->close();
	}
echo json_encode($res_arr);
$conn->close();
}


function getMovieById($mid) {
	//echo "Hello Movies!";
$conn = getDB();
$stmt = $conn->prepare("SELECT * FROM Movies 
						WHERE id = ?"); 
$stmt->bind_param("s", $mid); 
if ($stmt->execute()) {
$res= $stmt->get_result();
 			$res_arr = array();

	while ($row =  $res->fetch_assoc()){
        		array_push($res_arr,$row);
		}
		$stmt->close();
	}
echo json_encode($res_arr);
$conn->close();
}



?>
