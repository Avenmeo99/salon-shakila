<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        // tampilkan semua layanan aktif sebagai "singles"
        $singles  = Service::active()->orderBy('name')->get();
        $packages = collect(); // kosong dulu (belum ada fitur paket)

        return view('services.index', [
            'packages' => $packages,
            'singles'  => $singles,
        ]);
    }

    public function show(string $slug): View
    {
        $service = Service::active()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('services.show', [
            'service' => $service,
        ]);
    }
}
