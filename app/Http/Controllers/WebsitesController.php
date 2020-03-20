<?php

namespace App\Http\Controllers;

use App\Websites;
use Illuminate\Http\Request;

class WebsitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Websites::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $websites = new Website($request->all());

        $website = new Website;
        $website->name = $request->input('name');
        $website->url = $request->input('url');

        return response()->json($website->save());
    }
}
