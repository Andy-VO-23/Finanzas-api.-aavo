<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogoCategoriasSeeder extends Seeder
{
    /**
     * Seed the system categories and their subcategories.
     */
    public function run(): void
    {
        $catalogo = [
            'ingreso' => [
                'Empleo' => [],
                'Freelance / Proyecto' => [],
                'Negocio Propio' => [],
                'Inversión / Dividendos' => [],
                'Bono / Extra' => [],
                'Otro Ingreso' => [],
            ],
            'egreso' => [
                'Vivienda' => ['Alquiler', 'Agua', 'Luz', 'Internet'],
                'Educación' => ['Universidad', 'Cursos', 'Libros'],
                'Alimentación' => ['Supermercado', 'Restaurante', 'Almuerzo'],
                'Transporte' => ['Gasolina', 'Bus', 'Taxi / Uber', 'Parqueo'],
                'Salud' => ['Consulta', 'Medicamentos', 'Laboratorio'],
                'Ocio / Entretenimiento' => ['Suscripciones', 'Cine', 'Salidas'],
                'Deporte' => ['Gimnasio', 'Equipo deportivo'],
                'Imprevistos' => ['Emergencias', 'Reparaciones'],
                'Otro Egreso' => [],
            ],
        ];

        foreach ($catalogo as $tipo => $categorias) {
            foreach ($categorias as $nombre => $subcategorias) {
                $categoria = Categoria::query()->firstOrCreate([
                    'user_id' => null,
                    'nombre' => $nombre,
                    'tipo' => $tipo,
                ]);

                foreach ($subcategorias as $nombreSubcategoria) {
                    DB::table('subcategorias')->insertOrIgnore([
                        'categoria_id' => $categoria->id,
                        'nombre' => $nombreSubcategoria,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
