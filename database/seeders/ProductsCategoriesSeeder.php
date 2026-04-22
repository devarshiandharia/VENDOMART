<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductsCategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Gaming Controller' => ['icon' => 'fa-gamepad', 'image' => 'https://images.unsplash.com/photo-1600080972464-8e5f35f63d08?auto=format&fit=crop&w=800&q=80'],
            'Gaming Mouse' => ['icon' => 'fa-computer-mouse', 'image' => 'https://images.unsplash.com/photo-1612287230202-1ff1d85d1bdf?auto=format&fit=crop&w=800&q=80'],
            'Gaming KeyBoard' => ['icon' => 'fa-keyboard', 'image' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?auto=format&fit=crop&w=800&q=80'],
            'VR Set' => ['icon' => 'fa-vr-cardboard', 'image' => 'https://images.unsplash.com/photo-1622979135225-d2ba269cf2fa?auto=format&fit=crop&w=800&q=80'],
            'PLAYSTATIONS' => ['icon' => 'fa-playstation', 'image' => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?auto=format&fit=crop&w=800&q=80'],
        ];

        foreach ($categories as $catName => $data) {
            $category = Category::firstOrCreate([
                'name' => $catName,
            ], [
                'slug' => Str::slug($catName),
                'icon' => $data['icon']
            ]);

            // Download image locally to public/products
            $imageName = Str::slug($catName) . '-' . time() . '.jpg';
            $imagePath = public_path('products/' . $imageName);
            
            // Allow bypassing SSL checks for Unsplash downloads depending on env configurations
            $arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );  

            if (!file_exists($imagePath)) {
                $fileContent = @file_get_contents($data['image'], false, stream_context_create($arrContextOptions));
                if ($fileContent) {
                    file_put_contents($imagePath, $fileContent);
                } else {
                    $imageName = null; // fallback if image cannot be downloaded
                }
            }

            // Create a sample product for this category
            Product::firstOrCreate([
                'name' => 'Elite ' . $catName
            ], [
                'slug' => Str::slug('Elite ' . $catName) . '-' . time(),
                'description' => 'Equip yourself with the ultimate high-performance ' . strtolower($catName) . ' to completely dominate the competition.',
                'price' => rand(5999, 45999),
                'image' => $imageName,
                'category_id' => $category->id
            ]);
        }
    }
}
