<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
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
    }
}
