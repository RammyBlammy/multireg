<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $citySlug = $request->route('city');
            $city = City::where('slug', $citySlug)->first();

            if ($city) {
                session(['selected_city' => $city->slug]);
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $cities = City::all();
        return view('index', compact('cities'));
    }

    public function about(Request $request)
    {
        // Получаем выбранный город из сессии
        $selectedCity = $request->session()->get('selected_city');

        // Если город выбран, отображаем страницу с выбранным городом
        if ($selectedCity) {
            return view('about', ['city' => $selectedCity]);
        }

        return redirect()->route('index');
    }

    public function news(Request $request)
    {
        $selectedCity = $request->session()->get('selected_city');

        if ($selectedCity) {
            return view('news', ['city' => $selectedCity]);
        }

        return redirect()->route('index');
    }

    public function redirectToCity($name, Request $request)
    {
        $selectedCity = City::where('slug', $name)->first();

        if ($selectedCity) {
            $request->session()->put('selected_city', $name);
        }

        return redirect()->route('index');
    }
}
