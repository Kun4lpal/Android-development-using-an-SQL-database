<?php
require '..\vendor\autoload.php';
require 'Movies.php';
$app = new \Slim\App;

$app->get(
'/',
function(){
	echo "<h1>HomeWork 7</h1>";
	echo "<form action=\"http://kunal.paliwal.com:81/\" method=\"post\">";
	echo "Name: <input type=\"text\" name=\"name\"><br />";
	echo "ID: <input type=\"text\" name=\"name\"><br />";
	echo "<input type=\"submit\" value =\"Submit\">";
	echo "</form>";
}
);

$app->get(
'/movies/',
function(){
	//echo "Hello Movies!";
	getMovies();
}
);

$app->get(
'/movies/id/{mid}',
function($request, $response, $args){
	//echo "Hello Movies!";
	getMovieById($args['mid']);
}
);

$app->get(
'/movies/rating/{rat}',
function($request, $response, $args){
	//echo "Hello Movies!";
        aboveRating($args['rat']);
}
);

$app->post(
'/',
function($request, $response, $args){
	$id = $request->getParsedBody();
	echo $id['name']; 
}
);


$app->get(
'/delete/id/{mid}',
function($request, $response, $args){
	del($args['mid']);
}
);


$app->get(
'/delete',
function($request, $response, $args){
	echo "<form action=\"http://kunal.paliwal.com:81/delete\" method=\"post\">";
	echo "Name: <input type=\"text\" name=\"name\"><br>";
	echo "<input type=\"submit\" value=\"submit\">";
    echo "</form>";
}
);

$app->post(
'/delete',
function($request, $response, $args){
	 //$movie = json_decode($request->getBody(),true);
     $id = $request->getParsedBody();
	 //echo "Hello Movies!";
     del($id['name']);
	 //del($movie);
}
);

$app->get(
'/add',
function(){
	    echo "<h1>Android Programming</h1><br>";
        echo "<h1>Add Movie</h1><br>";
        echo "<form action=\"http://kunal.paliwal.com:81/add\" method=\"post\">";
		echo "<pre>PrimaryID  : <input type=\"text\" name=\"primaryID\"><br><br></pre>";
		echo "<pre>Name       : <input type=\"text\" name=\"name\"><br /></pre>";
        echo "<pre>Id         : <input type=\"text\" name=\"id\"><br /></pre>";
        echo "<pre>Description: <input type=\"text\" name=\"desc\"><br /></pre>";
        echo "<pre>Rating     : <input type=\"text\" name=\"rating\"><br /></pre>";
		echo "<pre>Stars      : <input type=\"text\" name=\"stars\"><br /></pre>";
        echo "<pre>Length     : <input type=\"text\" name=\"length\"><br /></pre>";
        echo "<pre>Image      : <input type=\"text\" name=\"image\"><br /></pre>";
        echo "<pre>Year       : <input type=\"text\" name=\"year\"><br /></pre>";
        echo "<pre>Director   : <input type=\"text\" name=\"director\"><br /></pre>";
        echo "<pre>Url        : <input type=\"text\" name=\"url\"><br /></pre>";
        echo "<input type=\"submit\" value=\"submit\">";
        echo "</form>";
}
);

$app->post(
  '/add',
  function($request, $response, $args){
  $id = $request->getParsedBody();
        addInstance($id['id'],$id['name'],$id['desc'],$id['rating']);
}
);


$app->get(
'/duplicate',
function(){
	    echo "<h1>Android Programming</h1><br>";
        echo "<h1>Add JSON Movie object</h1><br>";
        echo "<form action=\"http://kunal.paliwal.com:81/duplicate\" method=\"post\">";
		echo "</form>";
}
);

//post method to add a movie in database based on the provided data.
$app->post(
'/duplicate',
function($request, $response, $args){
	$data = json_decode($request->getBody(),true);
	addMovie($data);
}
);
$app->run();
?>
