<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert(
            [
                [
                    'category_name'=> 'Action',
                    'description'=> 'Film yang menceritakan perjuangan seekor singa dalam melawan para manusia yang ingin menguasai hutan rimba',
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ],

              [
                    'category_name'=> 'Comedy',
                    'description'=> 'Film yang mengambarkan kehidupan pak dadang selama masa penjajahan',
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ],

                [
                    'category_name'=> 'Drama',
                    'description'=> 'Film yang mengungkapkan rahasia dodon mengapa dia menghilang dihari pernikahannya',
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ],

                [
                    'category_name'=> 'Sci-Fi',
                    'description'=> 'Film dengan latar belakang ilmiah dan teknologi futuristik',
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ],

                [
                    'category_name'=> 'Romance',
                    'description'=> 'Film mengambarkan kata kata yang memuakkan',
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ],


            ]
            );
    }
}
