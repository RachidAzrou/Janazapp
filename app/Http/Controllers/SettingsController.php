<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingsRequest;
use App\Models\Settings;

class SettingsController extends Controller
{
    public function index()
    {
        return Settings::all();
    }

    public function store(StoreSettingsRequest $request)
    {
        $setting = Settings::create($request->validated());
        return response()->json($setting, 201);
    }

    public function show(Settings $setting)
    {
        return $setting;
    }

    public function update(StoreSettingsRequest $request, Settings $setting)
    {
        $setting->update($request->validated());
        return response()->json($setting, 200);
    }

    public function destroy(Settings $setting)
    {
        $setting->delete();
        return response()->noContent();
    }
}
