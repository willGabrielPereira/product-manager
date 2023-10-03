<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'William Gabriel Pereira',
            'email' => 'will.gabriel.pereira@gmail.com',
            'password' => '123456789',
        ]);

        $category = \App\Models\Category::create([
            'description' => 'Gourmet',
        ]);

        $subcategory = \App\Models\Category::create([
            'description' => 'Arabica',
            'parent_id' => $category->id,
        ]);

        $product = \App\Models\Product::create([
            'title' => 'AromaFino - Café em Grão',
            'price' => '45.90',
            'amount' => '1000',
            'content' => 
                '<h1>AromaFino - Café em Grão</h1>
                <p><b>AromaFino - Café em Grão</b> é um produto excepcionalmente selecionado para proporcionar uma experiência de café premium aos amantes dessa bebida. 
                Nossos grãos de café Arábica são cuidadosamente cultivados em regiões de altitudes elevadas, onde as condições climáticas ideais e o terroir único conferem a eles um sabor e aroma excepcionais.</p>
                <p>Cada grão é colhido no ponto de maturação perfeito e passa por um processo de torra artesanal, garantindo que seus sabores naturais sejam preservados e aprimorados. 
                O resultado é uma xícara de café encantadora, com acidez equilibrada, corpo suave e notas delicadas de frutas, flores e chocolate.</p>
                <p>AromaFino - Café em Grão é projetado para atender aos paladares mais exigentes, proporcionando uma experiência sensorial refinada a cada gole. 
                Seja você um apreciador de café ou um entusiasta da cultura cafeeira, nosso produto certamente irá satisfazer seu desejo por uma xícara de café excepcional.</p>
                <p>Desperte seus sentidos e mergulhe no mundo dos sabores sofisticados com <b>AromaFino - Café em Grão.</b></p>'
        ]);
        
        $product = \App\Models\Product::create([
            'title' => 'AromaFino - Café moído',
            'price' => '45.90',
            'amount' => '1000',
            'content' => 
                '<h1>AromaFino - Café moído</h1>
                <p><b>AromaFino - Café moído</b> é um produto excepcionalmente selecionado para proporcionar uma experiência de café premium aos amantes dessa bebida. 
                Nossos grãos de café Arábica são cuidadosamente cultivados em regiões de altitudes elevadas, onde as condições climáticas ideais e o terroir único conferem a eles um sabor e aroma excepcionais.</p>
                <p>Cada grão é colhido no ponto de maturação perfeito e passa por um processo de torra artesanal, garantindo que seus sabores naturais sejam preservados e aprimorados. 
                O resultado é uma xícara de café encantadora, com acidez equilibrada, corpo suave e notas delicadas de frutas, flores e chocolate.</p>
                <p>AromaFino - Café moído é projetado para atender aos paladares mais exigentes, proporcionando uma experiência sensorial refinada a cada gole. 
                Seja você um apreciador de café ou um entusiasta da cultura cafeeira, nosso produto certamente irá satisfazer seu desejo por uma xícara de café excepcional.</p>
                <p>Desperte seus sentidos e mergulhe no mundo dos sabores sofisticados com <b>AromaFino - Café moído.</b></p>'
        ]);

        $product->categories()->attach($subcategory->id);
    }
}
