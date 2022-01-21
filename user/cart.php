<?php
include '../navbar.php';

if (!isset($_SESSION['id'])) {
    redirect('/');
}

$id_user = $_SESSION['id'];
$result = $db->query("SELECT keranjang.*,produk.* FROM keranjang INNER JOIN produk ON keranjang.id_produk=produk.id_produk WHERE keranjang.id_user='$id_user'");
$products = [];
while($data = $result->fetch_assoc()){
    $products[] = $data;
}

?>
<main class="mt-4-5">
    <div class="container col-10">
        <div class="row mb-5">
            <div class="col text-end">
                <div>
                    <a href="<?php route('/');?>" class="text-decoration-none">Home</a> > Wishlist
                </div>
            </div>
        </div>
        <div class="card rounded row">
            <div class="col-sm-12 col-md-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;
                    foreach ($products as $product){
                        $total += $product['harga_produk']*$product['jumlah'];
                        ?>
                        <tr>
                            <td class="col-sm-8 col-md-6">
                                <div class="row">
                                    <div class="col-2 m-auto">
                                        <a class="thumbnail pull-left" href="#">
                                            <img height="100" class="img-fluid" src="<?php asset('img/produk/' . $product['foto_produk']);?>" alt="">
                                        </a>
                                    </div>
                                    <div class="col-10">
                                        <div class="row">
                                            <h4>
                                                <a href="<?php route('detail.php?id=' . $product['id_produk']);?>"
                                                   class="text-decoration-none">
                                                    <?= $product['nama_produk']; ?>
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </div></td>
                            <td class="col-sm-1 col-md-1" style="text-align: center">
                                <input type="number" class="form-control" id="exampleInputEmail1" value="<?= $product['jumlah']?>" readonly>
                            </td>
                            <td class="col-sm-1 col-md-1 text-center"><?= rp($product['harga_produk']); ?></td>
                            <td class="col-sm-1 col-md-1 text-center"><strong><?= rp($product['harga_produk']*$product['jumlah']); ?></strong></td>
                            <td class="col-sm-1 col-md-2 text-center">
                                <form action="<?php action('user/cart/delete.php?id_cart=' . $product['id_keranjang']);?>" method="post">
                                    <button class="btn btn-danger rounded-pill" name="removeItem">
                                        Remove
                                    </button>
                                </form>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        
                        <td colspan="4" class="text-end" ><h5>Total</h5></td>
                        <td class="text-center"><h4><strong><?= rp($total); ?></strong></h4></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="/shiba-petshop/user/checkout.php">
                                <button class="btn btn-success">
                                    Checkout
                                </button>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
    document.title = "Shopping Cart";
</script>
<?php
// include '../footer.php';
if (isset($_SESSION['swal'])){
    echo "<script>swal({title: '".$_SESSION['swal']['title']."', icon: '".$_SESSION['swal']['icon']."'})</script>";
    unset($_SESSION['swal']);
}
?>
