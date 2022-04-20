<h2>Корзина</h2>

<?php foreach ($basket as $product) : ?>
<div style="background-color: gray; color: white; width: 300px; padding: 20px;">

    <img width="200" src="./assets/img/big/<?= $product->img ?>" alt="">
    <h3><?= $product->title ?></h3>
    <p>Стоимость: <?= $product->price ?> $</p>
    <p>Количество: <?= $product->quantity ?></p>
    <p>Общая стоимость: <?= $product->price * $product->quantity ?> $</p>
    <hr>
</div>
<?php endforeach; ?>