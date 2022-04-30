<?php

use app\models\Product;

class ProductTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider providerProductConstructor
     */
    public function testProductConstructor($a, $b)
    {
        $product = new Product(...$a);
        $this->assertEquals($b['title'], $product->title);
        $this->assertNotEquals($b['price'], $product->price);
        $this->assertIsNumeric($product->price);
    }

    public function testProductProps()
    {
        $product = new Product();
        $this->assertEquals(false, $product->props['title']);
    }

    public function providerProductConstructor()
    {
        return array(
            array(
                array(
                    'title' => 'Чай',
                    'category_id' => 2,
                    'img' => '1.jpg',
                    'price' => 100,
                    'description' => 'Описание 23423'
                ),
                array(
                    'title' => 'Чай',
                    'category_id' => 2,
                    'img' => '1.jpg',
                    'price' => 200,
                    'description' => 'Описание 23423'
                ),
            ),
            array(
                array(
                    'title' => 'Чай',
                    'category_id' => 2,
                    'img' => '1.jpg',
                    'price' => 200,
                    'description' => 'Описание 23423'
                ),
                array(
                    'title' => 'Чай',
                    'category_id' => 3,
                    'img' => '2.jpg',
                    'price' => 200,
                    'description' => 'Описание 23423'
                ),
            )
        );
    }
}