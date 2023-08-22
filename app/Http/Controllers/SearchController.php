<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $page = isset($request->page) ? $request->page : 1;
        $endpoint = 'https://www.sitelevel.com/query';
        $client = new \GuzzleHttp\Client();
        $value = $request->s;
        // dd($request->s);
        if(app()->getLocale() == 'en'){
           $response = $client->request('GET', $endpoint, ['query' => [
            'crid' => '6lkywgty',
            // 'crid' => 'y07b4wzq',
            'query' => $value,
            'page' => $page,
        ]]); 
        }else{
        
        $response = $client->request('GET', $endpoint, ['query' => [
            'crid' => '1s9leg5n',
            'query' => $value,
            'page' => $page,
        ]]);
    }

        // url will be: http://my.domain.com/test.php?key1=5&key2=ABC;

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();
        // dd($response);
        // return $content;
        return view('website.search')->with('search_data', $content);
    }
}
