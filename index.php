<?php
error_reporting(0); /*hide the error message*/

// initialize errors variable
$errors = "";
// connect to database
$con = mysqli_connect("localhost:3306","root","weiasdfshiuan32","todolist");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

// insert a quote if submit button is clicked
/*
if (isset($_POST['add'])) {
  if (empty($_POST['task'])) {
    $errors = "You must fill in the task";
  }else{
    $task = $_POST['task'];
    $sql = "INSERT INTO task ('task_name`') VALUES ('$task')";
    mysqli_query($db, $sql);
    header('location: index.php');
  }
}
*/
/*

$("#add").click(function() {

  if (!empty($_POST['task'])) {
    $task = $_POST['task'];
    $sql = "INSERT INTO task ('task_name') VALUES ('$task')";
    //mysqli_query($db, $sql);
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
})*/


$weather = "";
$error = "";
$weatherBG = "";

if (array_key_exists('city', $_GET)) {
    
    $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&APPID=b83839246a5205d4dc96cc0723f50ae5");
    
    $weatherArray = json_decode($urlContents, true);
    
    if ($weatherArray['cod'] == 200) {
        
        $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'. ";
    
        $tempInCelcius = intval($weatherArray['main']['temp'] - 273);

        $weather .= "<br>The temperature is ".$tempInCelcius."&deg;C <br>and the wind speed is ".$weatherArray['wind']['speed']." m/s.";
        
    } else {
        
        $error = "Could not find the city - please try again.";
      
    }

    
    
}

/*
if (strpos($weatherArray['weather'][0]['description'], "thunderstorm") == true) {
  $weatherBG = "img/weather/thunder.jpg";
} elseif(strpos($weatherArray['weather'][0]['description'], "rain") != true && strpos($weatherArray['weather'][0]['description'], "rain") == true){
  $weatherBG = "img/weather/rain.jpg";
}elseif(strpos($weatherArray['weather'][0]['description'], "snow") != true){
  $weatherBG = "img/weather/snow.jpg";
}else{
  $weatherBG = "img/weather/cloud.jpg";
}

*/

?>

<!DOCTYPE html>
<html>
<head>
  <link id="css-style" rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="shortcut icon" type="image/png" href="img/icon/laptop.png">

	<title>Working Panel</title>


	

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
  

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="jquery-3.4.1.min.js"></script> 
        
  

</head>
<body>
    <div id="mySidebar" class="sidebar" onmouseover="openSidebar()" onmouseout="closeSidebar()">
        


        <a id="weather-link" href="#home" onmouseover="weatherS()" ><img class="sidebar-icon" src="img/icon/one.png">Home</a>
        <a id="codeplayer-link" href="#services" onmouseover="playerS()"><img class="sidebar-icon" src="img/icon/two.png">Services</a>
        <a href="#clients" onmouseover="reactionS()"><img class="sidebar-icon" src="img/icon/three.png">Clients</a>
        <a href="#contact" onmouseover="todolistS()"><img class="sidebar-icon" src="img/icon/four.png">Contact</a>
    </div>


    <!--weather-->
    <div class="container" id="weather-section">
      
        <h1>What's The Weather?</h1>
        
        
        
        <form>
            <div class="form-group">
              <label for="city">Enter the name of a city.</label>
              <input type="text" class="form-control" name="city" id="city" aria-describedby="emailHelp" placeholder="Eg. London, Tokyo" value = "<?php if (array_key_exists('city', $_GET)) {echo $_GET['city'];} ?>">
              
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
        <div id="weather"><?php
            
            if ($weather) {
                
              echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                
            } else if ($error != "") {
              
              echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
              
            }
              
            
            
            
            
            ?></div>

    
    
    </div>
    <!--weather end-->

    <!--code player-->
    <div class="container" id="codeplayer-section" style="display:none;">
    
    
      
          
          <div id="logo">
          
              CodePlayer
          
          </div>
          
          <div id="buttonContainer">
          
              <div class="toggleButton active" id="html">HTML</div>
              
              <div class="toggleButton" id="css">CSS</div>
              
              <div class="toggleButton" id="javascript">JavaScript</div>
              
              <div class="toggleButton active" id="output">Output</div>
          
          </div>
      
      
      
      <div id="bodyContainer">
      
          <textarea id="htmlPanel" class="panel"><p id="paragraph">HTML area</p></textarea>
          
          <textarea id="cssPanel" class="panel hidden">p { color: green; }</textarea>
          
          <textarea id="javascriptPanel" class="panel hidden">document.getElementById("paragraph").innerHTML = "Hello Vanessa!"</textarea>
          
          <iframe id="outputPanel" class="panel"></iframe>
      
      
      </div>

    </div>
    <!--codeplayer end-->
    <!--Reaction player-->
    <div class="container" id="reaction-section" style="display:none;">
    
      <h1>Test Your Reactions!</h1>
          
      <p>Click on the boxes and circles as quickly as you can!</p>
      
      <p class="bold">Your time: <span id="timeTaken"></span></p>

      <div id="shape"></div>
      
      <script type="text/javascript" src="script.js"></script>
    </div>
    <!--Reaction-->
    <div class="container" id="todolist-section" style="display:none;">
      <div id="myDIV" class="header">
        <h2>My To Do List</h2>
        <input name="task" type="text" id="myInput" placeholder="Title...">
        <span name="add" onclick="newElement()" class="addBtn">Add</span>
      </div>

      <ul id="myUL">
        <li>Hit the gym</li>
        <li class="checked">Pay bills</li>
        <li>Meet George</li>
        <li>Buy eggs</li>
        <li>Read a book</li>
        <li>Organize office</li>
      </ul>


    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="js/script.js"></script>
    
</body>
</html>