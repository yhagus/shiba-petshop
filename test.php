<?php 

include 'database.php';

$query = "SELECT * FROM produk";
$result = mysqli_query($db, $query) or die(mysqli_error($db));
while ($data = $result->fetch_assoc()) {
	$all_data[] = $data; 
}

echo "<pre>";
print_r ($all_data);
echo "</pre>";



 ?>

<?php foreach ($all_data as $data): ?>
	
 <img src="assets/img/<?php echo $data['foto_produk'] ?>">
 
<?php endforeach ?>