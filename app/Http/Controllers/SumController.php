<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SumController extends Controller
{
    public function __constructor()
    {

    }

    private function summary(string $inputString)
    {
        $arrayString = explode(',', $inputString);
        $totalSummary = array_sum($arrayString);

        return $totalSummary;
    }

    public function index()
    {
        $inputString = "1,2,3,4,5,6,7";

        $result = $this->summary($inputString);

        dd('Total summary is: ' . $result);
    }
}
