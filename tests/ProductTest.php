<?php

class ProductTest extends TestCase
{
    /**
     * /products [GET]
     */
    public function testShouldReturnAllProducts()
    {

        $this->get("api/products", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            "result" => [
                'data' => [
                    '*' =>
                    [
                        'id',
                        'name',
                        'price'
                    ]
                ]
            ]
        ]);
    }
}
