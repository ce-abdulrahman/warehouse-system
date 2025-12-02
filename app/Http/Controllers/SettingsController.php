<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;


class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        return view('settings.index', [
            'system_name'  => setting('system_name'),
            'system_logo'  => setting('system_logo'),
            'currency'     => setting('currency'),
            'currency_dir' => setting('currency_dir'),
            'gui_dir'      => setting('gui_dir'),
            'theme'        => setting('theme'),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'system_name'  => 'required|string|max:255',
            'currency'     => 'required|string|max:10',
            'currency_dir' => 'required|in:ltr,rtl',
            'gui_dir'      => 'required|in:ltr,rtl',
            'theme'        => 'required|in:light,dark',
            'system_logo'  => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        Setting::setValue('system_name', $request->system_name);
        Setting::setValue('currency', $request->currency);
        Setting::setValue('currency_dir', $request->currency_dir);
        Setting::setValue('gui_dir', $request->gui_dir);
        Setting::setValue('theme', $request->theme);

        // Upload logo
        if ($request->hasFile('system_logo')) {

            // Delete old if exists
            $old = setting('system_logo');
            if ($old && str_contains($old, 'storage/settings/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $old));
            }

            $path = $request->file('system_logo')->store('settings', 'public');
            Setting::setValue('system_logo', '/storage/' . $path);
        }

        cache()->flush();

        return back()->with('success', 'Settings updated successfully!');
    }
}
