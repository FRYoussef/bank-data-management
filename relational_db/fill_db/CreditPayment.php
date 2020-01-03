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
$sql="INSERT INTO `CreditPayment` VALUES (NULL,'Dolorum nihil illum amet autem beatae quia est ipsam. In exercitationem dolores nihil ipsam inventore quia ea. Asperiores modi vero in enim. Incidunt et enim reiciendis totam.','12709.3200', now()),
(NULL,'Quo voluptatem ipsum nihil aut vel assumenda ut. Laudantium ipsa est est praesentium autem. Harum voluptatem dolores iure odit quas ut illo.','8053.9468', now()),
(NULL,'Iste eius dolores praesentium hic accusamus. Nesciunt provident ipsum dolorum maiores a minus. Quod fugit voluptatem voluptas quo quia.','38.6878', now()),
(NULL,'Sunt quas beatae esse sed distinctio sint fugit. Est quidem corporis fuga ut atque. Eveniet itaque adipisci aut facere. A ipsam iusto ut.','54204.7318', now()),
(NULL,'Et praesentium debitis illum quaerat odio saepe. Quos vel voluptatibus sunt quia aut enim dolorem. Qui nihil rerum dignissimos ipsum nemo commodi ut. Voluptatem quam quod voluptas repellat labore consequuntur et.','22804.6996', now()),
(NULL,'Dolorem perspiciatis repellendus voluptas pariatur qui est ex error. Repellendus veritatis doloremque officia ex rerum aut voluptatem. Dolores non voluptas facilis reiciendis non. Incidunt provident et omnis beatae modi dolor.','0.3792', now()),
(NULL,'Consectetur commodi id recusandae sit. Quae quam quia esse dolorem provident laudantium et aut.','335757.8800', now()),
(NULL,'Doloribus quod animi soluta. Error assumenda incidunt corrupti nihil harum. Numquam cumque aut pariatur unde. Rerum delectus dolores aut porro nam.','72359.2740', now()),
(NULL,'Debitis eius aut est temporibus. Sed totam sed optio sed est. Vel sed pariatur aspernatur. Repellendus quo dolor eveniet consequatur tempora sint est. Debitis excepturi et quasi facilis.','59839.3709', now()),
(NULL,'Sit a qui facilis. Assumenda facere saepe error blanditiis quasi pariatur qui. Error vitae dignissimos unde recusandae quia.','121662.1455', now())";

if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>