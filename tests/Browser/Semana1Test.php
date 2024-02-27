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
use Tests\Traits\CreateData;

class Semana1Test extends DuskTestCase
{
    use DatabaseMigrations, CreateData;

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

        $categories = $this->createCategories($categoriesData);

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

        ];

        $subcategories = $this->createSubcategories($subcategoriesData, $categories);

        $brandNames = ['Samsung', 'Samsung2', 'Samsung3', 'Samsung4', 'Samsung5'];
        $this->createBrands($brandNames, $categories);

        $products = $this->createProducts($subcategories);


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

        $categories = $this->createCategories($categoriesData);

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

        ];

        $subcategories = $this->createSubcategories($subcategoriesData, $categories);

        $brandNames = ['Samsung', 'Samsung2', 'Samsung3', 'Samsung4', 'Samsung5'];
        $this->createBrands($brandNames, $categories);

        $products = $this->createProducts($subcategories);


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
