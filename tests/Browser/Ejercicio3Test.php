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

class Ejercicio3Test extends DuskTestCase
{
    use DatabaseMigrations;
    public function testejercicio3()
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
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[1]->id, 'name' => 'samsung1', 'price' => '40']);
        $products[] = Product::factory()->create(['subcategory_id' => $subcategoryes[2]->id, 'name' => 'samsung2', 'price' => '50']);





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
                ->press('+')
                ->press('+')
                ->press('+')
                ->press('@carrito')
                ->pause(1000)
                ->assertSee('1')
                ->visit('/products/' . $products[1]->slug)
                ->assertSee('samsung1')
                ->click('@selectColor')
                ->click('@selectColor-id-1')
                ->click('@selectColor')
                ->press('+')
                ->press('@carrito')
                ->pause(1000)
                ->visit('/products/' . $products[2]->slug)
                ->pause(1000)
                ->assertSee('samsung2')
                ->press('@carrito')
                ->pause(1000)
                ->screenshot('/products/' . $products[2]->slug)
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
                ->screenshot('/orders/create')
                ->visit('/shopping-cart')
                ->pause(1000)
                ->pause(1000)
                ->screenshot('/shopping-cart')
                ->assertSee('samsung')
                ->assertSee('4')
                ->assertSee('2')
                ->assertSee('1')
                ->assertSee('samsung2')
                ->assertSee('120')
                ->assertSee('80')
                ->assertSee('50');
        });
    }
}
