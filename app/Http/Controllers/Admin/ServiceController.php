<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(12);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:services,slug',
            'type'              => 'required|in:single,package',
            'price'             => 'nullable|numeric|min:0',
            'duration_minutes'  => 'required|integer|min:0',
            'description'       => 'nullable|string',
            'is_active'         => 'required|boolean',
            'image_url'         => 'nullable|string|max:255',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dibuat.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:services,slug,' . $service->id,
            'type'              => 'required|in:single,package',
            'price'             => 'nullable|numeric|min:0',
            'duration_minutes'  => 'required|integer|min:0',
            'description'       => 'nullable|string',
            'is_active'         => 'required|boolean',
            'image_url'         => 'nullable|string|max:255',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Layanan dihapus.');
    }
}
