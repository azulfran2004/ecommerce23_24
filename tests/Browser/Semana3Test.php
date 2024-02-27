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
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Department;
use App\Models\City;
use App\Models\District;

class Semana3Test extends DuskTestCase
{
    use DatabaseMigrations;

    public function testcarritotresproductos()
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
                'color' => 1,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'color' => 0,
                'size' => 0,
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2']);





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
        $products[1]->colors()->attach([
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
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('1')


                ->visit('/products/' . $products[1]->slug)
                ->assertSee('samsung1')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)


                ->visit('/products/' . $products[2]->slug)
                ->assertSee('samsung2')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('3')
                ->screenshot('/products/' . $products[2]->slug);
        });
    }




    public function testclicarencarrito()
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
                'color' => 1,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'color' => 0,
                'size' => 0,
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2']);





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
        $products[1]->colors()->attach([
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
            $browser->visit('/products/' . $products[2]->slug)
                ->assertSee('samsung2')
                ->press('@carrito')
                ->pause(1000)
                ->click('@carritodesplegable')
                ->pause(1000)
                ->assertSee('samsung2')

                ->screenshot('/products/' . $products[2]->slug);
        });
    }





    public function testcirculorojoencarrito()
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
                'color' => 1,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'color' => 0,
                'size' => 0,
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2']);





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
        $products[1]->colors()->attach([
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
            $browser->visit('/products/' . $products[2]->slug)
                ->assertSee('samsung2')
                ->press('@carrito')
                ->pause(1000)
                ->click('@carritodesplegable')
                ->pause(1000)
                ->assertSee('1')
                ->screenshot('/products/' . $products[2]->slug);
        });
    }







    public function teststockproductos()
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
                'color' => 1,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'color' => 0,
                'size' => 0,
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2']);





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
        $products[1]->colors()->attach([
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
                ->click('@selectColor')
                ->pause(1000)
                ->assertSee('10')


                ->visit('/products/' . $products[1]->slug)
                ->assertSee('samsung1')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->pause(1000)
                ->assertSee('10')



                ->visit('/products/' . $products[2]->slug)
                ->assertSee('samsung2')
                ->pause(1000)
                ->assertSee('15');
        });
    }






    public function testbuscarproductos()
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
                'color' => 1,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'color' => 0,
                'size' => 0,
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2']);





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
        $products[1]->colors()->attach([
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
            $browser->visit('/')
                ->assertSee('samsung')
                ->click('@recuadro')
                ->type('@recuadro', 'samsung')
                ->click('@buscar')
                ->assertSee('samsung', 'samsung1', 'samsung2')
                ->click('@recuadro')
                ->type('@recuadro', 'samsung1')
                ->click('@buscar')
                ->assertSee('samsung1')
                ->screenshot('/');
        });
    }






    public function testvercarrito()
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
                'color' => 1,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'color' => 0,
                'size' => 0,
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2']);





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
        $products[1]->colors()->attach([
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
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('1')


                ->visit('/products/' . $products[1]->slug)
                ->assertSee('samsung1')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)


                ->visit('/products/' . $products[2]->slug)
                ->assertSee('samsung2')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('3')
                ->click('@carritodesplegable')
                ->click('@carritolink')
                ->assertSee('samsung', 'samsung1', 'samsung2', 'carrito de compras')
                ->screenshot('/shoppingcart');
        });
    }




    public function testbotonescarrito()
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
                'color' => 1,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'color' => 0,
                'size' => 0,
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[0]->id, 'name' => 'samsung', 'price' => '30']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2']);





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
        $products[1]->colors()->attach([
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
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('1')
                ->click('@carritodesplegable')
                ->click('@carritolink')
                ->press('+')
                ->pause(1000)
                ->assertSeeIn('@total', '60')
                ->screenshot('/shoppingcart');
        });
    }




    public function testvaciarcarrito()
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
                'color' => 1,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'color' => 0,
                'size' => 0,
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[0]->id, 'name' => 'samsung', 'price' => '30']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2']);





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
        $products[1]->colors()->attach([
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
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('1')
                ->visit('/products/' . $products[1]->slug)
                ->assertSee('samsung1')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->click('@carritodesplegable')
                ->click('@carritolink')
                ->click('@borrar')
                ->pause(1000)
                ->assertDontSee('samsumg')
                ->click('@vaciarcarrito')
                ->pause(1000)
                ->assertDontSee('samsumg', 'samsung1')
                ->screenshot('/shoppingcart');
        });
    }




    public function testcrearpedido()
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
                'color' => 1,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'color' => 0,
                'size' => 0,
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[0]->id, 'name' => 'samsung', 'price' => '30']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2']);





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
        $products[1]->colors()->attach([
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

        $role = Role::create(['name' => 'admin']);
        User::factory()->create([
            'name' => 'Carlos Abrisqueta',
            'email' => 'carlos@test.com',
            'password' => bcrypt("cisco2004"),
        ])->assignRole('admin');


        $this->browse(function (Browser $browser) use ($products) {
            $browser->visit('/login')
                ->click('@email')
                ->type('@email', 'carlos@test.com')
                ->click('@contraseña')
                ->type('@contraseña', 'cisco2004')
                ->pause(1000)
                ->click('@login')
                ->visit('/products/' . $products[0]->slug)
                ->assertSee('samsung')
                ->click('@selectSize')
                ->click('@selectSize-id-1')
                ->click('@selectSize')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('1')
                ->visit('/products/' . $products[1]->slug)
                ->assertSee('samsung1')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->click('@carritodesplegable')
                ->click('@carritolink')
                ->visit('/orders/create')

                ->click('@nombre')
                ->type('@nombre', 'carlos')
                ->click('@telefono')
                ->type('@telefono', '1234')
                ->click('@continuar')
                ->pause(1000)
                ->screenshot('/orders/create')
                ->pause(1000)
                ->assertSee('@parrafo');
        });
    }






    public function testguardarcarrito()
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
                'color' => 1,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'color' => 0,
                'size' => 0,
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[0]->id, 'name' => 'samsung', 'price' => '30']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2']);





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
        $products[1]->colors()->attach([
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

        $role = Role::create(['name' => 'admin']);
        User::factory()->create([
            'name' => 'Carlos Abrisqueta',
            'email' => 'carlos@test.com',
            'password' => bcrypt("cisco2004"),
        ])->assignRole('admin');


        $this->browse(function (Browser $browser) use ($products) {
            $browser->visit('/login')
                ->click('@email')
                ->type('@email', 'carlos@test.com')
                ->click('@contraseña')
                ->type('@contraseña', 'cisco2004')
                ->pause(1000)
                ->click('@login')
                ->visit('/products/' . $products[0]->slug)
                ->assertSee('samsung')
                ->click('@selectSize')
                ->click('@selectSize-id-1')
                ->click('@selectSize')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('1')
                ->visit('/products/' . $products[1]->slug)
                ->assertSee('samsung1')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->click('@carritodesplegable')
                ->click('@carritolink')
                ->visit('/orders/create')
                ->pause(1000)
                ->click('@botonregistro')
                ->click('@finalizar')
                ->pause(1000)
                ->visit('/login')
                ->click('@email')
                ->type('@email', 'carlos@test.com')
                ->click('@contraseña')
                ->type('@contraseña', 'cisco2004')
                ->pause(1000)
                ->click('@login')
                ->pause(1000)
                ->screenshot('/orders/create')
                ->click('@carritodesplegable')
                ->pause(1000)
                ->assertSeeIn('@carritolink', 'Ir al carrito de compras')
                ->screenshot('/orders/create');
        });
    }







    public function testformulariopagar()
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
                'color' => 1,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'color' => 0,
                'size' => 0,
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[0]->id, 'name' => 'samsung', 'price' => '30']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2']);





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
        $products[1]->colors()->attach([
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

        $role = Role::create(['name' => 'admin']);
        User::factory()->create([
            'name' => 'Carlos Abrisqueta',
            'email' => 'carlos@test.com',
            'password' => bcrypt("cisco2004"),
        ])->assignRole('admin');


        $this->browse(function (Browser $browser) use ($products) {
            $browser->visit('/login')
                ->click('@email')
                ->type('@email', 'carlos@test.com')
                ->click('@contraseña')
                ->type('@contraseña', 'cisco2004')
                ->pause(1000)
                ->click('@login')
                ->visit('/products/' . $products[0]->slug)
                ->assertSee('samsung')
                ->click('@selectSize')
                ->click('@selectSize-id-1')
                ->click('@selectSize')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('1')
                ->visit('/products/' . $products[1]->slug)
                ->assertSee('samsung1')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->click('@carritodesplegable')
                ->click('@carritolink')
                ->visit('/orders/create')
                ->pause(1000)
                ->assertSee('Nombre de contacto')
                ->assertDontSee('Departamento')
                ->click('@domicilio')
                ->pause(1000)
                ->screenshot('/orders/create')
                ->assertSee('Departamento');
        });
    }







    public function testcrearpedidoyborrarcarrito()
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
                'color' => 1,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'color' => 0,
                'size' => 0,
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[0]->id, 'name' => 'samsung', 'price' => '30']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2']);





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
        $products[1]->colors()->attach([
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

        $role = Role::create(['name' => 'admin']);
        User::factory()->create([
            'name' => 'Carlos Abrisqueta',
            'email' => 'carlos@test.com',
            'password' => bcrypt("cisco2004"),
        ])->assignRole('admin');


        $this->browse(function (Browser $browser) use ($products) {
            $browser->visit('/login')
                ->click('@email')
                ->type('@email', 'carlos@test.com')
                ->click('@contraseña')
                ->type('@contraseña', 'cisco2004')
                ->pause(1000)
                ->click('@login')
                ->visit('/products/' . $products[0]->slug)
                ->assertSee('samsung')
                ->click('@selectSize')
                ->click('@selectSize-id-1')
                ->click('@selectSize')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('1')
                ->visit('/products/' . $products[1]->slug)
                ->assertSee('samsung1')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->click('@carritodesplegable')
                ->click('@carritolink')
                ->visit('/orders/create')

                ->click('@nombre')
                ->type('@nombre', 'carlos')
                ->click('@telefono')
                ->type('@telefono', '1234')
                ->click('@continuar')
                ->pause(1000)
                ->click('@carritodesplegable')
                ->pause(1000)
                ->assertSee('No tiene agregado ningún item en el carrito')
                ->screenshot('/orders/create');
        });
    }






    public function testselects()
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
                'color' => 1,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwatches'),
                'color' => 0,
                'size' => 0,
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[0]->id, 'name' => 'samsung', 'price' => '30']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2']);





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
        $products[1]->colors()->attach([
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

        $role = Role::create(['name' => 'admin']);
        User::factory()->create([
            'name' => 'Carlos Abrisqueta',
            'email' => 'carlos@test.com',
            'password' => bcrypt("cisco2004"),
        ])->assignRole('admin');

        $departamentos = Department::factory(8)->create()->each(function (Department $department) {
            City::factory(8)->create([
                'department_id' => $department->id
            ])->each(function (City $city) {
                District::factory(8)->create([
                    'city_id' => $city->id
                ]);
            });
        });


        $this->browse(function (Browser $browser) use ($products, $departamentos) {
            $browser->visit('/login')
                ->click('@email')
                ->type('@email', 'carlos@test.com')
                ->click('@contraseña')
                ->type('@contraseña', 'cisco2004')
                ->pause(1000)
                ->click('@login')
                ->visit('/products/' . $products[0]->slug)
                ->assertSee('samsung')
                ->click('@selectSize')
                ->click('@selectSize-id-1')
                ->click('@selectSize')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('1')
                ->visit('/products/' . $products[1]->slug)
                ->assertSee('samsung1')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->click('@carritodesplegable')
                ->click('@carritolink')
                ->visit('/orders/create')
                ->pause(1000)
                ->assertSee('Nombre de contacto')
                ->assertDontSee('Departamento')
                ->click('@domicilio')
                ->pause(1000)
                ->assertSee('Departamento')
                ->click('@departament')
                ->pause(1000)
                ->screenshot('/orders/create')
                ->pause(1000)
                ->assertSee($departamentos[0]->name)
                ->click('@departament-id-1')
                ->click('@ciudad')
                ->pause(1000)
                ->assertSee($departamentos[0]->cities[0]->name)
                ->click('@ciudad-id-1')
                ->click('@distrito')
                ->pause(1000)
                ->assertSee($departamentos[0]->cities[0]->districts[0]->name)   
                ->click('@distrito-id-1')
                ->pause(1000);
        });
    }















    
}
