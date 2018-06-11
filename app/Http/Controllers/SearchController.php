<?php

namespace App\Http\Controllers;

use App\Scheme;
use App\Species;
use Illuminate\Support\Facades\Input;
use TomLingham\Searchy\Facades\Searchy;

class SearchController extends Controller
{
    /**
     * Show advanced search page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schemeArr = Scheme::get();
        return view('search.index', ['schemeArr' => $schemeArr]);
    }

    /**
     * Display a list of search result
     *
     * @return \Illuminate\Http\Response
     */
    public function result()
    {
        $fields = array_map(function($scheme) {
            return $scheme['key'];
        }, Scheme::get()->toArray());

        $type = Input::get('type');
        $q = Input::get('q');
        if(!$q || ($type && $type != 'advancedSearch')) return redirect(route('home.index'));
        $speciesArr = [];
        if($type != 'advancedSearch') {
            //The fields() section below is giving the fields that the search function is searching through to find the info
            $speciesArr = Searchy::driver('simple')->search('species')->fields('species_name', 'common_name', 'miami_name')->query($q)->get();
        } else {
            $q = json_decode($q, true);
            if(isset($q['_token'])) unset($q['_token']);
            foreach ($q as $key => $value) {
                if($value == '') unset($q[$key]);
            }
            foreach ($q as $key => $value) {
                $data = Searchy::driver('simple')->search('species')->fields($key)->select('species_name', 'id')->query($value)->get()->toArray();
                if(!count($speciesArr)) {
                    $speciesArr = $data;
                } else {
                    $speciesArr = $this->array_and($speciesArr, $data);
                }
            }

        }

        return view('search.result', ['speciesArr' => $speciesArr]);
    }

    private function array_and($arr1, $arr2) {
        foreach ($arr1 as $k1 => $v1) {
            $isFound = false;
            foreach ($arr2 as $k2 => $v2) {
                if($v1->id == $v2->id) {
                    $isFound = true;
                    unset($arr2[$k2]);
                    break;
                }
            }
            if(!$isFound) unset($arr1[$k1]);
        }
        return array_values($arr1);
    }
}
