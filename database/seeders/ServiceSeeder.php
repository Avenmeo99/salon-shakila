<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        $singlesData = [
            [
                'name' => 'Hair Spa Organik',
                'type' => 'single',
                'price' => 150000,
                'duration_minutes' => 75,
                'description' => 'Spa rambut dengan bahan organik untuk menguatkan akar dan menutrisi batang rambut.',
            ],
            [
                'name' => 'Cuci & Blow Premium',
                'type' => 'single',
                'price' => 75000,
                'duration_minutes' => 45,
                'description' => 'Perawatan rambut lengkap mulai dari cuci, masker ringan, hingga blow styling sesuai keinginan.',
            ],
        ];

        $singles = collect($singlesData)->mapWithKeys(function (array $data) {
            $slug = Str::slug($data['name']);

            $service = Service::updateOrCreate(
                ['slug' => $slug],
                array_merge($data, [
                    'slug' => $slug,
                    'is_active' => true,
                ])
            );

            return [$slug => $service];
        });

        $packageSlug = 'paket-glow-up-weekend';

        $package = Service::updateOrCreate(
            ['slug' => $packageSlug],
            [
                'name' => 'Paket Glow Up Weekend',
                'slug' => $packageSlug,
                'type' => 'package',
                'price' => 225000,
                'duration_minutes' => 150,
                'description' => 'Kombinasi hair spa, styling, dan perawatan lain untuk tampilan maksimal di akhir pekan.',
                'is_active' => true,
            ]
        );

        $package->packageItems()->sync(
            $singles->mapWithKeys(fn (Service $service) => [
                $service->id => ['qty' => 1],
            ])->all()
        );
=======
        $items = [
            ['Cuci & Blow Premium',       'Cuci rambut & blow kering.',                      75000],
            ['Hair Spa Organik',          'Perawatan rambut bahan alami.',                   150000],
            ['Paket Glow Up Weekend',     'Perawatan lengkap akhir pekan.',                  310000],
            ['Hair Mask Keratin',         'Masker rambut untuk kilau sehat.',                180000],
            ['Creambath Aloe Vera',       'Creambath menyehatkan kulit kepala.',             120000],
            ['Hand & Foot Spa',           'Perawatan tangan dan kaki untuk relaksasi.',      130000],
            ['Makeup Natural Event',      'Riasan natural untuk acara spesial.',             200000],
            ['Hair Coloring Single Tone', 'Pewarnaan rambut satu warna.',                    350000],
            ['Smoothing Light',           'Smoothing ringan untuk rambut halus.',            400000],
            // promo
            ['Paket Hemat Cantik 1',      'Cuci & Blow + Hair Spa Organik.',                 210000],
            ['Paket Hemat Cantik 2',      'Creambath + Hand & Foot Spa.',                    230000],
            ['Paket Premium Glow',        'Glow Up + Makeup Natural Event.',                 480000],
        ];

        foreach ($items as [$name, $desc, $price]) {
            Service::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name'        => $name,
                    'description' => $desc,
                    'price'       => $price,
                    'image_url'   => 'images/salon1.jpg', // satu gambar untuk semua
                ]
            );
        }
>>>>>>> 198812f (First commit - upload salon_shakila project)
    }
}
