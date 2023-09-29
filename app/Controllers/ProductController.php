<?php

namespace App\Controllers;

use App\Models\Product;
use MgahedMvc\Http\Request;
use MgahedMvc\Support\Str;
use MgahedMvc\Validation\Validator;

class ProductController
{
    private function getProductFiltered($sku)
    {
        return app()->db->raw(
            'SELECT
                        sku,
                        name,
                        price,
                        product_type as productType,
                        CASE
                            WHEN product_type = "dvd" THEN CONCAT("Size: ", size, " MB")
                            WHEN product_type = "book" THEN CONCAT("Weight: ", weight, " kg")
                            WHEN product_type = "furniture" THEN CONCAT("Dimentions: ", heigth, " x ", width, " x ", length)
                            ELSE NULL
                        END AS type_value
                    FROM products
                    WHERE sku = ?',
            [$sku]
        );
    }

    /***
     * @description This is a json response for api
     */
    public function jsonIndex()
    {
        $products = Product::all();
        if ($products) {
            return responseJson($products);
        } else {
            return responseJson([
                "message" => "No products found",
            ], 404);
        }
    }

    public function jsonGet()
    {
        $validator = new Validator();
        $request = new Request;
        $validator->make($request->all(), [
            'sku' => 'required'
        ]);

        if ($validator->errors()) {
            $errors = $validator->errors();
            return responseJson([
                'message' => 'Validation error',
                'errors' => $errors
            ], 422);
        }

        $product = $this->getProductFiltered($request->all()['sku']);
        if ($product) {
            return responseJson($product[0]);
        } else {
            return responseJson([
                "message" => "No product found",
            ], 404);
        }
    }

    public function jsonInsert()
    {
        $validator = new Validator();
        $request = new Request;
        if (isset($request->all()['productType'])) {
            $request->addValue('product_type', Str::lower($request->all()['productType']));
        } else {
            $request->updateValue('product_type', Str::lower($request->all()['product_type']));
        }
        $validator->make($request->all(), [
            'sku' => 'required|unique:products,sku',
            'name' => 'required',
            'price' => 'required|numeric|min_value:0',
            'product_type' => 'required',
        ]);
        if ($validator->errors()) {
            $errors = $validator->errors();
            return responseJson([
                'message' => 'Validation error',
                'errors' => $errors
            ], 422);
        }

        if ($request->all()['product_type'] == 'dvd'){
            $validator->make($request->all(), [
                'size' => 'required|numeric|min_value:0',
            ]);
        } else if ($request->all()['product_type'] == 'book'){
            $validator->make($request->all(), [
                'weight' => 'required|numeric|min_value:0',
            ]);
        } else if ($request->all()['product_type'] == 'furniture'){
            $validator->make($request->all(), [
                'heigth' => 'required|numeric|min_value:0',
                'width' => 'required|numeric|min_value:0',
                'length' => 'required|numeric|min_value:0',
            ]);
        } else {
            return responseJson([
                'message' => 'Validation error',
                'errors' => ['Product type is not valid']
            ], 422);
        }
        if ($validator->errors()) {
            $errors = $validator->errors();
            return responseJson([
                'message' => 'Validation error',
                'errors' => $errors
            ], 422);
        }

        $product = Product::create([
            'sku' => $request->all()['sku'],
            'name' => $request->all()['name'],
            'price' => $request->all()['price'],
            'product_type' => $request->all()['product_type'],
            'size' => $request->all()['size'] ?? null,
            'weight' => $request->all()['weight'] ?? null,
            'heigth' => $request->all()['heigth'] ?? null,
            'width' => $request->all()['width'] ?? null,
            'length' => $request->all()['length'] ?? null,
        ]);
        if ($product) {
            $product = $this->getProductFiltered($request->all()['sku']);
            return responseJson($product[0]);
        } else {
            return responseJson([
                "message" => "Product not created",
            ], 500);
        }
    }


    /***
     * @description This is a view response
     */

    public function all()
    {
        $products = app()->db->raw(
            'SELECT
                        id,
                        sku,
                        name,
                        price,
                        product_type as productType,
                        CASE
                            WHEN product_type = "dvd" THEN CONCAT("Size: ", size, " MB")
                            WHEN product_type = "book" THEN CONCAT("Weight: ", weight, " kg")
                            WHEN product_type = "furniture" THEN CONCAT("Dimentions: ", heigth, " x ", width, " x ", length)
                            ELSE NULL
                        END AS type_value
                    FROM products'
        );
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function delete()
    {
        $validator = new Validator();
        $request = new Request;
        $validator->make($request->all(), [
            'ids' => 'required',
        ]);
        if ($validator->errors()) {
            $errors = $validator->errors();
            return responseJson([
                'message' => 'Validation error',
                'errors' => $errors
            ], 422);
        }
        $ids = explode(',', $request->all()['ids']);
        foreach ($ids as $id) {
            Product::delete($id);
        }
        return responseJson([
            "message" => "Products deleted",
        ], 200);
    }
}