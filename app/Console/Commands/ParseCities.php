<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ParseCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Парсинг городов из API hh.ru и сохранение в базу данных';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Запрос к API
        $response = Http::withOptions(['verify' => false])->get('https://api.hh.ru/areas');

        if ($response->successful()) {
            $areas = $response->json();
            // // Фильтрация только городов России
            foreach ($areas as $area) {
                if ($area['name'] === 'Россия') {
                    foreach ($area['areas'] as $oblast) {
                        if (empty($oblast['areas'])) { //москва или питер
                            City::updateOrCreate(
                                [
                                    'id' => $oblast['id'], // Используем id из API
                                    'name' => $oblast['name'],
                                    'slug' => Str::slug($oblast['name'], '-')
                                ]
                            );
                            continue;
                        }

                        foreach ($oblast['areas'] as $city) {
                            City::updateOrCreate(
                                [
                                    'id' => $city['id'], // Используем id из API
                                    'name' => $city['name'],
                                    'slug' => Str::slug($city['name'], '-')
                                ]
                            );
                        }
                    }
                }
            }
            $this->info('Города успешно загружены в базу данных.');
        } else {
            $this->error('Ошибка при запросе к API.');
        }
    }
}
