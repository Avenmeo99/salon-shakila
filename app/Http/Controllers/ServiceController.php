<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        // tampil sederhana & tahan error
        $singles  = Service::query()->orderBy('name')->get();
        $packages = collect(); // bisa diisi nanti jika fitur paket aktif

        return view('services.index', [
            'packages' => $packages,
            'singles'  => $singles,
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
