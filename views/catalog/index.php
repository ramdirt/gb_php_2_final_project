<h2>Каталог</h2>

<?php foreach ($catalog as $item) : ?>
<div>

    <img width="200" src="./assets/img/big/<?= $item['img'] ?>" alt="">
    <h3><a href="./?c=product&a=index&id=<?= $item['id'] ?>"><?= $item['title'] ?></a></h3>
    <p>price: <?= $item['price'] ?></p>
    <form action="./?c=basket&a=insert&id=<?= $item['id'] ?>" method="post">
        <button type="submit">Купить</button>
    </form>
</div>
<?php endforeach; ?>

<a href="/?c=product&a=catalog&page=<?= $page ?>">Еще</a>