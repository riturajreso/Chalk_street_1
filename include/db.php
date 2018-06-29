 <?php
    define('PAGINATION_COUNT', '10');
    
	$servername = "sql305.epizy.com";
	$username = "epiz_22301785";
	$password = "lWW9F9FJb9Cn";
	$conn = '';
try {
    $conn = new PDO("mysql:host=$servername;dbname=epiz_22301785_chalkStreet", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully".var_dump($conn);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?> 
