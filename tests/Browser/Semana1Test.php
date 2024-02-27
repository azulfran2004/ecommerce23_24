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

class Semana1Test extends DuskTestCase
{
    use DatabaseMigrations;
    public function testvercategorias()
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
                'category_id' => $categories[1]->id,
                'name' => 'TV y audio',
                'slug' => Str::slug('TV y audio'),
            ],
            [
                'category_id' => $categories[1]->id,
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
        foreach ($subcategoryes as $subcategory) {
            $products[] = Product::factory(2)->create(['subcategory_id' => $subcategory->id,]);
        }


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
                ->clickLink('Categorías')
                ->assertSee('Celulares y tablets', 'TV, audio y video', 'Consola y videojuegos', 'Computación', 'Moda');
        });
    }





    public function testversubcategorias()
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
                'category_id' => $categories[1]->id,
                'name' => 'TV y audio',
                'slug' => Str::slug('TV y audio'),
            ],
            [
                'category_id' => $categories[1]->id,
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
        foreach ($subcategoryes as $subcategory) {
            $products[] = Product::factory(2)->create(['subcategory_id' => $subcategory->id,]);
        }


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
                ->clickLink('Categorías')
                ->assertSee('Celulares y tablets', 'TV, audio y video', 'Consola y videojuegos', 'Computación', 'Moda')
                ->mouseover('.navigation-link')
                ->assertSee(
                    'Celulares y smartphones',
                    'Accesorios para celulares',
                    'Smartwatches'
                );
        });
    }
}
