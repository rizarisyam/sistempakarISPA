<?php

namespace App\Services;

use App\Models\Aturan;
use App\Models\Keputusan;
use App\Models\Konsultasi;
use App\Models\User;
use App\Models\Variabel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class KonsultasiService
{
    public function handleStore($data)
    {
        if (Auth::check()) {
            $userID = Auth::id();
            $fieldNama = null;
        } else {
            $userID = null;
            $fieldNama = $data['nama'];
        }
        $konsultasi = Konsultasi::create([
            'user_id' => $userID,
            'nama' => $fieldNama,
        ]);

        return $konsultasi;
    }

    public function fuzzyfikasi()
    {
        // BUG
        // return "efdfdf";
        $variabel = Variabel::with('himpunan')->get();
        $konsultasi = Konsultasi::with('variabel')->where('user_id', auth()->id())->latest()->first();

        // dd($konsultasi);

        $fuzzyUser = [];
        foreach ($konsultasi->variabel as $key => $value) {
            array_push($fuzzyUser, json_decode($value->pivot->nilai));
        }

        $fuzzyhimpunan = [];
        foreach ($variabel as $key => $value) {
            foreach ($value->himpunan as $key => $value) {
                // dump(json_decode($value->domain));
                array_push($fuzzyhimpunan, json_decode($value->domain));
            }
        }
        $fuzzyhimpunan = array_chunk($fuzzyhimpunan, 2);


        $fuzzy1 = [];
        $fuzzy2 = [];
        foreach ($fuzzyUser as $key => $value) {

            if (is_null($value)) {
                $value += 0;
            }

            // dd($fuzzyhimpunan[$key][0]);


            if ($fuzzyhimpunan[$key][0]) {
                // dump($value);
                // dump($fuzzyhimpunan[$key][0]);
                // if(in_array(M))

                // himpunan 1
                if ($value <= env('MIN')) {
                    unset($fuzzyUser[$key]);
                    array_push($fuzzy1, 1);
                    // dump($value);
                }

                if ($value > env('MIN') && $value < env('MAX')) {
                    unset($fuzzyUser[$key]);
                    $hasil = (env('MAX') - $value) / (env('MAX') - env('MIN'));
                    array_push($fuzzy1, $hasil);
                }

                if ($value >= env('MAX')) {
                    unset($fuzzyUser[$key]);
                    array_push($fuzzy1, 0);
                }
            }

            if ($fuzzyhimpunan[$key][1]) {

                // himpunan 2
                if ($value <= env('MIN')) {
                    unset($fuzzyUser[$key]);
                    array_push($fuzzy2, 0);
                    // dump($value);
                }

                if ($value > env('MIN') && $value < env('MAX')) {
                    unset($fuzzyUser[$key]);
                    $hasil = ($value - env('MIN')) / (env('MAX') - env('MIN'));
                    array_push($fuzzy2, $hasil);
                }

                if ($value >= env('MAX')) {
                    unset($fuzzyUser[$key]);
                    array_push($fuzzy2, 1);
                }
            }
        }



        $fuzzy = [];
        foreach ($fuzzy1 as $key => $h1) {
            array_push($fuzzy, array($h1, $fuzzy2[$key]));
        }

        return $fuzzy;
    }

    public function defuzzyfikasi()
    {
        $aturan = Aturan::with('himpunan')->get();

        $fuzzyfikasi = $this->fuzzyfikasi();
        $rules = array();
        foreach ($aturan as $key => $rule) {

            // dump($rule->kode);



            foreach ($rule->himpunan as $key => $value) {

                if ($rule->kode == 'R01') {

                    if ($value->variabel->kode == 'G05') {
                        if ($value->nama == 'Ringan') {
                            // dump($fuzzyfikasi[4][0]);
                            array_push($rules, array($fuzzyfikasi[4][0]));
                        } else {
                            // dump($fuzzyfikasi[4][1]);
                            array_push($rules, array($fuzzyfikasi[4][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G06') {
                        if ($value->nama == 'Ringan') {
                            // dump($fuzzyfikasi[5][0]);
                            array_push($rules[0], $fuzzyfikasi[5][0]);
                        } else {
                            // dump($fuzzyfikasi[5][1]);
                            array_push($rules[0], array($fuzzyfikasi[5][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G08') {
                        if ($value->nama == "Ringan") {
                            // dump($fuzzyfikasi[7][0]);
                            array_push($rules[0], $fuzzyfikasi[7][0]);
                        } else {
                            // dump($fuzzyfikasi[7][1]);
                            array_push($rules[0], $fuzzyfikasi[7][1]);
                        }
                    }
                }

                if ($rule->kode == 'R02') {
                    if ($value->variabel->kode == 'G01') {
                        if ($value->nama == 'Bertahap') {
                            // dump($fuzzyfikasi[0][0]);
                            array_push($rules, array($fuzzyfikasi[0][0]));
                        } else {
                            // dump($fuzzyfikasi[0][1]);
                            array_push($rules, array($fuzzyfikasi[0][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G11') {
                        if ($value->nama == 'Ringan') {
                            // dump($fuzzyfikasi[10][0]);
                            array_push($rules[1], $fuzzyfikasi[10][0]);
                        } else {
                            // dump($fuzzyfikasi[10][1]);
                            array_push($rules[1], array($fuzzyfikasi[10][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G14') {
                        if ($value->nama == "Bertahap") {
                            // dump($fuzzyfikasi[13][0]);
                            array_push($rules[1], $fuzzyfikasi[13][0]);
                        } else {
                            // dump($fuzzyfikasi[13][1]);
                            array_push($rules[1], $fuzzyfikasi[13][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G15') {
                        if ($value->nama == "Bertahap") {
                            // dump($fuzzyfikasi[14][0]);
                            array_push($rules[1], $fuzzyfikasi[14][0]);
                        } else {
                            // dump($fuzzyfikasi[14][1]);
                            array_push($rules[1], $fuzzyfikasi[14][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G16') {
                        if ($value->nama == "Terjadi") {
                            // dump($fuzzyfikasi[15][0]);
                            array_push($rules[1], $fuzzyfikasi[15][0]);
                        } else {
                            // dump($fuzzyfikasi[15][1]);
                            array_push($rules[1], $fuzzyfikasi[15][1]);
                        }
                    }
                }

                if ($rule->kode == 'R03') {
                    if ($value->variabel->kode == 'G01') {
                        if ($value->nama == 'Bertahap') {
                            // dump($fuzzyfikasi[0][0]);
                            array_push($rules, array($fuzzyfikasi[0][0]));
                        } else {
                            // dump($fuzzyfikasi[0][1]);
                            array_push($rules, array($fuzzyfikasi[0][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G05') {
                        if ($value->nama == 'Ringan') {
                            // dump($fuzzyfikasi[4][0]);
                            array_push($rules[2], $fuzzyfikasi[4][0]);
                        } else {
                            // dump($fuzzyfikasi[4][1]);
                            array_push($rules[2], $fuzzyfikasi[4][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G10') {
                        if ($value->nama == "Ringan") {
                            // dump($fuzzyfikasi[9][0]);
                            array_push($rules[2], $fuzzyfikasi[9][0]);
                        } else {
                            // dump($fuzzyfikasi[9][1]);
                            array_push($rules[2], $fuzzyfikasi[9][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G15') {
                        if ($value->nama == "Bertahap") {
                            // dump($fuzzyfikasi[14][0]);
                            array_push($rules[2], $fuzzyfikasi[14][0]);
                        } else {
                            // dump($fuzzyfikasi[14][1]);
                            array_push($rules[2], $fuzzyfikasi[14][1]);
                        }
                    }
                }

                if ($rule->kode == 'R04') {
                    if ($value->variabel->kode == 'G01') {
                        if ($value->nama == 'Bertahap') {
                            // dump($fuzzyfikasi[][0]);
                            array_push($rules, array($fuzzyfikasi[0][0]));
                        } else {
                            // dump($fuzzyfikasi[0][1]);
                            array_push($rules, array($fuzzyfikasi[0][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G02') {
                        if ($value->nama == 'Ringan') {
                            // dump($fuzzyfikasi[1][0]);
                            array_push($rules[3], $fuzzyfikasi[1][0]);
                        } else {
                            // dump($fuzzyfikasi[1][1]);
                            array_push($rules[3], $fuzzyfikasi[1][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G07') {
                        if ($value->nama == "Terjadi") {
                            // dump($fuzzyfikasi[6][0]);
                            array_push($rules[3], $fuzzyfikasi[6][0]);
                        } else {
                            // dump($fuzzyfikasi[6][1]);
                            array_push($rules[3], $fuzzyfikasi[6][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G09') {
                        if ($value->nama == "Tidak mengganggu") {
                            // dump($fuzzyfikasi[8][0]);
                            array_push($rules[3], $fuzzyfikasi[8][0]);
                        } else {
                            // dump($fuzzyfikasi[8][1]);
                            array_push($rules[3], $fuzzyfikasi[8][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G11') {
                        if ($value->nama == "Ringan") {
                            // dump($fuzzyfikasi[10][0]);
                            array_push($rules[3], $fuzzyfikasi[10][0]);
                        } else {
                            // dump($fuzzyfikasi[10][1]);
                            array_push($rules[3], $fuzzyfikasi[10][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G12') {
                        if ($value->nama == "Terjadi") {
                            // dump($fuzzyfikasi[11][0]);
                            array_push($rules[3], $fuzzyfikasi[11][0]);
                        } else {
                            // dump($fuzzyfikasi[11][1]);
                            array_push($rules[3], $fuzzyfikasi[11][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G14') {
                        if ($value->nama == "Bertahap") {
                            // dump($fuzzyfikasi[13][0]);
                            array_push($rules[3], $fuzzyfikasi[13][0]);
                        } else {
                            // dump($fuzzyfikasi[13][1]);
                            array_push($rules[3], $fuzzyfikasi[13][1]);
                        }
                    }
                }

                if ($rule->kode == 'R05') {
                    if ($value->variabel->kode == 'G02') {
                        if ($value->nama == 'Ringan') {
                            // dump($fuzzyfikasi[1][0]);
                            array_push($rules, array($fuzzyfikasi[1][0]));
                        } else {
                            // dump($fuzzyfikasi[1][1]);
                            array_push($rules, array($fuzzyfikasi[1][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G03') {
                        if ($value->nama == 'Bertahap') {
                            // dump($fuzzyfikasi[2][0]);
                            array_push($rules[4], $fuzzyfikasi[2][0]);
                        } else {
                            // dump($fuzzyfikasi[2][1]);
                            array_push($rules[4], $fuzzyfikasi[2][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G04') {
                        if ($value->nama == "Ringan") {
                            // dump($fuzzyfikasi[3][0]);
                            array_push($rules[4], $fuzzyfikasi[3][0]);
                        } else {
                            // dump($fuzzyfikasi[3][1]);
                            array_push($rules[4], $fuzzyfikasi[3][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G05') {
                        if ($value->nama == "Ringan") {
                            // dump($fuzzyfikasi[4][0]);
                            array_push($rules[4], $fuzzyfikasi[4][0]);
                        } else {
                            // dump($fuzzyfikasi[4][1]);
                            array_push($rules[4], $fuzzyfikasi[4][1]);
                        }
                    }


                    if ($value->variabel->kode == 'G12') {
                        if ($value->nama == "Terjadi") {
                            // dump($fuzzyfikasi[11][0]);
                            array_push($rules[4], $fuzzyfikasi[11][0]);
                        } else {
                            // dump($fuzzyfikasi[11][1]);
                            array_push($rules[4], $fuzzyfikasi[11][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G13') {
                        if ($value->nama == "Bertahap") {
                            // dump($fuzzyfikasi[12][0]);
                            array_push($rules[4], $fuzzyfikasi[12][0]);
                        } else {
                            // dump($fuzzyfikasi[12][1]);
                            array_push($rules[4], $fuzzyfikasi[12][1]);
                        }
                    }
                }

                if ($rule->kode == 'R06') {
                    if ($value->variabel->kode == 'G05') {
                        if ($value->nama == 'Ringan') {
                            array_push($rules, array($fuzzyfikasi[4][0]));
                        } else {
                            array_push($rules, array($fuzzyfikasi[4][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G06') {
                        if ($value->nama == 'Ringan') {
                            array_push($rules[5], $fuzzyfikasi[5][0]);
                        } else {
                            array_push($rules[5], $fuzzyfikasi[5][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G08') {
                        if ($value->nama == "Ringan") {
                            array_push($rules[5], $fuzzyfikasi[7][0]);
                        } else {
                            array_push($rules[5], $fuzzyfikasi[7][1]);
                        }
                    }
                }

                if ($rule->kode == 'R07') {
                    if ($value->variabel->kode == 'G01') {
                        if ($value->nama == 'Bertahap') {
                            array_push($rules, array($fuzzyfikasi[0][0]));
                        } else {
                            array_push($rules, array($fuzzyfikasi[0][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G11') {
                        if ($value->nama == 'Ringan') {
                            array_push($rules[6], $fuzzyfikasi[10][0]);
                        } else {
                            array_push($rules[6], $fuzzyfikasi[10][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G14') {
                        if ($value->nama == "Bertahap") {
                            array_push($rules[6], $fuzzyfikasi[13][0]);
                        } else {
                            array_push($rules[6], $fuzzyfikasi[13][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G15') {
                        if ($value->nama == "Bertahap") {
                            array_push($rules[6], $fuzzyfikasi[14][0]);
                        } else {
                            array_push($rules[6], $fuzzyfikasi[14][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G16') {
                        if ($value->nama == "Terjadi") {
                            array_push($rules[6], $fuzzyfikasi[15][0]);
                        } else {
                            array_push($rules[6], $fuzzyfikasi[15][1]);
                        }
                    }
                }

                if ($rule->kode == 'R08') {
                    if ($value->variabel->kode == 'G02') {
                        if ($value->nama == 'Ringan') {
                            array_push($rules, array($fuzzyfikasi[1][0]));
                        } else {
                            array_push($rules, array($fuzzyfikasi[1][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G03') {
                        if ($value->nama == 'Bertahap') {
                            array_push($rules[7], $fuzzyfikasi[2][0]);
                        } else {
                            array_push($rules[7], $fuzzyfikasi[2][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G04') {
                        if ($value->nama == "Ringan") {
                            array_push($rules[7], $fuzzyfikasi[3][0]);
                        } else {
                            array_push($rules[7], $fuzzyfikasi[3][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G05') {
                        if ($value->nama == "Ringan") {
                            array_push($rules[7], $fuzzyfikasi[4][0]);
                        } else {
                            array_push($rules[7], $fuzzyfikasi[4][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G12') {
                        if ($value->nama == "Terjadi") {
                            array_push($rules[7], $fuzzyfikasi[11][0]);
                        } else {
                            array_push($rules[7], $fuzzyfikasi[11][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G13') {
                        if ($value->nama == "Bertahap") {
                            array_push($rules[7], $fuzzyfikasi[12][0]);
                        } else {
                            array_push($rules[7], $fuzzyfikasi[12][1]);
                        }
                    }
                }

                if ($rule->kode == 'R09') {
                    if ($value->variabel->kode == 'G01') {
                        if ($value->nama == 'Bertahap') {
                            array_push($rules, array($fuzzyfikasi[0][0]));
                        } else {
                            array_push($rules, array($fuzzyfikasi[0][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G05') {
                        if ($value->nama == 'Ringan') {
                            array_push($rules[8], $fuzzyfikasi[4][0]);
                        } else {
                            array_push($rules[8], $fuzzyfikasi[4][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G10') {
                        if ($value->nama == "Ringan") {
                            array_push($rules[8], $fuzzyfikasi[9][0]);
                        } else {
                            array_push($rules[8], $fuzzyfikasi[9][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G15') {
                        if ($value->nama == "Bertahap") {
                            array_push($rules[8], $fuzzyfikasi[14][0]);
                        } else {
                            array_push($rules[8], $fuzzyfikasi[14][1]);
                        }
                    }
                }

                if ($rule->kode == 'R10') {
                    if ($value->variabel->kode == 'G01') {
                        if ($value->nama == 'Bertahap') {
                            array_push($rules, array($fuzzyfikasi[0][0]));
                        } else {
                            array_push($rules, array($fuzzyfikasi[0][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G02') {
                        if ($value->nama == 'Ringan') {
                            array_push($rules[9], $fuzzyfikasi[1][0]);
                        } else {
                            array_push($rules[9], $fuzzyfikasi[1][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G07') {
                        if ($value->nama == "Terjadi") {
                            array_push($rules[9], $fuzzyfikasi[6][0]);
                        } else {
                            array_push($rules[9], $fuzzyfikasi[6][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G09') {
                        if ($value->nama == "Tidak mengganggu") {
                            array_push($rules[9], $fuzzyfikasi[8][0]);
                        } else {
                            array_push($rules[9], $fuzzyfikasi[8][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G11') {
                        if ($value->nama == "Ringan") {
                            array_push($rules[9], $fuzzyfikasi[10][0]);
                        } else {
                            array_push($rules[9], $fuzzyfikasi[10][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G12') {
                        if ($value->nama == "Terjadi") {
                            array_push($rules[9], $fuzzyfikasi[11][0]);
                        } else {
                            array_push($rules[9], $fuzzyfikasi[11][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G14') {
                        if ($value->nama == "Bertahap") {
                            array_push($rules[9], $fuzzyfikasi[13][0]);
                        } else {
                            array_push($rules[9], $fuzzyfikasi[13][1]);
                        }
                    }
                }
            }
        }

        // variabel menampung nilai min setiap rule nya
        $min = array();
        foreach ($rules as $key => $rule) {
            array_push($min, min($rule));
        }

        $atas = 0;
        $bawah = 0;
        $z = 0;
        foreach($min as $key => $row) {

                // dump($row);
                $atas += ($row * $aturan[$key]['CertaintyFactor']);
                $bawah += $row;
                // $cf = $z * $aturan[$key]['CertaintyFactor'];
                // dump($z);
                // dump($aturan[$key]['CertaintyFactor']);
                // dump($key);

        }
        $z = $atas / $bawah;



        // $keputusan = array();
        // $z = 0;
        // $a = 0;
        // $b = 0;
        // $cfRule = array();
        // $rulePass = array();
        // foreach ($aturan as $key => $rule) {
        //     if ($min[$key] > 0) {
        //         array_push($rulePass, $rule->kode);
        //         $a += $min[$key] * $rule->CertaintyFactor;
        //         $b +=  $min[$key];
        //     }

        // }

        // $test = [];
        // foreach($aturan as $key => $row) {
        //     foreach($rulePass as $key => $pass) {

        //         // if ($row->kode == $pass) {
        //         //     $test = $pass;
        //         // }
        //     }
        // }


        // echo number_format($z, 3);


        // foreach ($aturan as $key => $rule) {
        //     array_push($cfRule, $z * $rule->CertaintyFactor);
        // }
        // // dump($cfRule);

        // $cfTotal = array();

        // // foreach($aturan as $key => $rule) {
        // $result1 = (($cfRule[4] + $cfRule[7]) * (1 - $cfRule[4]));
        // array_push($cfTotal, $result1);

        // $result2 = (($cfRule[3] + $cfRule[9]) * (1 - $cfRule[3]));
        // array_push($cfTotal, $result2);

        // $result3 = (($cfRule[2] + $cfRule[8]) * (1 - $cfRule[2]));
        // array_push($cfTotal, $result3);

        // $result4 = (($cfRule[1] + $cfRule[6]) * (1 - $cfRule[1]));
        // array_push($cfTotal, $result4);

        // $result5 = (($cfRule[0] + $cfRule[5]) * (1 - $cfRule[0]));
        // array_push($cfTotal, $result5);
        // }

        // $keputusan = DB::table('keputusan')->get();
        // $maxValue = max($cfTotal);
        // $persentasi = $maxValue * 100;

        // $maxIndex = array_search($maxValue, $cfTotal);
        // dump($cfTotal);
        // dump($maxIndex);
        // foreach($keputusan as $key => $row) {
        //     if ($maxIndex == $key) {
        //         dump("Anda terdiagnosa penyakit " . $row->nama . " " . number_format($persentasi, 2) . "%");
        //         break;
        //     }
        // }
        return (float)number_format($z, 4);
    }

    public function min()
    {
        $aturan = Aturan::with('himpunan')->get();

        $fuzzyfikasi = $this->fuzzyfikasi();
        $rules = array();
        foreach ($aturan as $key => $rule) {


            foreach ($rule->himpunan as $key => $value) {

                if ($rule->kode == 'R01') {

                    if ($value->variabel->kode == 'G05') {
                        if ($value->nama == 'Ringan') {
                            // dump($fuzzyfikasi[4][0]);
                            array_push($rules, array($fuzzyfikasi[4][0]));
                        } else {
                            // dump($fuzzyfikasi[4][1]);
                            array_push($rules, array($fuzzyfikasi[4][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G06') {
                        if ($value->nama == 'Ringan') {
                            // dump($fuzzyfikasi[5][0]);
                            array_push($rules[0], $fuzzyfikasi[5][0]);
                        } else {
                            // dump($fuzzyfikasi[5][1]);
                            array_push($rules[0], array($fuzzyfikasi[5][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G08') {
                        if ($value->nama == "Ringan") {
                            // dump($fuzzyfikasi[7][0]);
                            array_push($rules[0], $fuzzyfikasi[7][0]);
                        } else {
                            // dump($fuzzyfikasi[7][1]);
                            array_push($rules[0], $fuzzyfikasi[7][1]);
                        }
                    }
                }

                if ($rule->kode == 'R02') {
                    if ($value->variabel->kode == 'G01') {
                        if ($value->nama == 'Bertahap') {
                            // dump($fuzzyfikasi[0][0]);
                            array_push($rules, array($fuzzyfikasi[0][0]));
                        } else {
                            // dump($fuzzyfikasi[0][1]);
                            array_push($rules, array($fuzzyfikasi[0][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G11') {
                        if ($value->nama == 'Ringan') {
                            // dump($fuzzyfikasi[10][0]);
                            array_push($rules[1], $fuzzyfikasi[10][0]);
                        } else {
                            // dump($fuzzyfikasi[10][1]);
                            array_push($rules[1], array($fuzzyfikasi[10][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G14') {
                        if ($value->nama == "Bertahap") {
                            // dump($fuzzyfikasi[13][0]);
                            array_push($rules[1], $fuzzyfikasi[13][0]);
                        } else {
                            // dump($fuzzyfikasi[13][1]);
                            array_push($rules[1], $fuzzyfikasi[13][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G15') {
                        if ($value->nama == "Bertahap") {
                            // dump($fuzzyfikasi[14][0]);
                            array_push($rules[1], $fuzzyfikasi[14][0]);
                        } else {
                            // dump($fuzzyfikasi[14][1]);
                            array_push($rules[1], $fuzzyfikasi[14][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G16') {
                        if ($value->nama == "Terjadi") {
                            // dump($fuzzyfikasi[15][0]);
                            array_push($rules[1], $fuzzyfikasi[15][0]);
                        } else {
                            // dump($fuzzyfikasi[15][1]);
                            array_push($rules[1], $fuzzyfikasi[15][1]);
                        }
                    }
                }

                if ($rule->kode == 'R03') {
                    if ($value->variabel->kode == 'G01') {
                        if ($value->nama == 'Bertahap') {
                            // dump($fuzzyfikasi[0][0]);
                            array_push($rules, array($fuzzyfikasi[0][0]));
                        } else {
                            // dump($fuzzyfikasi[0][1]);
                            array_push($rules, array($fuzzyfikasi[0][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G05') {
                        if ($value->nama == 'Ringan') {
                            // dump($fuzzyfikasi[4][0]);
                            array_push($rules[2], $fuzzyfikasi[4][0]);
                        } else {
                            // dump($fuzzyfikasi[4][1]);
                            array_push($rules[2], $fuzzyfikasi[4][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G10') {
                        if ($value->nama == "Ringan") {
                            // dump($fuzzyfikasi[9][0]);
                            array_push($rules[2], $fuzzyfikasi[9][0]);
                        } else {
                            // dump($fuzzyfikasi[9][1]);
                            array_push($rules[2], $fuzzyfikasi[9][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G15') {
                        if ($value->nama == "Bertahap") {
                            // dump($fuzzyfikasi[14][0]);
                            array_push($rules[2], $fuzzyfikasi[14][0]);
                        } else {
                            // dump($fuzzyfikasi[14][1]);
                            array_push($rules[2], $fuzzyfikasi[14][1]);
                        }
                    }
                }

                if ($rule->kode == 'R04') {
                    if ($value->variabel->kode == 'G01') {
                        if ($value->nama == 'Bertahap') {
                            // dump($fuzzyfikasi[][0]);
                            array_push($rules, array($fuzzyfikasi[0][0]));
                        } else {
                            // dump($fuzzyfikasi[0][1]);
                            array_push($rules, array($fuzzyfikasi[0][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G02') {
                        if ($value->nama == 'Ringan') {
                            // dump($fuzzyfikasi[1][0]);
                            array_push($rules[3], $fuzzyfikasi[1][0]);
                        } else {
                            // dump($fuzzyfikasi[1][1]);
                            array_push($rules[3], $fuzzyfikasi[1][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G07') {
                        if ($value->nama == "Terjadi") {
                            // dump($fuzzyfikasi[6][0]);
                            array_push($rules[3], $fuzzyfikasi[6][0]);
                        } else {
                            // dump($fuzzyfikasi[6][1]);
                            array_push($rules[3], $fuzzyfikasi[6][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G09') {
                        if ($value->nama == "Tidak mengganggu") {
                            // dump($fuzzyfikasi[8][0]);
                            array_push($rules[3], $fuzzyfikasi[8][0]);
                        } else {
                            // dump($fuzzyfikasi[8][1]);
                            array_push($rules[3], $fuzzyfikasi[8][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G11') {
                        if ($value->nama == "Ringan") {
                            // dump($fuzzyfikasi[10][0]);
                            array_push($rules[3], $fuzzyfikasi[10][0]);
                        } else {
                            // dump($fuzzyfikasi[10][1]);
                            array_push($rules[3], $fuzzyfikasi[10][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G12') {
                        if ($value->nama == "Terjadi") {
                            // dump($fuzzyfikasi[11][0]);
                            array_push($rules[3], $fuzzyfikasi[11][0]);
                        } else {
                            // dump($fuzzyfikasi[11][1]);
                            array_push($rules[3], $fuzzyfikasi[11][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G14') {
                        if ($value->nama == "Bertahap") {
                            // dump($fuzzyfikasi[13][0]);
                            array_push($rules[3], $fuzzyfikasi[13][0]);
                        } else {
                            // dump($fuzzyfikasi[13][1]);
                            array_push($rules[3], $fuzzyfikasi[13][1]);
                        }
                    }
                }

                if ($rule->kode == 'R05') {
                    if ($value->variabel->kode == 'G02') {
                        if ($value->nama == 'Ringan') {
                            // dump($fuzzyfikasi[1][0]);
                            array_push($rules, array($fuzzyfikasi[1][0]));
                        } else {
                            // dump($fuzzyfikasi[1][1]);
                            array_push($rules, array($fuzzyfikasi[1][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G03') {
                        if ($value->nama == 'Bertahap') {
                            // dump($fuzzyfikasi[2][0]);
                            array_push($rules[4], $fuzzyfikasi[2][0]);
                        } else {
                            // dump($fuzzyfikasi[2][1]);
                            array_push($rules[4], $fuzzyfikasi[2][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G04') {
                        if ($value->nama == "Ringan") {
                            // dump($fuzzyfikasi[3][0]);
                            array_push($rules[4], $fuzzyfikasi[3][0]);
                        } else {
                            // dump($fuzzyfikasi[3][1]);
                            array_push($rules[4], $fuzzyfikasi[3][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G05') {
                        if ($value->nama == "Ringan") {
                            // dump($fuzzyfikasi[4][0]);
                            array_push($rules[4], $fuzzyfikasi[4][0]);
                        } else {
                            // dump($fuzzyfikasi[4][1]);
                            array_push($rules[4], $fuzzyfikasi[4][1]);
                        }
                    }


                    if ($value->variabel->kode == 'G12') {
                        if ($value->nama == "Terjadi") {
                            // dump($fuzzyfikasi[11][0]);
                            array_push($rules[4], $fuzzyfikasi[11][0]);
                        } else {
                            // dump($fuzzyfikasi[11][1]);
                            array_push($rules[4], $fuzzyfikasi[11][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G13') {
                        if ($value->nama == "Bertahap") {
                            // dump($fuzzyfikasi[12][0]);
                            array_push($rules[4], $fuzzyfikasi[12][0]);
                        } else {
                            // dump($fuzzyfikasi[12][1]);
                            array_push($rules[4], $fuzzyfikasi[12][1]);
                        }
                    }
                }

                if ($rule->kode == 'R06') {
                    if ($value->variabel->kode == 'G05') {
                        if ($value->nama == 'Ringan') {
                            array_push($rules, array($fuzzyfikasi[4][0]));
                        } else {
                            array_push($rules, array($fuzzyfikasi[4][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G06') {
                        if ($value->nama == 'Ringan') {
                            array_push($rules[5], $fuzzyfikasi[5][0]);
                        } else {
                            array_push($rules[5], $fuzzyfikasi[5][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G08') {
                        if ($value->nama == "Ringan") {
                            array_push($rules[5], $fuzzyfikasi[7][0]);
                        } else {
                            array_push($rules[5], $fuzzyfikasi[7][1]);
                        }
                    }
                }

                if ($rule->kode == 'R07') {
                    if ($value->variabel->kode == 'G01') {
                        if ($value->nama == 'Bertahap') {
                            array_push($rules, array($fuzzyfikasi[0][0]));
                        } else {
                            array_push($rules, array($fuzzyfikasi[0][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G11') {
                        if ($value->nama == 'Ringan') {
                            array_push($rules[6], $fuzzyfikasi[10][0]);
                        } else {
                            array_push($rules[6], $fuzzyfikasi[10][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G14') {
                        if ($value->nama == "Bertahap") {
                            array_push($rules[6], $fuzzyfikasi[13][0]);
                        } else {
                            array_push($rules[6], $fuzzyfikasi[13][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G15') {
                        if ($value->nama == "Bertahap") {
                            array_push($rules[6], $fuzzyfikasi[14][0]);
                        } else {
                            array_push($rules[6], $fuzzyfikasi[14][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G16') {
                        if ($value->nama == "Terjadi") {
                            array_push($rules[6], $fuzzyfikasi[15][0]);
                        } else {
                            array_push($rules[6], $fuzzyfikasi[15][1]);
                        }
                    }
                }

                if ($rule->kode == 'R08') {
                    if ($value->variabel->kode == 'G02') {
                        if ($value->nama == 'Ringan') {
                            array_push($rules, array($fuzzyfikasi[1][0]));
                        } else {
                            array_push($rules, array($fuzzyfikasi[1][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G03') {
                        if ($value->nama == 'Bertahap') {
                            array_push($rules[7], $fuzzyfikasi[2][0]);
                        } else {
                            array_push($rules[7], $fuzzyfikasi[2][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G04') {
                        if ($value->nama == "Ringan") {
                            array_push($rules[7], $fuzzyfikasi[3][0]);
                        } else {
                            array_push($rules[7], $fuzzyfikasi[3][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G05') {
                        if ($value->nama == "Ringan") {
                            array_push($rules[7], $fuzzyfikasi[4][0]);
                        } else {
                            array_push($rules[7], $fuzzyfikasi[4][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G12') {
                        if ($value->nama == "Terjadi") {
                            array_push($rules[7], $fuzzyfikasi[11][0]);
                        } else {
                            array_push($rules[7], $fuzzyfikasi[11][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G13') {
                        if ($value->nama == "Bertahap") {
                            array_push($rules[7], $fuzzyfikasi[12][0]);
                        } else {
                            array_push($rules[7], $fuzzyfikasi[12][1]);
                        }
                    }
                }

                if ($rule->kode == 'R09') {
                    if ($value->variabel->kode == 'G01') {
                        if ($value->nama == 'Bertahap') {
                            array_push($rules, array($fuzzyfikasi[0][0]));
                        } else {
                            array_push($rules, array($fuzzyfikasi[0][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G05') {
                        if ($value->nama == 'Ringan') {
                            array_push($rules[8], $fuzzyfikasi[4][0]);
                        } else {
                            array_push($rules[8], $fuzzyfikasi[4][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G10') {
                        if ($value->nama == "Ringan") {
                            array_push($rules[8], $fuzzyfikasi[9][0]);
                        } else {
                            array_push($rules[8], $fuzzyfikasi[9][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G15') {
                        if ($value->nama == "Bertahap") {
                            array_push($rules[8], $fuzzyfikasi[14][0]);
                        } else {
                            array_push($rules[8], $fuzzyfikasi[14][1]);
                        }
                    }
                }

                if ($rule->kode == 'R10') {
                    if ($value->variabel->kode == 'G01') {
                        if ($value->nama == 'Bertahap') {
                            array_push($rules, array($fuzzyfikasi[0][0]));
                        } else {
                            array_push($rules, array($fuzzyfikasi[0][1]));
                        }
                    }

                    if ($value->variabel->kode == 'G02') {
                        if ($value->nama == 'Ringan') {
                            array_push($rules[9], $fuzzyfikasi[1][0]);
                        } else {
                            array_push($rules[9], $fuzzyfikasi[1][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G07') {
                        if ($value->nama == "Terjadi") {
                            array_push($rules[9], $fuzzyfikasi[6][0]);
                        } else {
                            array_push($rules[9], $fuzzyfikasi[6][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G09') {
                        if ($value->nama == "Tidak mengganggu") {
                            array_push($rules[9], $fuzzyfikasi[8][0]);
                        } else {
                            array_push($rules[9], $fuzzyfikasi[8][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G11') {
                        if ($value->nama == "Ringan") {
                            array_push($rules[9], $fuzzyfikasi[10][0]);
                        } else {
                            array_push($rules[9], $fuzzyfikasi[10][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G12') {
                        if ($value->nama == "Terjadi") {
                            array_push($rules[9], $fuzzyfikasi[11][0]);
                        } else {
                            array_push($rules[9], $fuzzyfikasi[11][1]);
                        }
                    }

                    if ($value->variabel->kode == 'G14') {
                        if ($value->nama == "Bertahap") {
                            array_push($rules[9], $fuzzyfikasi[13][0]);
                        } else {
                            array_push($rules[9], $fuzzyfikasi[13][1]);
                        }
                    }
                }
            }
        }

        // variabel menampung nilai min setiap rule nya
        $min = array();
        foreach ($rules as $key => $rule) {
            array_push($min, min($rule));
        }

        $atas = 0;
        $bawah = 0;
        $z = 0;
        foreach($min as $key => $row) {

                // dump($row);
                $atas += ($row * $aturan[$key]['CertaintyFactor']);
                $bawah += $row;
                // $cf = $z * $aturan[$key]['CertaintyFactor'];
                // dump($z);
                // dump($aturan[$key]['CertaintyFactor']);
                // dump($key);

        }
        $z = $atas / $bawah;



        $keputusan = array();
        $z = 0;
        $a = 0;
        $b = 0;
        $cfRule = array();
        $rulePass = array();
        foreach ($aturan as $key => $rule) {
            if ($min[$key] > 0) {
                array_push($rulePass, $rule->kode);
                $a += $min[$key] * $rule->CertaintyFactor;
                $b +=  $min[$key];
            }

        }

        $test = [];
        foreach($aturan as $key => $row) {
            foreach($rulePass as $key => $pass) {

                // if ($row->kode == $pass) {
                //     $test = $pass;
                // }
            }
        }


        // echo number_format($z, 3);


        // foreach ($aturan as $key => $rule) {
        //     array_push($cfRule, $z * $rule->CertaintyFactor);
        // }
        // // dump($cfRule);

        // $cfTotal = array();

        // // foreach($aturan as $key => $rule) {
        // $result1 = (($cfRule[4] + $cfRule[7]) * (1 - $cfRule[4]));
        // array_push($cfTotal, $result1);

        // $result2 = (($cfRule[3] + $cfRule[9]) * (1 - $cfRule[3]));
        // array_push($cfTotal, $result2);

        // $result3 = (($cfRule[2] + $cfRule[8]) * (1 - $cfRule[2]));
        // array_push($cfTotal, $result3);

        // $result4 = (($cfRule[1] + $cfRule[6]) * (1 - $cfRule[1]));
        // array_push($cfTotal, $result4);

        // $result5 = (($cfRule[0] + $cfRule[5]) * (1 - $cfRule[0]));
        // array_push($cfTotal, $result5);
        // }

        // $keputusan = DB::table('keputusan')->get();
        // $maxValue = max($cfTotal);
        // $persentasi = $maxValue * 100;

        // $maxIndex = array_search($maxValue, $cfTotal);
        // dump($cfTotal);
        // dump($maxIndex);
        // foreach($keputusan as $key => $row) {
        //     if ($maxIndex == $key) {
        //         dump("Anda terdiagnosa penyakit " . $row->nama . " " . number_format($persentasi, 2) . "%");
        //         break;
        //     }
        // }
        return $min;
    }


    public function konsultasiById($id)
    {
        $data = Konsultasi::findOrFail($id);
        return $data;
    }

    public function calculateCF()
    {
        $defuzzy = $this->defuzzyfikasi();

        return $defuzzy;
        // $aturan = Aturan::with('himpunan')->get();

        // foreach($aturan as $key => $rule) {
        //     dump($rule);
        // }

    }

    public function diagnosa()
    {
        $konsul_id = User::findOrFail(auth()->id())->konsultasi()->latest()->first()->id;

        $diagnosa = DB::table('diagnosa')->where('konsultasi_id', $konsul_id)->first();

        $nilai = json_decode($diagnosa->nilai);
        $maxIndex = null;
        $maxValue = max($nilai);

        $maxIndex = array_search($maxValue, $nilai);
        return $maxIndex;
    }

    public function diagnosaNilai(array $data) {
        $maxIndex = null;
        $maxValue = max($data);



    }
}
