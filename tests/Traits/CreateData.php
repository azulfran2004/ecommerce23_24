<?php

namespace Tests\Traits;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;

trait CreateData
{
    public function createCategories($categoriesData)
    {
        $categories = [];

        foreach ($categoriesData as $categoryData) {
            $categories[] = Category::factory()->create($categoryData);
        }

        return $categories;
    }

    public function createSubcategories($subcategoriesData, $categories)
    {
        $subcategories = [];

        foreach ($subcategoriesData as $subcategoryData) {
            $subcategories[] = Subcategory::factory()->create($subcategoryData);
        }

        return $subcategories;
    }

    public function createBrands($brandNames, $categories)
    {
        foreach ($brandNames as $index => $brandName) {
            Brand::factory()->create(['name' => $brandName])->categories()->attach($categories[$index]->id);
        }
    }

    public function createProducts($subcategories)
    {
        $products = [];

        foreach ($subcategories as $subcategory) {
            $products[] = Product::factory(2)->create(['subcategory_id' => $subcategory->id]);
        }

        foreach ($products as $product) {
            $product->each(function (Product $product) {
                Image::factory(4)->create([
                    'imageable_id' => $product->id,
                    'imageable_type' => Product::class
                ]);
            });
        }

        return $products;
    }
}