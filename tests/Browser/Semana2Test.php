<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Color;
use App\Models\Size;

class Semana2Test extends DuskTestCase
{
    use DatabaseMigrations;


    public function testmin5productsforeachcategory()
    {
        $categoriesData = [
            [
                'name' => 'Celulares y tablets',
                'slug' => Str::slug('Celulares y tablets'),
                'icon' => '<i class="fas fa-mobile-alt"></i>'
            ],
            [
                'name' => 'TV, audio y video',
                'slug' => Str::slug('TV, audio y video'),
                'icon' => '<i class="fas fa-tv"></i>'
            ],
            [
                'name' => 'Consola y videojuegos',
                'slug' => Str::slug('Consola y videojuegos'),
                'icon' => '<i class="fas fa-gamepad"></i>'
            ],
            [
                'name' => 'Computación',
                'slug' => Str::slug('Computación'),
                'icon' => '<i class="fas fa-laptop"></i>'
            ],
            [
                'name' => 'Moda',
                'slug' => Str::slug('Moda'),
                'icon' => '<i class="fas fa-tshirt"></i>'
            ],
        ];

        $categories = [];

        foreach ($categoriesData as $categoryData) {
            $categories[] = Category::factory()->create($categoryData);
        }

        $subcategoriesData = [
            [
                'category_id' => $categories[0]->id,
                'name' => 'Celulares y smartphones',
                'slug' => Str::slug('Celulares y smartphones'),
                'color' => true
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Accesorios para celulares',
                'slug' => Str::slug('Accesorios para celulares'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'TV y audio',
                'slug' => Str::slug('TV y audio'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Audios',
                'slug' => Str::slug('Audios'),
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Audio para autos',
                'slug' => Str::slug('Audio para autos'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Xbox',
                'slug' => Str::slug('xbox'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Play Station',
                'slug' => Str::slug('Play Station'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Videojuegos para PC',
                'slug' => Str::slug('Videojuegos para PC'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Nintendo',
                'slug' => Str::slug('Nintendo'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Portátiles',
                'slug' => Str::slug('Portátiles'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'PC escritorio',
                'slug' => Str::slug('PC escritorio'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Almacenamiento',
                'slug' => Str::slug('Almacenamiento'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Accesorios computadoras',
                'slug' => Str::slug('Accesorios computadoras'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Hombres',
                'slug' => Str::slug('Hombres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Lentes',
                'slug' => Str::slug('Lentes'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes'),
            ],
        ];
        $subcategoryes = [];

        foreach ($subcategoriesData as $subcategoryData) {
            $subcategoryes[] = Subcategory::factory()->create($subcategoryData);
        }

        Brand::factory()->create(['name' => 'Samsung'])->categories()->attach($categories[0]->id);
        Brand::factory()->create(['name' => 'Samsung2'])->categories()->attach($categories[1]->id);
        Brand::factory()->create(['name' => 'Samsung3'])->categories()->attach($categories[2]->id);
        Brand::factory()->create(['name' => 'Samsung4'])->categories()->attach($categories[3]->id);
        Brand::factory()->create(['name' => 'Samsung5'])->categories()->attach($categories[4]->id);


        $products = [];
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 2']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 3']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 4']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 5']);



        foreach ($products as $product) {
            $product->each(function (Product $product) {
                Image::factory(4)->create([
                    'imageable_id' => $product->id,
                    'imageable_type' => Product::class
                ]);
            });
        }


        $this->browse(function (Browser $browser) {
            $browser->visit('/categories/celulares-y-tablets')
                ->assertSee(
                    'Samsung Galaxy 1',
                    'Samsung Galaxy 2',
                    'Samsung Galaxy 3',
                    'Samsung Galaxy 4',
                    'Samsung Galaxy 5',
                );
        });
    }




    public function testnoverproductossinpublicar()
    {
        $categoriesData = [
            [
                'name' => 'Celulares y tablets',
                'slug' => Str::slug('Celulares y tablets'),
                'icon' => '<i class="fas fa-mobile-alt"></i>'
            ],
            [
                'name' => 'TV, audio y video',
                'slug' => Str::slug('TV, audio y video'),
                'icon' => '<i class="fas fa-tv"></i>'
            ],
            [
                'name' => 'Consola y videojuegos',
                'slug' => Str::slug('Consola y videojuegos'),
                'icon' => '<i class="fas fa-gamepad"></i>'
            ],
            [
                'name' => 'Computación',
                'slug' => Str::slug('Computación'),
                'icon' => '<i class="fas fa-laptop"></i>'
            ],
            [
                'name' => 'Moda',
                'slug' => Str::slug('Moda'),
                'icon' => '<i class="fas fa-tshirt"></i>'
            ],
        ];

        $categories = [];

        foreach ($categoriesData as $categoryData) {
            $categories[] = Category::factory()->create($categoryData);
        }

        $subcategoriesData = [
            [
                'category_id' => $categories[0]->id,
                'name' => 'Celulares y smartphones',
                'slug' => Str::slug('Celulares y smartphones'),
                'color' => true
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Accesorios para celulares',
                'slug' => Str::slug('Accesorios para celulares'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'TV y audio',
                'slug' => Str::slug('TV y audio'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Audios',
                'slug' => Str::slug('Audios'),
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Audio para autos',
                'slug' => Str::slug('Audio para autos'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Xbox',
                'slug' => Str::slug('xbox'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Play Station',
                'slug' => Str::slug('Play Station'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Videojuegos para PC',
                'slug' => Str::slug('Videojuegos para PC'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Nintendo',
                'slug' => Str::slug('Nintendo'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Portátiles',
                'slug' => Str::slug('Portátiles'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'PC escritorio',
                'slug' => Str::slug('PC escritorio'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Almacenamiento',
                'slug' => Str::slug('Almacenamiento'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Accesorios computadoras',
                'slug' => Str::slug('Accesorios computadoras'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Hombres',
                'slug' => Str::slug('Hombres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Lentes',
                'slug' => Str::slug('Lentes'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes'),
            ],
        ];
        $subcategoryes = [];

        foreach ($subcategoriesData as $subcategoryData) {
            $subcategoryes[] = Subcategory::factory()->create($subcategoryData);
        }

        Brand::factory()->create(['name' => 'Samsung'])->categories()->attach($categories[0]->id);
        Brand::factory()->create(['name' => 'Samsung2'])->categories()->attach($categories[1]->id);
        Brand::factory()->create(['name' => 'Samsung3'])->categories()->attach($categories[2]->id);
        Brand::factory()->create(['name' => 'Samsung4'])->categories()->attach($categories[3]->id);
        Brand::factory()->create(['name' => 'Samsung5'])->categories()->attach($categories[4]->id);


        $products = [];
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 1', 'status' => 1]);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 2']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 3']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 4']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 5']);



        foreach ($products as $product) {
            $product->each(function (Product $product) {
                Image::factory(4)->create([
                    'imageable_id' => $product->id,
                    'imageable_type' => Product::class
                ]);
            });
        }


        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee(
                    'Samsung Galaxy 2',
                    'Samsung Galaxy 3',
                    'Samsung Galaxy 4',
                    'Samsung Galaxy 5',
                )
                ->assertDontSee('Samsung Galaxy 1');
        });
    }




    public function testverdetallesdecategoria()
    {
        $categoriesData = [
            [
                'name' => 'Celulares y tablets',
                'slug' => Str::slug('Celulares y tablets'),
                'icon' => '<i class="fas fa-mobile-alt"></i>'
            ],
            [
                'name' => 'TV, audio y video',
                'slug' => Str::slug('TV, audio y video'),
                'icon' => '<i class="fas fa-tv"></i>'
            ],
            [
                'name' => 'Consola y videojuegos',
                'slug' => Str::slug('Consola y videojuegos'),
                'icon' => '<i class="fas fa-gamepad"></i>'
            ],
            [
                'name' => 'Computación',
                'slug' => Str::slug('Computación'),
                'icon' => '<i class="fas fa-laptop"></i>'
            ],
            [
                'name' => 'Moda',
                'slug' => Str::slug('Moda'),
                'icon' => '<i class="fas fa-tshirt"></i>'
            ],
        ];

        $categories = [];

        foreach ($categoriesData as $categoryData) {
            $categories[] = Category::factory()->create($categoryData);
        }

        $subcategoriesData = [
            [
                'category_id' => $categories[0]->id,
                'name' => 'Celulares y smartphones',
                'slug' => Str::slug('Celulares y smartphones'),
                'color' => true
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Accesorios para celulares',
                'slug' => Str::slug('Accesorios para celulares'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'TV y audio',
                'slug' => Str::slug('TV y audio'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Audios',
                'slug' => Str::slug('Audios'),
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Audio para autos',
                'slug' => Str::slug('Audio para autos'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Xbox',
                'slug' => Str::slug('xbox'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Play Station',
                'slug' => Str::slug('Play Station'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Videojuegos para PC',
                'slug' => Str::slug('Videojuegos para PC'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Nintendo',
                'slug' => Str::slug('Nintendo'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Portátiles',
                'slug' => Str::slug('Portátiles'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'PC escritorio',
                'slug' => Str::slug('PC escritorio'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Almacenamiento',
                'slug' => Str::slug('Almacenamiento'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Accesorios computadoras',
                'slug' => Str::slug('Accesorios computadoras'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Hombres',
                'slug' => Str::slug('Hombres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Lentes',
                'slug' => Str::slug('Lentes'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes'),
            ],
        ];
        $subcategoryes = [];

        foreach ($subcategoriesData as $subcategoryData) {
            $subcategoryes[] = Subcategory::factory()->create($subcategoryData);
        }

        Brand::factory()->create(['name' => 'Samsung'])->categories()->attach($categories[0]->id);
        Brand::factory()->create(['name' => 'Samsung2'])->categories()->attach($categories[1]->id);
        Brand::factory()->create(['name' => 'Samsung3'])->categories()->attach($categories[2]->id);
        Brand::factory()->create(['name' => 'Samsung4'])->categories()->attach($categories[3]->id);
        Brand::factory()->create(['name' => 'Samsung5'])->categories()->attach($categories[4]->id);


        $products = [];
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 2']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 3']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 4']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 5']);



        foreach ($products as $product) {
            $product->each(function (Product $product) {
                Image::factory(4)->create([
                    'imageable_id' => $product->id,
                    'imageable_type' => Product::class
                ]);
            });
        }


        $this->browse(function (Browser $browser) {
            $browser->visit('/categories/celulares-y-tablets')
                ->assertSee(
                    'Samsung Galaxy 1',
                    'Samsung Galaxy 2',
                    'Samsung Galaxy 3',
                    'Samsung Galaxy 4',
                    'Samsung Galaxy 5',
                    'Celulares y smartphones',
                    'Accesorios para celulares',
                    'Smartwatches',
                    'TV y audio',

                );
        });
    }







    public function testfiltrardesdecategoria()
    {
        $categoriesData = [
            [
                'name' => 'Celulares y tablets',
                'slug' => Str::slug('Celulares y tablets'),
                'icon' => '<i class="fas fa-mobile-alt"></i>'
            ],
            [
                'name' => 'TV, audio y video',
                'slug' => Str::slug('TV, audio y video'),
                'icon' => '<i class="fas fa-tv"></i>'
            ],
            [
                'name' => 'Consola y videojuegos',
                'slug' => Str::slug('Consola y videojuegos'),
                'icon' => '<i class="fas fa-gamepad"></i>'
            ],
            [
                'name' => 'Computación',
                'slug' => Str::slug('Computación'),
                'icon' => '<i class="fas fa-laptop"></i>'
            ],
            [
                'name' => 'Moda',
                'slug' => Str::slug('Moda'),
                'icon' => '<i class="fas fa-tshirt"></i>'
            ],
        ];

        $categories = [];

        foreach ($categoriesData as $categoryData) {
            $categories[] = Category::factory()->create($categoryData);
        }

        $subcategoriesData = [
            [
                'category_id' => $categories[0]->id,
                'name' => 'Celulares y smartphones',
                'slug' => Str::slug('Celulares y smartphones'),
                'color' => true
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Accesorios para celulares',
                'slug' => Str::slug('Accesorios para celulares'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'TV y audio',
                'slug' => Str::slug('TV y audio'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Audios',
                'slug' => Str::slug('Audios'),
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Audio para autos',
                'slug' => Str::slug('Audio para autos'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Xbox',
                'slug' => Str::slug('xbox'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Play Station',
                'slug' => Str::slug('Play Station'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Videojuegos para PC',
                'slug' => Str::slug('Videojuegos para PC'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Nintendo',
                'slug' => Str::slug('Nintendo'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Portátiles',
                'slug' => Str::slug('Portátiles'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'PC escritorio',
                'slug' => Str::slug('PC escritorio'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Almacenamiento',
                'slug' => Str::slug('Almacenamiento'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Accesorios computadoras',
                'slug' => Str::slug('Accesorios computadoras'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Hombres',
                'slug' => Str::slug('Hombres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Lentes',
                'slug' => Str::slug('Lentes'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes'),
            ],
        ];
        $subcategoryes = [];

        foreach ($subcategoriesData as $subcategoryData) {
            $subcategoryes[] = Subcategory::factory()->create($subcategoryData);
        }

        Brand::factory()->create(['name' => 'Samsung'])->categories()->attach($categories[0]->id);
        Brand::factory()->create(['name' => 'Samsung2'])->categories()->attach($categories[1]->id);
        Brand::factory()->create(['name' => 'Samsung3'])->categories()->attach($categories[2]->id);
        Brand::factory()->create(['name' => 'Samsung4'])->categories()->attach($categories[3]->id);
        Brand::factory()->create(['name' => 'Samsung5'])->categories()->attach($categories[4]->id);


        $products = [];
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 2']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'Samsung Galaxy 3']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'Samsung Galaxy 4']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'Samsung Galaxy 5']);



        foreach ($products as $product) {
            $product->each(function (Product $product) {
                Image::factory(4)->create([
                    'imageable_id' => $product->id,
                    'imageable_type' => Product::class
                ]);
            });
        }


        $this->browse(function (Browser $browser) {
            $browser->visit('/categories/celulares-y-tablets')
                ->assertSee(
                    'Samsung Galaxy 1',
                    'Samsung Galaxy 2',
                    'Samsung Galaxy 3',
                    'Samsung Galaxy 4',
                    'Samsung Galaxy 5',
                    'Celulares y smartphones',
                    'Accesorios para celulares',
                    'Smartwatches',
                    'TV y audio',

                )
                ->clickLink('Celulares y smartphones')
                ->assertSee('Samsung Galaxy 1', 'Samsung Galaxy 2');
        });
    }




    public function testverdetallesproducto()
    {
        $categoriesData = [
            [
                'name' => 'Celulares y tablets',
                'slug' => Str::slug('Celulares y tablets'),
                'icon' => '<i class="fas fa-mobile-alt"></i>'
            ],
            [
                'name' => 'TV, audio y video',
                'slug' => Str::slug('TV, audio y video'),
                'icon' => '<i class="fas fa-tv"></i>'
            ],
            [
                'name' => 'Consola y videojuegos',
                'slug' => Str::slug('Consola y videojuegos'),
                'icon' => '<i class="fas fa-gamepad"></i>'
            ],
            [
                'name' => 'Computación',
                'slug' => Str::slug('Computación'),
                'icon' => '<i class="fas fa-laptop"></i>'
            ],
            [
                'name' => 'Moda',
                'slug' => Str::slug('Moda'),
                'icon' => '<i class="fas fa-tshirt"></i>'
            ],
        ];

        $categories = [];

        foreach ($categoriesData as $categoryData) {
            $categories[] = Category::factory()->create($categoryData);
        }

        $subcategoriesData = [
            [
                'category_id' => $categories[0]->id,
                'name' => 'Celulares y smartphones',
                'slug' => Str::slug('Celulares y smartphones'),
                'color' => true
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Accesorios para celulares',
                'slug' => Str::slug('Accesorios para celulares'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'TV y audio',
                'slug' => Str::slug('TV y audio'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Audios',
                'slug' => Str::slug('Audios'),
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Audio para autos',
                'slug' => Str::slug('Audio para autos'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Xbox',
                'slug' => Str::slug('xbox'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Play Station',
                'slug' => Str::slug('Play Station'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Videojuegos para PC',
                'slug' => Str::slug('Videojuegos para PC'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Nintendo',
                'slug' => Str::slug('Nintendo'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Portátiles',
                'slug' => Str::slug('Portátiles'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'PC escritorio',
                'slug' => Str::slug('PC escritorio'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Almacenamiento',
                'slug' => Str::slug('Almacenamiento'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Accesorios computadoras',
                'slug' => Str::slug('Accesorios computadoras'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Hombres',
                'slug' => Str::slug('Hombres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Lentes',
                'slug' => Str::slug('Lentes'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes'),
            ],
        ];
        $subcategoryes = [];

        foreach ($subcategoriesData as $subcategoryData) {
            $subcategoryes[] = Subcategory::factory()->create($subcategoryData);
        }

        Brand::factory()->create(['name' => 'Samsung'])->categories()->attach($categories[0]->id);
        Brand::factory()->create(['name' => 'Samsung2'])->categories()->attach($categories[1]->id);
        Brand::factory()->create(['name' => 'Samsung3'])->categories()->attach($categories[2]->id);
        Brand::factory()->create(['name' => 'Samsung4'])->categories()->attach($categories[3]->id);
        Brand::factory()->create(['name' => 'Samsung5'])->categories()->attach($categories[4]->id);


        $products = [];
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 2']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'Samsung Galaxy 3']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'Samsung Galaxy 4']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'Samsung Galaxy 5']);



        foreach ($products as $product) {
            $product->each(function (Product $product) {
                Image::factory(4)->create([
                    'imageable_id' => $product->id,
                    'imageable_type' => Product::class
                ]);
            });
        }


        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee(
                    'Samsung Galaxy 1',

                )
                ->clickLink('Samsung Galaxy 1')
                ->assertSee('Samsung Galaxy 1');
        });
    }








    public function testvertodosdetallesproducto()
    {
        $categoriesData = [
            [
                'name' => 'Celulares y tablets',
                'slug' => Str::slug('Celulares y tablets'),
                'icon' => '<i class="fas fa-mobile-alt"></i>'
            ],
            [
                'name' => 'TV, audio y video',
                'slug' => Str::slug('TV, audio y video'),
                'icon' => '<i class="fas fa-tv"></i>'
            ],
            [
                'name' => 'Consola y videojuegos',
                'slug' => Str::slug('Consola y videojuegos'),
                'icon' => '<i class="fas fa-gamepad"></i>'
            ],
            [
                'name' => 'Computación',
                'slug' => Str::slug('Computación'),
                'icon' => '<i class="fas fa-laptop"></i>'
            ],
            [
                'name' => 'Moda',
                'slug' => Str::slug('Moda'),
                'icon' => '<i class="fas fa-tshirt"></i>'
            ],
        ];

        $categories = [];

        foreach ($categoriesData as $categoryData) {
            $categories[] = Category::factory()->create($categoryData);
        }

        $subcategoriesData = [
            [
                'category_id' => $categories[0]->id,
                'name' => 'Celulares y smartphones',
                'slug' => Str::slug('Celulares y smartphones'),
                'color' => true
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Accesorios para celulares',
                'slug' => Str::slug('Accesorios para celulares'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'TV y audio',
                'slug' => Str::slug('TV y audio'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Audios',
                'slug' => Str::slug('Audios'),
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Audio para autos',
                'slug' => Str::slug('Audio para autos'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Xbox',
                'slug' => Str::slug('xbox'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Play Station',
                'slug' => Str::slug('Play Station'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Videojuegos para PC',
                'slug' => Str::slug('Videojuegos para PC'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Nintendo',
                'slug' => Str::slug('Nintendo'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Portátiles',
                'slug' => Str::slug('Portátiles'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'PC escritorio',
                'slug' => Str::slug('PC escritorio'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Almacenamiento',
                'slug' => Str::slug('Almacenamiento'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Accesorios computadoras',
                'slug' => Str::slug('Accesorios computadoras'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Hombres',
                'slug' => Str::slug('Hombres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Lentes',
                'slug' => Str::slug('Lentes'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes'),
            ],
        ];
        $subcategoryes = [];

        foreach ($subcategoriesData as $subcategoryData) {
            $subcategoryes[] = Subcategory::factory()->create($subcategoryData);
        }

        Brand::factory()->create(['name' => 'Samsung'])->categories()->attach($categories[0]->id);
        Brand::factory()->create(['name' => 'Samsung2'])->categories()->attach($categories[1]->id);
        Brand::factory()->create(['name' => 'Samsung3'])->categories()->attach($categories[2]->id);
        Brand::factory()->create(['name' => 'Samsung4'])->categories()->attach($categories[3]->id);
        Brand::factory()->create(['name' => 'Samsung5'])->categories()->attach($categories[4]->id);


        $products = [];
        $products[] = Product::factory()->create([
            'subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 1',
            'description' => 'Samsung Galaxy 1 description', 'price' => 50
        ]);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 2']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'Samsung Galaxy 3']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'Samsung Galaxy 4']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'Samsung Galaxy 5']);



        foreach ($products as $product) {
            $product->each(function (Product $product) {
                Image::factory(4)->create([
                    'imageable_id' => $product->id,
                    'imageable_type' => Product::class
                ]);
            });
        }


        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee(
                    'Samsung Galaxy 1',

                )
                ->clickLink('Samsung Galaxy 1')
                ->assertSee('Samsung Galaxy 1', 'Samsung Galaxy 1 description', '50', '15', '1', '+', '-');
        });
    }













    public function testlimitesbotonesmasymenos()
    {
        $categoriesData = [
            [
                'name' => 'Celulares y tablets',
                'slug' => Str::slug('Celulares y tablets'),
                'icon' => '<i class="fas fa-mobile-alt"></i>'
            ],
            [
                'name' => 'TV, audio y video',
                'slug' => Str::slug('TV, audio y video'),
                'icon' => '<i class="fas fa-tv"></i>'
            ],
            [
                'name' => 'Consola y videojuegos',
                'slug' => Str::slug('Consola y videojuegos'),
                'icon' => '<i class="fas fa-gamepad"></i>'
            ],
            [
                'name' => 'Computación',
                'slug' => Str::slug('Computación'),
                'icon' => '<i class="fas fa-laptop"></i>'
            ],
            [
                'name' => 'Moda',
                'slug' => Str::slug('Moda'),
                'icon' => '<i class="fas fa-tshirt"></i>'
            ],
        ];

        $categories = [];

        foreach ($categoriesData as $categoryData) {
            $categories[] = Category::factory()->create($categoryData);
        }

        $subcategoriesData = [
            [
                'category_id' => $categories[0]->id,
                'name' => 'Celulares y smartphones',
                'slug' => Str::slug('Celulares y smartphones'),
                'color' => true
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Accesorios para celulares',
                'slug' => Str::slug('Accesorios para celulares'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'TV y audio',
                'slug' => Str::slug('TV y audio'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Audios',
                'slug' => Str::slug('Audios'),
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Audio para autos',
                'slug' => Str::slug('Audio para autos'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Xbox',
                'slug' => Str::slug('xbox'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Play Station',
                'slug' => Str::slug('Play Station'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Videojuegos para PC',
                'slug' => Str::slug('Videojuegos para PC'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Nintendo',
                'slug' => Str::slug('Nintendo'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Portátiles',
                'slug' => Str::slug('Portátiles'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'PC escritorio',
                'slug' => Str::slug('PC escritorio'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Almacenamiento',
                'slug' => Str::slug('Almacenamiento'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Accesorios computadoras',
                'slug' => Str::slug('Accesorios computadoras'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Hombres',
                'slug' => Str::slug('Hombres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Lentes',
                'slug' => Str::slug('Lentes'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes'),
            ],
        ];
        $subcategoryes = [];

        foreach ($subcategoriesData as $subcategoryData) {
            $subcategoryes[] = Subcategory::factory()->create($subcategoryData);
        }

        Brand::factory()->create(['name' => 'Samsung'])->categories()->attach($categories[0]->id);
        Brand::factory()->create(['name' => 'Samsung2'])->categories()->attach($categories[1]->id);
        Brand::factory()->create(['name' => 'Samsung3'])->categories()->attach($categories[2]->id);
        Brand::factory()->create(['name' => 'Samsung4'])->categories()->attach($categories[3]->id);
        Brand::factory()->create(['name' => 'Samsung5'])->categories()->attach($categories[4]->id);


        $products = [];
        $products[] = Product::factory()->create([
            'subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 1',
            'description' => 'Samsung Galaxy 1 description', 'price' => 50
        ]);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'Samsung Galaxy 2']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'Samsung Galaxy 3']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'Samsung Galaxy 4']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'Samsung Galaxy 5']);



        foreach ($products as $product) {
            $product->each(function (Product $product) {
                Image::factory(4)->create([
                    'imageable_id' => $product->id,
                    'imageable_type' => Product::class
                ]);
            });
        }


        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Samsung Galaxy 1',)
                ->clickLink('Samsung Galaxy 1')
                ->assertSee('Samsung Galaxy 1', 'Samsung Galaxy 1 description', '50', '15', '1', '+', '-')
                ->press('+')
                ->assertSee('2')
                ->press('-')
                ->assertSee('1')
                ->press('-')
                ->assertSee('1')
                ->press('+')
                ->press('+')
                ->press('+')
                ->press('+')
                ->press('+')
                ->press('+')
                ->press('+')
                ->press('+')
                ->press('+')
                ->press('+')
                ->press('+')
                ->press('+')
                ->press('+')
                ->press('+')
                ->assertSee('15')
                ->press('+')
                ->assertSee('15');
        });
    }





    public function testvercoloresytalla()
    {
        $categoriesData = [
            [
                'name' => 'Celulares y tablets',
                'slug' => Str::slug('Celulares y tablets'),
                'icon' => '<i class="fas fa-mobile-alt"></i>'
            ],
            [
                'name' => 'TV, audio y video',
                'slug' => Str::slug('TV, audio y video'),
                'icon' => '<i class="fas fa-tv"></i>'
            ],
            [
                'name' => 'Consola y videojuegos',
                'slug' => Str::slug('Consola y videojuegos'),
                'icon' => '<i class="fas fa-gamepad"></i>'
            ],
            [
                'name' => 'Computación',
                'slug' => Str::slug('Computación'),
                'icon' => '<i class="fas fa-laptop"></i>'
            ],
            [
                'name' => 'Moda',
                'slug' => Str::slug('Moda'),
                'icon' => '<i class="fas fa-tshirt"></i>'
            ],
        ];

        $categories = [];

        foreach ($categoriesData as $categoryData) {
            $categories[] = Category::factory()->create($categoryData);
        }

        $subcategoriesData = [
            [
                'category_id' => $categories[0]->id,
                'name' => 'Celulares y smartphones',
                'slug' => Str::slug('Celulares y smartphones'),
                'color' => 1,
                'size' => 1
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Accesorios para celulares',
                'slug' => Str::slug('Accesorios para celulares'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'TV y audio',
                'slug' => Str::slug('TV y audio'),
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Audios',
                'slug' => Str::slug('Audios'),
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Audio para autos',
                'slug' => Str::slug('Audio para autos'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Xbox',
                'slug' => Str::slug('xbox'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Play Station',
                'slug' => Str::slug('Play Station'),
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Videojuegos para PC',
                'slug' => Str::slug('Videojuegos para PC'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Nintendo',
                'slug' => Str::slug('Nintendo'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Portátiles',
                'slug' => Str::slug('Portátiles'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'PC escritorio',
                'slug' => Str::slug('PC escritorio'),
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Almacenamiento',
                'slug' => Str::slug('Almacenamiento'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Accesorios computadoras',
                'slug' => Str::slug('Accesorios computadoras'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Hombres',
                'slug' => Str::slug('Hombres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Lentes',
                'slug' => Str::slug('Lentes'),
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes'),
            ],
        ];
        $subcategoryes = [];

        foreach ($subcategoriesData as $subcategoryData) {
            $subcategoryes[] = Subcategory::factory()->create($subcategoryData);
        }

        Brand::factory()->create(['name' => 'Samsung'])->categories()->attach($categories[0]->id);
        Brand::factory()->create(['name' => 'Samsung2'])->categories()->attach($categories[1]->id);
        Brand::factory()->create(['name' => 'Samsung3'])->categories()->attach($categories[2]->id);
        Brand::factory()->create(['name' => 'Samsung4'])->categories()->attach($categories[3]->id);
        Brand::factory()->create(['name' => 'Samsung5'])->categories()->attach($categories[4]->id);


        $products = [];
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[0]->id, 'name' => 'samsung']);




        foreach ($products as $product) {
            $product->each(function (Product $product) {
                Image::factory(4)->create([
                    'imageable_id' => $product->id,
                    'imageable_type' => Product::class
                ]);
            });
        }

        $colors = ['white', 'blue', 'red', 'black'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }

        $products[0]->colors()->attach([
            1 => [
                'quantity' => 10
            ],
            2 => [
                'quantity' => 10
            ],
            3 => [
                'quantity' => 10
            ],
            4 => [
                'quantity' => 10
            ]
        ]);


        $sizes = ['Talla S', 'Talla M', 'Talla L'];
        foreach ($products as $product) {
            foreach ($sizes as $size) {
                $product->sizes()->create([
                    'name' => $size
                ]);
            }
        }


        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 10],
                    2 => ['quantity' => 10],
                    3 => ['quantity' => 10],
                    4 => ['quantity' => 10]
                ]);
        }

        $this->browse(function (Browser $browser) use ($products) {
            $browser->visit('/products/' . $products[0]->slug)
                ->assertSee('samsung')
                ->click('@selectSize')
                ->click('@selectSize-id-1')
                ->click('@selectSize')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->assertSee('Negro');           
        });
    }
}
