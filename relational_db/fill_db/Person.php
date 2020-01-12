
<?php 
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "BankDataManagement"; 
  
// Create connection 
$conn = mysqli_connect( $servername, $username, $password, $dbname ); 
  
// Check connection 
if ( !$conn ) { 
    die("Connection failed: " . mysqli_connect_error()); 
} 

//From 1 to 10
$sql="INSERT INTO `Person` VALUES (NULL,'Sienna','Walsh','3f6d0960ce3c22312a9a1bccfd1efbe126f14af7','1','Nauru','4393595.99','1975-07-28','sally64@example.com','female','336-274-4443x82732','','549601',now()),
(NULL,'Eldred','Blanda','952fe56ffe4a43a58547af520a97b4456c4adf64','2','Tajikistan','75350298.03','2006-10-03','shanon58@example.com','male','(933)374-9421x108','228','37988',now()),
(NULL,'Dwight','Vandervort','28954de4188f6ea55681f018d2217ddff88dff6e','3','Ghana','99999999.99','2011-06-19','quincy19@example.net','male','09748131891','423696','637551',now()),
(NULL,'Cecil','Kertzmann','c5fd93fd328c6e8411ba63d6b90e6dae6de4a5ba','4','Algeria','0.00','1999-03-02','xking@example.net','male','335.564.8793','830544843','817202',now()),
(NULL,'Lucio','Flatley','2cbb6e2d2d2ca777ecc7937bfc376b0ff56561ef','5','San Marino','3405573.76','2005-02-26','schiller.sam@example.org','female','1-068-640-9145x606','1773819','810624',now()),
(NULL,'Lorenzo','Schaefer','012c1c2327a4efbfb87132cb4bf2537f572eb017','6','Iceland','856995.69','1974-08-30','vandervort.deanna@example.org','male','676-378-8791x339','796','738891',now()),
(NULL,'Michele','Berge','624fff4e6eefc7a01f779cf6984721eaf730f6d9','7','Saint Pierre and Miquelon','323054.72','2002-08-08','vmoore@example.net','female','769-669-4786','5','263624',now()),
(NULL,'Clarissa','Doyle','85818bd122db38d876eddbce3dae53b7e78a78dd','8','Guinea-Bissau','9498.65','1978-10-17','frami.graham@example.com','female','1-263-239-0737','3659715','955523',now()),
(NULL,'Modesta','Carroll','156ff02a70dd770459df0aa74673dc606c1f42f4','9','Costa Rica','3633090.24','1988-12-04','russel.wyman@example.com','female','+35(0)1668862834','232044882','47401',now()),
(NULL,'Rogelio','Jones','be4536354787b3b9c23005d68dc71cfe323a6bc3','10','Ghana','172.00','2013-04-16','bernita08@example.net','female','453-164-1865x980','547299','737798',now())";

if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>