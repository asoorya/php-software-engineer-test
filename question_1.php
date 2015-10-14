<?php
namespace SoftwareEngineerTest;
use PDO;

// Question 1a

$DB_HOST = 'localhost';
$DB_NAME = 'test';
$DB_USER = 'test';
$DB_PASS = 'test';

// write your sql to get customer_data here
try {
  $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    $errorMessage = $ex->getMessage();
}
if(isset($_GET))$occupation_name = $_GET['occupation_name'];

    // set the PDO error mode to exception
	if($occupation_name == ""){
		$sql = "SELECT c.`customer_id`, c.`first_name`, c.`last_name`, ci.`occupation_name`"
        . "FROM `customer` as c LEFT JOIN `customer_occupation` as ci "
        . "ON c.`customer_occupation_id` = ci.`customer_occupation_id`";
		
		$params = array();
	}else{
		$sql = "SELECT c.`customer_id`, c.`first_name`, c.`last_name`, ci.`occupation_name`"
        . "FROM `customer` as c LEFT JOIN `customer_occupation` as ci "
        . "ON c.`customer_occupation_id` = ci.`customer_occupation_id`"
		. "WHERE ci.occupation_name LIKE '%".$occupation_name."%'";
		
		$params = array(":occupation_name" => $occupation_name);
	}

$PDOStatement = $conn->prepare( $sql );
$PDOStatement->execute();
$records = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);

?>

<h2>Customer List</h2>

<table>
	<tr>
		<th>Customer ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Occupation</th>
	</tr>

	<!-- Write your code here -->
	<?php
	if(!empty($records)){
		foreach($records as $data) { ?>
			<tr>
			<?php if($data['occupation_name'] == "") $data['occupation_name'] = "un-employed"; ?>
			<?php foreach($data as $field=>$value) { ?>
			<td class="white"><?php echo $value; ?></td>
			<?php } ?>
			</tr>
	<?php } 
	}
	?>
		</tr>
</table>

