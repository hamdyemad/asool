<?php

namespace App\Repositories;

use App\SubCategory;

class SubCategoryRepository
{
    public function all($filters = [], $perPage = 15)
    {
        return SubCategory::with('category')->filter($filters)->latest()->latest('id')->paginate($perPage);
    }

    public function find($id)
    {
        return SubCategory::with('category')->findOrFail($id);
    }

    public function create(array $data)
    {
        return SubCategory::create($data);
    }

    public function update($id, array $data)
    {
        $subCategory = $this->find($id);
        $subCategory->update($data);
        return $subCategory;
    }

    public function delete($id)
    {
        $subCategory = $this->find($id);
        return $subCategory->delete();
    }
}
