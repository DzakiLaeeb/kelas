<?php 
if (!isset($_SESSION ["email"])) {
    header("location:index.php?menu=login");
}

if (isset($_GET["hapus"])) {
    $id = $_GET ["hapus"];
    unset ($_SESSION["cart"][$id]);
}


$cart = count($_SESSION["cart"]);

if (isset($_GET["add"])) {
    $id=$_GET["add"];
    $sql = "SELECT * FROM product WHERE id=$id";
    echo $sql;
    $hasil = mysql_query($koneksi,$sql);
    $row = mysqli_fetch_assoc($hasil);
    echo $row["id"];
    echo $row["product"];
    echo $row["harga"];
    $_SESSION["cart"]=[
        "id"      => $row ["id"],
        "product" => ["product"],
        "harga"   => $row ["harga"],
        "jumlah"  => isset ($_SESSION["cart"][$row["id"]])?$_SESSION["cart"][$row["id"]]["jumlah"] +1 : 1
    ];
}
?>
<div class="cart">
    <h1>cart</h1>
    <table border="1px"
        <thead>
            <tr>
                <th>no.</th>
                <th>product</th>
                <th>harga</th>
                <th>jumlah</th>
                <th>total</th>
                <th>hapus</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach ($_SESSION["cart"] as $key ){
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $key ["product"] ?></td>
                    <td><?= $key ["harga"] ?></td>
                    <td><?= $key ["jumlah"] ?></td>
                    <td><?= $key ["jumlah"] * $key ["harga"]?></td>
                    <td><a href="?menu=cart&hapus=<?= $key["id"] ?>">hapus</a></td>
                </tr>
                <?php 
            }
            ?>
        </tbody>
    </table>
</div>
