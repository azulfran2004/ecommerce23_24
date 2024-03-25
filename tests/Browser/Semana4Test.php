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

class Semana4Test extends DuskTestCase
{
    use DatabaseMigrations;

    public function testrutas()
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
        $role = Role::create(['name' => 'admin']);
        User::factory()->create([
            'name' => 'Carlos Abrisqueta',
            'email' => 'carlos@test.com',
            'password' => bcrypt("cisco2004"),
        ])->assignRole('admin');

        $this->browse(function (Browser $browser) use ($products) {
            $browser->visit('/admin')
                ->assertDontSee('Lista de productos')
                ->click('@email')
                ->type('@email', 'carlos@test.com')
                ->click('@contraseña')
                ->type('@contraseña', 'cisco2004')
                ->pause(1000)
                ->click('@login')
                ->visit('/admin')
                ->pause(1000)
                ->screenshot('/admin')
                ->assertSee('Lista de productos');
        });
    }


//politica




    public function testmispedidos()
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
                ->pause(1000)
                ->click('@botonregistro')
                ->click('@pedidos')
                ->pause(1000)
                ->assertSee('No existen registros de pedidos')
                ->screenshot('/login');
        });
    }





    public function teststocktresproductos()
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
                ->assertSee('9')


                ->visit('/products/' . $products[1]->slug)
                ->assertSee('samsung1')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('9')


                ->visit('/products/' . $products[2]->slug)
                ->assertSee('samsung2')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('14')
                ->assertSee('3')
                ->screenshot('/products/' . $products[2]->slug);
        });
    }






    public function teststockbd()
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
                ->visit('/products/' . $products[2]->slug)
                ->press('@carrito')
                ->click('@carritodesplegable')
                ->click('@carritolink')
                ->visit('/orders/create')
                ->click('@nombre')
                ->type('@nombre', 'carlos')
                ->click('@telefono')
                ->type('@telefono', '1234')
                ->click('@continuar')
                ->pause(1000)

                ->screenshot('/orders/create');
        });

        $this->assertDatabaseHas('products', ['quantity' => '14']);
        $this->assertDatabaseHas('color_product', ['quantity' => '9']);
        $this->assertDatabaseHas('color_size', ['quantity' => '9']);
    }






    public function testbuscadoradmin()
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
                ->visit('/admin')
                ->pause(1000)
                ->click('@buscador')
                ->type('@buscador', 'samsung1')
                ->pause(1000)

                ->assertSee('samsung1')
                ->screenshot('/admin')
                ->assertDontSee('samsung2');
        });
    }




    public function testcrearproducto()
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
                ->visit('/admin/products/create')
                ->pause(1000)
                ->assertSee('Complete los datos para crear un producto')
                ->click('@categorias')
                ->click('@categorias-id-1')
                ->click('@subcategorias')
                ->click('@subcategorias-id-1')
                ->click('@marca')
                ->click('@marca-id-1')
                ->click('@nombre')
                ->type('@nombre', 'cisco2004')
                /*->click('@descripcion')
                ->type('@descripcion', 'cisco2004')*/
                ->click('@precio')
                ->type('@precio', '20')
                ->click('@crear')
                ->pause(1000)


                ->screenshot('/admin/products/create');
        });
    }







    public function testeditarproducto()
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
                ->pause(1000)
                ->visit('/admin')
                ->click('@editar')
                ->pause(1000)
                ->click('@nombre')
                ->type('@nombre', 'cisco2004')
                ->click('@actualizar')
                ->pause(1000)
                ->click('@productos')
                ->pause(1000)
                ->pause(1000)
                ->pause(1000)
                ->pause(1000)
                ->visit('/admin')
                ->pause(1000)
                ->pause(1000)
                ->assertSee('cisco2004')
                ->screenshot('/admin')
                
                
                
                
                ;
        });
    }
}
