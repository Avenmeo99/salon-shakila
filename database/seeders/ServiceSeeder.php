<?php

namespace Database\Seeders;

use App\Models\PackageItem;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $singlesData = [
            [
                'name' => 'Cuci & Blow Premium',
                'type' => 'single',
                'price' => 75000,
                'duration_minutes' => 45,
                'description' => 'Perawatan rambut lengkap mulai dari cuci, masker ringan, hingga blow styling sesuai keinginan.',
            ],
            [
                'name' => 'Hair Spa Organik',
                'type' => 'single',
                'price' => 150000,
                'duration_minutes' => 75,
                'description' => 'Spa rambut dengan bahan organik untuk menguatkan akar dan menutrisi batang rambut.',
            ],
            [
                'name' => 'Manicure & Gel Polish',
                'type' => 'single',
                'price' => 120000,
                'duration_minutes' => 60,
                'description' => 'Perawatan kuku tangan lengkap termasuk shaping, cuticle care, dan aplikasi gel polish tahan lama.',
            ],
        ];

        $singles = collect($singlesData)->mapWithKeys(function ($data) {
            $service = Service::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                array_merge($data, ['is_active' => true])
            );

            return [$service->slug => $service];
        });

        $package = Service::updateOrCreate(
            ['slug' => 'paket-glow-up-weekend'],
            [
                'name' => 'Paket Glow Up Weekend',
                'type' => 'package',
                'price' => 310000,
                'duration_minutes' => 150,
                'description' => 'Kombinasi hair spa, styling, dan manicure untuk penampilan maksimal di akhir pekan.',
                'is_active' => true,
            ]
        );

        $package->packageItems()->delete();

        $items = [
            ['service' => 'cuci-blow-premium', 'qty' => 1],
            ['service' => 'hair-spa-organik', 'qty' => 1],
            ['service' => 'manicure-gel-polish', 'qty' => 1],
        ];

        foreach ($items as $item) {
            $service = $singles->get($item['service']);

            if ($service) {
                PackageItem::create([
                    'package_id' => $package->id,
                    'item_service_id' => $service->id,
                    'qty' => $item['qty'],
                ]);
            }
        }
    }
}
