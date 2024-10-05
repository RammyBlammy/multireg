<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        // Возвращаем все города из базы данных
        return City::all();
    }

    // Метод для добавления города
    public function add(Request $request)
    {
        // Валидация входящих данных
        $request->validate([
            'id' => 'required|integer|unique:cities,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:cities,slug',
        ]);

        // Создаем новый город
        $city = City::create([
            'id' => $request->id,
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return response()->json($city, 201); // Возвращаем созданный город с статусом 201
    }

    // Метод для удаления города
    public function delete($id)
    {
        $city = City::find($id);

        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        $city->delete();

        return response()->json(['message' => 'City deleted'], 200);
    }
}
