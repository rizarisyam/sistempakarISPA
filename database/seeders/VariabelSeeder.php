<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VariabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variabel = ["demam", "batuk", "mengigil", "pilek", "nyeri atau sakit tenggorakan", "tenggorakan kering", "gatal pada langit-langit rahang dan gigi", "suara serak/tidak jelas", "nafas bau", "sakit kepala/pusing", "sakit telinga", "lesu, lemas, lelah dan malas", "kehilangan nafsu makan", "mual", "muntah", "diare"];

        foreach ($variabel as $row) {
            \App\Models\Variabel::create([
                'nama' => $row
            ]);
        }
    }
}
