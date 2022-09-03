<?php 
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){
	switch ($_POST['action']) {
		case 'insertRecord':
		insertRecord();
		break;
		case 'showProcess':
		showProcess();
		default:
		break;
	}
}

function insertRecord() {
    include 'conn.php';
    $cardid = $_POST['cardid'];
    $time = time();
    $stmt = $conn->prepare("INSERT INTO `rfid`(`cardid`, `logdate`) VALUES (:card, :dt)");
    $stmt->bindParam(":card", $cardid);
    $stmt->bindParam(":dt", $time);
	$stmt->execute();
	
	echo "success";
}

function showProcess()
{
	include 'conn.php';

	$logs = $conn->query("SELECT * FROM `nodemcu_table`");
	while($r = $logs->fetch()){
		echo "<tr>";
		echo "<td>".$r['ID']."</td>";
		echo "<td>".$r['name']."</td>";
		$dateadded = date("F j, Y, g:i a", $r["logdate"]);
		echo "<td>".$dateadded."</td>";
		echo "</tr>";
	}
}

?>
