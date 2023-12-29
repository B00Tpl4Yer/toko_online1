<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\stok;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class productseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Define an array of phone types
        $phone_types = ['Samsung Galaxy S23', 'iPhone 14', 'Huawei P40', 'Oppo Reno 5', 'Xiaomi Mi 11', 'Nokia 8.3', 'Sony Xperia 5', 'Vivo x70', 'OnePlus 9', 'Infinix hot 30'];

        // Define an array of image paths
        $image_paths = ['asset/img/samsung.jpeg', 'asset/img/iphone.jpeg', 'asset/img/huawei.jpeg', 'asset/img/oppo.jpeg', 'asset/img/xiaomi.jpeg', 'asset/img/nokia.png', 'asset/img/sony.jpg', 'asset/img/vivo.jpg', 'asset/img/oneplus.png', 'asset/img/infinix.jpg'];

        for ($i = 0; $i < 100; $i++) {
            // Use the modulus operator to cycle through the phone types and image paths
            $nama_produk = $phone_types[$i % 10];
            $slug = Str::slug($nama_produk);

while (stok::where('slug', $slug)->exists()) {
  $slug = Str::slug($nama_produk) . '-' . Str::random(5);
}
            $foto = $image_paths[$i % 10];

            stok::create([
                'nama_produk' => $nama_produk,
                'harga_produk' => $faker->numberBetween(10, 1000),
                'informasi_produk' => $faker->sentence,
                'deskripsi_produk' => $faker->paragraph,
                'foto' => $foto, // use the image path corresponding to the phone type
                'jumlah_produk' => $faker->numberBetween(1, 100),
                'slug' => $slug,
            ]);
        }
    }
}
