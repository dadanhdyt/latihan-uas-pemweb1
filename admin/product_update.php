<?php session_start();

if (!isset($_SESSION['is_login']))
{
    header('location:./login.php');
    die();
}
require __DIR__ . "/../functions/functions.php";


if (isset($_GET['id'])) {
    $id = strip_tags($_GET['id']);
} else {
    header('location:../product.php');
}
$data = db()->query("SELECT * FROM product WHERE id='$id' LIMIT 1")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="admin_page">
        <?php require __DIR__ . '/_admin_navbar.php' ?>
        <main class="main_page">
            <h1 style="margin:20px 0px;">Edit Product</h1>
            <form method="POST" enctype="multipart/form-data" action="logic/product_update.php?id=<?= $id ?>" class="form_new_product">
                <div class="fields">
                    <div class="field">
                        <label for="product_name">Product Name</label>
                        <input type="text" value="<?= $data['product_name'] ?>" name='product_name' required autocomplete placeholder="Ketikan Nama Produk Anda">
                    </div>
                    <div class="field">
                        <label for="price">Price</label>
                        <input type="number" value="<?= $data['price'] ?>" name='price' required autocomplete placeholder="Ketikan harga Produk Anda">
                    </div>
                    <div class="field">
                        <label for="stok">stok</label>
                        <input type="number" name='Stok' value="<?= $data['stok'] ?>" required autocomplete placeholder="Ketikan Stok Produk Anda">
                    </div>
                    <div class="field">
                        <label for="category">stok</label>
                        <select name="category" id="">
                            <option disabled selected>--Pilih Kategori--</option>
                            <?php foreach (getCategory() as $value) {
                                if ($data['category'] === $value) {
                            ?>
                                    <option selected value="<?= $value ?>"><?= $value ?></option>

                                <?php
                                } else {
                                ?>
                                    <option value="<?= $value ?>"><?= $value ?></option>
                            <?php
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="field">
                        <label for="image">Image</label>
                        <input class="input_file" type="file" name="image" id="image">
                    </div>
                    <div class="field">
                        <button name="save" class="btn_save" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>

</html>