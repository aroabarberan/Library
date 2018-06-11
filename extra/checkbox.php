<form action="" name="form" method="post">
    <?php for ($i = 0; $i < 10; $i++): ?>
        <label for="">Cantidad</label>
        <input type="text" name="amounts[]" id="amounts[]">
        <input type="checkbox" name="products[] ?>" id="products[]" value="<?=$i?>">
        <br>
    <?php endfor;?>
    <div>
        <input type="submit" value="Send" name="send" id="send">
    </div>
</form>

<?php
if (!isset($_POST['send'])):
    return;
endif;

$products = $_POST['products'];
$amounts = $_POST['amounts'];

foreach ($products as $key => $product):
    echo 'El producto con codigo ' . $key . ' tiene cantidad de ' . $amounts[$key];
    echo '<br>';
endforeach;