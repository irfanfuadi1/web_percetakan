<?php

namespace App\Http\Controllers;

use App\Models\StoreSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreSettingController extends Controller
{
    public function index()
    {
        $setting = StoreSetting::first();

        if (!$setting) {
            $setting = StoreSetting::create([
                'store_name' => 'Gemiprint',
                'receipt_paper_size' => '80mm',
            ]);
        }

        return view('settings.index', compact('setting'));
    }


    public function update(Request $request)
    {
        $validated = $request->validate([
            'store_name' => [
                'required',
                'string',
                'max:150',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'receipt_logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],

            'receipt_paper_size' => [
                'required',
                'in:80mm,58mm',
            ],

            'receipt_footer' => [
                'nullable',
                'string',
            ],
        ]);


        $setting = StoreSetting::first();

        if (!$setting) {
            $setting = new StoreSetting();
        }


        /*
        |--------------------------------------------------------------------------
        | Upload Logo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('receipt_logo')) {

            if (
                $setting->receipt_logo &&
                Storage::disk('public')->exists($setting->receipt_logo)
            ) {
                Storage::disk('public')->delete(
                    $setting->receipt_logo
                );
            }


            $validated['receipt_logo'] =
                $request->file('receipt_logo')
                    ->store('store-settings', 'public');
        }


        $setting->fill($validated);

        $setting->save();


        return redirect()
            ->route('settings.index')
            ->with(
                'success',
                'Pengaturan toko berhasil disimpan.'
            );
    }
}