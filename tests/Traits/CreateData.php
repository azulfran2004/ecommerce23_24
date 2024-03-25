<?php

namespace Tests\Traits;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Color;
use App\Models\Size;
use Spatie\Permission\Models\Role;
use App\Models\User;

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
            $products[] = Product::factory(2)->create([
                'subcategory_id' => $subcategory->id, 
               
            ]);
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




    public function createAllData($data)
    {
        $categories = $this->createCategories($data['categories']);

        $subcategories = $this->createSubcategories($data['subcategories'], $categories);

        $this->createBrands($data['brandNames'], $categories);

        $products = $this->createProducts($subcategories);

        return [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
        ];
    }


    public function createColors()
    {
        $colors = ['white', 'blue', 'red', 'black'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
    }
    public function attachColorsToProducts($products)
    {
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => ['quantity' => 10],
                2 => ['quantity' => 10],
                3 => ['quantity' => 10],
                4 => ['quantity' => 10]
            ]);
        }
    }

    public function createSizesForProducts($products)
    {
        $sizes = ['Talla S', 'Talla M', 'Talla L'];
        foreach ($products as $product) {
            foreach ($sizes as $size) {
                $product->sizes()->create([
                    'name' => $size
                ]);
            }
        }
    }

    public function attachColorsToSizes()
    {
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()->attach([
                1 => ['quantity' => 10],
                2 => ['quantity' => 10],
                3 => ['quantity' => 10],
                4 => ['quantity' => 10]
            ]);
        }
    }

    public function createRoleAndUser()
    {
        $role = Role::create(['name' => 'admin']);
        User::factory()->create([
            'name' => 'Carlos Abrisqueta',
            'email' => 'carlos@test.com',
            'password' => bcrypt("cisco2004"),
        ])->assignRole('admin');
    }


    public function createAllDataWithColors($data)
    {
        $categories = $this->createCategories($data['categories']);
        $subcategories = $this->createSubcategories($data['subcategories'], $categories);
        $this->createBrands($data['brandNames'], $categories);
        $products = $this->createProducts($subcategories);

        $this->createColors();
        $this->attachColorsToProducts($products);
        $this->createSizesForProducts($products);
        $this->attachColorsToSizes();

        $this->createRoleAndUser();

        return [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
        ];
    }
}
