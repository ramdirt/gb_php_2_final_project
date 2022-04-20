<h2>Товар</h2>

<div>
    <img width="300" src="./assets/img/big/<?= $product->img ?>" alt="">
    <h3><?= $product->title ?></h3>
    <p><?= $product->description ?></p>
    <p>price: <?= $product->price ?></p>
    <form action="./?c=basket&a=insert&id=<?= $product->id ?>" method="post">
        <button type="submit">Купить</button>
    </form>
</div>