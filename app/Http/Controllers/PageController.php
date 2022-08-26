<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function getHomepage(){

        return view('homepage');

    }


    public function generatePacksForDelivery(Request $request){

        $validatedData = $request->validate([
            'orderSize' => ['required', 'numeric'],
        ]);

        $generator = app('GeneratorWidgetPacksForDelivery');

        $generator->setOrderedAmount($validatedData['orderSize']);

        $results = $generator->generateResults();

        $aggregateResults = [];

        foreach ($results as $value) {
            if (isset($aggregateResults[$value])) {
                $aggregateResults[$value] = $aggregateResults[$value] + 1;
            }
            else{
                $aggregateResults[$value] = 1;
            }
        }

        return $aggregateResults;

    }

}
