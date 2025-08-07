<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSelection;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data = [];

        // Statistik jumlah pemilihan desain
        $designs = [
            'resurge_2025',
            'no_mercy',
            'flower_of_snake',
            'gordon',
            'wing_of_love',
            'nemesis',
            'make_money_not_girlfriend',
            'born_to_die',
            'bloomrage',
            'samurai',
        ];

        $designCounts = [];
        foreach ($designs as $design) {
            $designCounts[$design] = UserSelection::where($design, true)->count();
        }

        // Statistik ukuran baju
        $shirtSizes = UserSelection::selectRaw('shirt_size, COUNT(*) as total')
            ->groupBy('shirt_size')
            ->pluck('total', 'shirt_size');

        // Statistik tipe baju
        $shirtTypes = UserSelection::selectRaw('shirt_type, COUNT(*) as total')
            ->groupBy('shirt_type')
            ->pluck('total', 'shirt_type');

        // Statistik kategori desain
        $designCategories = UserSelection::selectRaw('design_category, COUNT(*) as total')
            ->groupBy('design_category')
            ->pluck('total', 'design_category');

        // Umur dari tahun lahir
        $birthYears = UserSelection::selectRaw('birth_year, COUNT(*) as total')
            ->groupBy('birth_year')
            ->pluck('total', 'birth_year');

        $user_selections = UserSelection::get();

        return view('front-view.dashboard.index', compact(
            'designCounts',
            'shirtSizes',
            'shirtTypes',
            'designCategories',
            'birthYears',
            'user_selections'
        ));
    }
}
