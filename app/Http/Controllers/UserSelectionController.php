<?php

namespace App\Http\Controllers;

use App\Models\UserSelection;
use Illuminate\Http\Request;

class UserSelectionController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Daftar field boolean
            $designFields = [
                'resurge_2025', 'no_mercy', 'flower_of_snake', 'gordon',
                'wing_of_love', 'nemesis', 'make_money_not_girlfriend',
                'born_to_die', 'bloomrage', 'samurai'
            ];

            // Konversi 'true'/'false' string ke boolean sebelum validasi
            $converted = $request->all();
            foreach ($designFields as $field) {
                $converted[$field] = filter_var($request->input($field), FILTER_VALIDATE_BOOLEAN);
            }

            // Validasi menggunakan data yang sudah dikonversi
            $validated = validator($converted, [
                'name' => 'required|string|max:255',
                'birth_year' => 'required|integer|between:1970,2025',
                'shirt_type' => 'required|string',
                'shirt_size' => 'required|string',
                'design_category' => 'nullable|string',

                // Desain pilihan boolean
                'resurge_2025' => 'nullable|boolean',
                'no_mercy' => 'nullable|boolean',
                'flower_of_snake' => 'nullable|boolean',
                'gordon' => 'nullable|boolean',
                'wing_of_love' => 'nullable|boolean',
                'nemesis' => 'nullable|boolean',
                'make_money_not_girlfriend' => 'nullable|boolean',
                'born_to_die' => 'nullable|boolean',
                'bloomrage' => 'nullable|boolean',
                'samurai' => 'nullable|boolean',
            ])->validate();

            // Set default false jika tidak dikirim
            foreach ($designFields as $field) {
                $validated[$field] = $validated[$field] ?? false;
            }

            // Simpan ke database
            UserSelection::create($validated);

            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.')
                ->withInput();
        }
    }

}
