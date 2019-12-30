
<?php 
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "Bank-data-management"; 
  
// Create connection 
$conn = mysqli_connect( $servername, $username, $password, $dbname ); 
  
// Check connection 
if ( !$conn ) { 
    die("Connection failed: " . mysqli_connect_error()); 
} 
//from 1 to 20
$sql="INSERT INTO `AccountEntry` VALUES (NULL,'creditCharge','6.2855','1984-10-05','Debitis et suscipit similique excepturi incidunt debitis. Sit quaerat facilis dolores et maiores et atque. Est saepe officia porro incidunt qui.','Miss Maeve DuBuque II','916924',now()),
(NULL,'withdraw','26625042.3200','1996-07-20','Numquam mollitia est in dicta et. Dicta aut natus fuga.','Randy Welch PhD','468675',now()),
(NULL,'creditCharge','1129367.9950','1971-04-22','Ut vel aliquam tempore rem temporibus molestiae. Deserunt iste est iste. Modi libero occaecati alias aut itaque et exercitationem. Non ullam ratione et tempore earum commodi beatae sit. Atque illum velit et laboriosam.','Prof. Orval Halvorson IV','133412',now()),
(NULL,'withdraw','187364.6688','2015-06-01','Enim aut labore modi et vel et. Pariatur aut dolor quibusdam sapiente natus esse. At et illo ea laudantium placeat.','Sherwood O\'Connell V','46576',now()),
(NULL,'creditCharge','437.2300','1973-02-26','Corrupti consequatur tempore eos sed quaerat amet sint. Ullam illum provident sit aut. Ducimus sint modi in omnis mollitia accusantium. Odit ad rerum illum iusto doloremque nisi. Ea hic in sint quo sit aut consequatur.','Paul Dooley','984012',now()),
(NULL,'transferIn','3192.0000','1980-08-18','Odio tenetur in ducimus at molestiae aut sint. Eum neque quisquam est omnis maxime consequatur. Reprehenderit enim similique sit amet.','Alison Rodriguez','552413',now()),
(NULL,'withdraw','0.0000','1981-05-17','Non ducimus et dolore. Est dolor consequatur et id saepe. Quae quia ipsum voluptatem nobis dolore. Ut qui nulla magnam nesciunt unde.','Dr. Patrick Olson V','935982',now()),
(NULL,'transferIn','154590.6271','1977-09-11','Odio nobis architecto rerum debitis veniam. Saepe pariatur possimus qui unde. Hic quaerat quia doloremque. Repellendus omnis fugit reprehenderit.','Noemie West','852457',now()),
(NULL,'withdraw','1393566.2682','1972-07-22','Fuga nemo est tempora quaerat corporis dolore. Maxime aut minus quos assumenda quo.','Sarah Ullrich DVM','995563',now()),
(NULL,'transferOut','21.1391','1978-12-28','Eaque rerum vitae perferendis nostrum. Fugit corrupti quia id fugit. Sunt doloremque rerum dolor nulla.','Madison Walsh','961495',now()),
(NULL,'creditCharge','319070.4676','1984-03-05','Quaerat ea architecto qui sed tenetur sit. Nihil qui dolor aut quia. Eaque et reprehenderit et ea neque facere perspiciatis.','Dr. Hector Kulas','218545',now()),
(NULL,'withdraw','4802104.0128','1987-07-27','Quod facere molestias necessitatibus tenetur. Vero est ipsum dolor beatae nesciunt. Porro quos repudiandae deserunt et deleniti quos adipisci. Et laboriosam a et distinctio id officiis in.','Yvette Kling','703756',now()),
(NULL,'debitCharge','72820.8787','1994-07-05','Ipsum sint nulla et molestiae sequi fugiat. Consequuntur blanditiis doloremque veniam dolore. Et eius tenetur labore et.','Sanford O\'Keefe','544457',now()),
(NULL,'transferIn','6635.8588','1985-02-05','Et molestiae cumque possimus nulla. Doloribus ut autem veritatis molestiae dolores aut blanditiis. Reprehenderit tempora dolorem ipsa odit veniam beatae. Aut natus quasi et placeat sed eum dolore.','Dr. Nicklaus Klein','529519',now()),
(NULL,'transferIn','23.5327','1973-05-02','Atque molestias aut maxime nam qui ut veniam iste. Sed reprehenderit odit in at. Nihil suscipit quisquam odio nulla iste consequuntur ipsum. Nihil aut omnis dolor repudiandae consectetur inventore.','Ethyl Mills','53271',now()),
(NULL,'transferOut','221.9459','1973-04-04','Molestiae eaque sed id facere. Et reprehenderit quia et et. Perspiciatis debitis ratione corrupti. Rerum numquam corrupti sequi repellendus commodi. Dolor atque magni voluptatem molestiae asperiores.','Shaina Prohaska','860805',now()),
(NULL,'debitCharge','5750203.6982','1976-03-14','Ad a soluta reiciendis architecto eveniet. Et quibusdam fugit consectetur. Tempora voluptatem eos placeat totam voluptate consequuntur et.','Tremaine Eichmann','32292',now()),
(NULL,'withdraw','5841.1742','1989-07-30','Enim quia sunt dolorem dolores excepturi commodi sed. Aut perspiciatis animi est voluptatibus. Illo nihil dolorum nihil labore.','Melody Rolfson','305426',now()),
(NULL,'creditCharge','618780073.1690','1976-09-01','Odit cum consequatur mollitia itaque nobis iusto ut. Reiciendis mollitia quam qui recusandae corrupti corrupti hic.','Dr. Jacky Doyle','615166',now()),
(NULL,'deposit','2835445.6912','1972-08-25','Nesciunt vero exercitationem dicta quibusdam dolorem aut consequatur sint. Quam est qui nulla aperiam repellat. Accusantium qui ut est dolor temporibus nihil rerum. Impedit ratione harum veritatis optio consequatur ut. Unde sunt aspernatur rem omnis voluptas doloremque rerum.','Chadd Morar I','302886',now())";


if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>