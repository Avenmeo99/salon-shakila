<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $packages = Service::active()->where('type', 'package')->with('packageItems.item')->orderBy('name')->get();
        $singles = Service::active()->where('type', 'single')->orderBy('name')->get();

        return view('services.index', [
            'packages' => $packages,
            'singles' => $singles,
        ]);
    }

    public function show(string $slug): View
    {
        $service = Service::active()
            ->where('slug', $slug)
            ->with('packageItems.item')
            ->firstOrFail();

        return view('services.show', [
            'service' => $service,
        ]);
    }
}
