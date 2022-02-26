<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('users')->delete();
        DB::table('categorias')->delete();
        DB::table('libros')->delete();
        DB::table('prestamos')->delete();
        DB::table('role')->delete();

        $difCats = [ 'Clásicos', 'Comics', 'Detectives y Misterio',
            'Fantasía', 'Histórico', 'Ciencia Ficción', 'Horror', 'Literatura'];
        for($i=1;$i<=sizeof($difCats);$i++){
            DB::table('categorias')->insert([
                'id' => $i,
                'nombre' => $difCats[$i-1],
            ]);
            for($j=0;$j<rand(2,3);$j++){
                DB::table('libros')->insert([
                    'ISBN' =>$faker->regexify('[0-9]{13}'),
                    //'imagen'=>$faker->image('public/storage/images',640,480, null, false),
                    'imagen'=>"cover.jpg",
                    'nombre' =>$faker->sentence(rand(1,3)),
                    'autor' =>$faker->firstName()." ".$faker->lastName(),
                    'editorial' =>$faker->sentence(rand(2,7)),
                    'numEjemplaresDisp'=>$faker->numberBetween(15,30),
                    'categoriaId' =>$i,
                ]);

            }
        }

        DB::table('role')->insert([
            'name' => 'admin',
            'description' =>Hash::make('123'),
        ]);
        DB::table('role')->insert([
            'name' => 'usuario',
            'description' =>Hash::make('123'),
        ]);

        $rol = 1;
        $rol2 = 2;
        DB::table('users')->insert([
            'username' => 'Joel',
            'password' =>Hash::make('123'),
            'name' => 'Medina Ferraz',
            'email' => 'joel.merraz@gmail.com',
            'role_id' => $rol,
        ]);
        $idPrestamo=0;
        for($i=0;$i<4;$i++){
            $username=$faker->firstName();
            DB::table('users')->insert([
                'username' =>$username ,
                'password' =>Hash::make('123'),
                'name' => $faker->lastName(),
                'email' => $faker->email(),
                'role_id' => $rol2,
            ]);
            $libTot=DB::table('libros')->pluck('id');
            $usTot=DB::table('users')->pluck('id');

            for($j=0;$j<rand(0,1);$j++){
                $idPrestamo++;
                $booky =$libTot[rand(0,1)];
                $usery =$i+1;
                //$booky =$libTot[rand(0,2)];
                //$usery =$i+1;
                $fechaSacado = $faker->dateTimeBetween('-2 week', '-2 days');
                $fechaDevolucion = $faker->dateTimeBetween('-2 week','+8 days');
                $fechaEsperada = $faker->dateTimeBetween('+0 days', '+0 days');
                DB::table('prestamos')->insert([
                    'codLibro' =>$booky,
                    'idUsuario' =>$usery,
                    'fechaSacado'=>$fechaSacado,
                    'fechaDevolucion'=> $fechaDevolucion,
                    'fechaEsperada'=>$fechaEsperada,
                ]);

                if ($fechaDevolucion>$fechaEsperada){

                    $X = date_diff($fechaEsperada, $fechaDevolucion);
                    DB::table('sanciones')->insert([
                        'codLibro' =>$booky,
                        'idUsuario' =>$usery,
                        'idPrestamo' =>$idPrestamo,
                        'finPenalizacion'=>$X->format('%d día/s'),
                        'observacion'=>'Te has pasado ' .$X->format('%d día/s %h Hora/s').'.',
                    ]);
                }
            }


        }




    }

}
