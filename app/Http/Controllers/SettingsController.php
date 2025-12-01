<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        // Get Timezones list for the dropdown
        $timezones = \DateTimeZone::listIdentifiers();
        return view('settings.index', compact('timezones'));
    }

    public function update(Request $request)
    {
        $input = $request->except(['_token', 'logo']);

        // 1. Loop through text inputs and update DB
        foreach ($input as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 2. Handle Logo Upload separately
        if ($request->hasFile('logo')) {
            $request->validate(['logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);

            // Delete old logo if exists
            $oldLogo = Setting::getValue('logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            // Store new logo
            $path = $request->file('logo')->store('uploads/settings', 'public');
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $path]);
        }

        return redirect()->back()->with('success', 'System settings updated successfully.');
    }
}
