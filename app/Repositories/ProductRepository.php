<?php

namespace App\Repositories;

use App\Product;

class ProductRepository
{
    public function all($filters = [], $perPage = 15)
    {
        return Product::with(['category', 'subCategory', 'images'])->filter($filters)->latest()->latest('id')->paginate($perPage);
    }

    public function find($id)
    {
        return Product::with(['category', 'subCategory', 'images'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->find($id);
        return $product->delete();
    }
}
