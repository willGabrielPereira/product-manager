<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

class RouteController extends Controller
{
    public function __invoke() {
        $routes = collect(Route::getRoutes())->filter(function ($route) {
            return !\Str::startsWith($route->getName(), ['ignition', 'sanctum']); // Removendo rotas privadas
        })->map(function ($route) {
            return [
                'name' => $route->getName(),
                'uri' => $route->uri(),
                'methods' => $route->methods(),
                'domain' => $route->domain(),
            ];
        })->values(); // Chamando values para reindexar e retornar um array ao invés de objeto

        return response()->json([
            'routes' => $routes,
        ]);
    }
}
