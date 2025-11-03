<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
<<<<<<< HEAD
        // tampil sederhana & tahan error
        $singles  = Service::query()->orderBy('name')->get();
        $packages = collect(); // bisa diisi nanti jika fitur paket aktif
=======
        $all = Service::query()->orderBy('name')->get();

        $packages = $all->filter(function ($s) {
            $nm = mb_strtolower($s->name ?? '');
            return str_contains($nm, 'paket') || str_contains($nm, 'promo');
        });
        if ($packages->count() < 3) {
            $packages = $all->sortBy('price')->take(3);
        } else {
            $packages = $packages->take(3);
        }
>>>>>>> 198812f (First commit - upload salon_shakila project)

        return view('services.index', [
            'singles'  => $all,
            'packages' => $packages,
<<<<<<< HEAD
            'singles'  => $singles,
=======
>>>>>>> 198812f (First commit - upload salon_shakila project)
        ]);
    }

    public function show(string $slug): View
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        return view('services.show', [
            'service' => $service,
        ]);
    }
}
