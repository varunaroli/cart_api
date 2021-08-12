<?php

class CartTest extends TestCase
{
    /**
     * /products [GET]
     */
    public function testShouldUpdateCart()
    {

        $parameters = [
            'product_id' => '1',
            'quantity' => '1',
            'price' => '30'
        ];

        $this->post("api/cart", $parameters, []);
        $this->seeStatusCode(201);
        // $this->seeJsonStructure(
        //     [
        //         'data' =>
        //         [
        //             'product_name',
        //             'product_description',
        //             'created_at',
        //             'updated_at',
        //             'links'
        //         ]
        //     ]
        // );
    }
}
