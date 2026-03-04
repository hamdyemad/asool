<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts($filters = [], $perPage = 15)
    {
        return $this->productRepository->all($filters, $perPage);
    }

    public function getProductById($id)
    {
        return $this->productRepository->find($id);
    }

    public function createProduct(array $data)
    {
        if (isset($data['main_image'])) {
            $data['main_image'] = $this->uploadImage($data['main_image']);
        }

        $product = $this->productRepository->create($data);

        if (isset($data['other_images'])) {
            $this->uploadOtherImages($product, $data['other_images']);
        }

        return $product;
    }

    public function updateProduct($id, array $data)
    {
        $product = $this->productRepository->find($id);

        if (isset($data['main_image'])) {
            if ($product->main_image) {
                Storage::disk('public')->delete($product->main_image);
            }
            $data['main_image'] = $this->uploadImage($data['main_image']);
        }

        $updatedProduct = $this->productRepository->update($id, $data);

        if (isset($data['other_images'])) {
            $this->uploadOtherImages($updatedProduct, $data['other_images']);
        }

        return $updatedProduct;
    }

    public function deleteProduct($id)
    {
        $product = $this->productRepository->find($id);

        if ($product->main_image) {
            Storage::disk('public')->delete($product->main_image);
        }

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        return $this->productRepository->delete($id);
    }

    protected function uploadImage($image)
    {
        return $image->store('products', 'public');
    }

    protected function uploadOtherImages($product, $images)
    {
        foreach ($images as $image) {
            $path = $this->uploadImage($image);
            $product->images()->create(['image_path' => $path]);
        }
    }
}
