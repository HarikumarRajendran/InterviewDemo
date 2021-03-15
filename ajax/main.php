<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interview";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_REQUEST['fetchData']) && $_REQUEST['fetchData']!=""){

  $url = $_POST["url"];

  $str = file_get_contents($url);

  $json = json_decode($str, true);

  $sql = "SELECT created_at FROM demo";

  $data = array();

  $count = 1;

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    	while($row = mysqli_fetch_assoc($result)) {

    		array_push($data, $row["created_at"]);
    	}

    	foreach ($json['Time Series (1min)'] as $key => $value) {
    		
    		if(!in_array($key, $data)){
    			
    			$open = $value['1. open'];
  		  	$high = $value['2. high'];
  		  	$low = $value['3. low'];
  		  	$close = $value['4. close'];
  		  	$volume = $value['5. volume'];
  		  	$created_at = $key;
  				
    			$sql = "INSERT INTO demo (open, high, low, close, volume, status,created_at) VALUES ('$open','$high','$low','$close','$volume','1','$created_at')";

    			if (mysqli_query($conn, $sql)) {
    		    
    		        echo "1";
    		    
    		  } else {
    		    
    		        echo "0";
    		    
    		  }    
     		} else {
           echo "0";
        } 
    	}
  } else {
    	
    	foreach ($json['Time Series (1min)'] as $key => $value) {

    		$open = $value['1. open'];
    		$high = $value['2. high'];
    		$low = $value['3. low'];
    		$close = $value['4. close'];
    		$volume = $value['5. volume'];
    		$created_at = $key;
  		
  		$sql = "INSERT INTO demo (open, high, low, close, volume, status,created_at) VALUES ('$open','$high','$low','$close','$volume','1','$created_at')";

  		if (mysqli_query($conn, $sql)) {
          
              echo "1";
          
          } else {
          
              echo "0";
          
          }    
  	}
  }
}

if(isset($_REQUEST['viewData']) && $_REQUEST['viewData']!=""){
  
  $sql = "SELECT * FROM demo";

  $data = array();

  $result = mysqli_query($conn, $sql);

   if (mysqli_num_rows($result) > 0) {

      while($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
      }

      if(count($data) > 0){
        $jsonData = json_encode($data);
        echo $jsonData;
      }
    }
}

if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){

  $id = $_POST['id'];

  $status = '1';

  $sql = "SELECT * FROM demo WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

      while($row = mysqli_fetch_assoc($result)) {
        
        if($row['status'] == '1'){
          $status = '0';
        } 
      }
  }

  $sql2 = "UPDATE demo SET status = $status WHERE id = $id";

  if (mysqli_query($conn, $sql2)) {
  
    $sql3 = "SELECT * FROM demo WHERE id = $id";

    $result = mysqli_query($conn, $sql3);

    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {
          
          $jsonData = json_encode($row);
          echo $jsonData;
        }
    }
  
  }

}

mysqli_close($conn);

?>