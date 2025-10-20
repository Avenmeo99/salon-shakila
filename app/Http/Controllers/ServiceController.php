<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $packages = Service::active()
            ->packages()
            ->with([
                'packageItems' => fn ($query) => $query->active()->orderBy('name'),
            ])
            ->orderBy('name')
            ->get();

        $singles = Service::active()
            ->singles()
            ->orderBy('name')
            ->get();

        return view('services.index', compact('packages', 'singles'));
    }

    public function show(string $slug): View
    {
        $service = Service::active()
            ->where('slug', $slug)
            ->with([
                'packageItems' => fn ($query) => $query->active()->orderBy('name'),
            ])
            ->firstOrFail();

        return view('services.show', compact('service'));
    }
}
