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
        return response()->json(Websites::all()->orderBy('id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $websites = new Website($request->all());

        $ifNotUnique = Websites::where('url', $request->input('url'))->get();

        if (isset($ifNotUnique)) {
            return response()->json([
                'status' => false,
                'message' => "This URL is taken."
            ]);
        } 
        $website = new Websites;
        $website->name = $request->input('name');
        $website->url = $request->input('url');
        $website->save();

        return response()->json([
            'status' => true,
            'message' => $website
        ]);

        
    }

    public function update($id, Request $request) {

        $ifNotUnique = Websites::where('url', $request->input('url'))->get();

        if (isset($ifNotUnique->url)) {
            return response()->json([
                'status' => false,
                'message' => "This URL is taken."
            ]);
        }


        $website = Websites::find($id);
        $website->name = $request->input('name');
        $website->url = $request->input('url');

        return response()->json([
            'status' => $website->save(),
            'data' => $website
        ]);
    }

    public function delete($id) {
        $website = Websites::find($id);
        $website->delete();
        return response()->json('Deleted Successfully');
    }

    public function filter(Request $request, $id) 
    {
        // Search by URI ID
        if (isset($id)) {
            return response()->json(Websites::find($id));
        }
        // Search by ID
        if ($request->has('id')) {
            return response()->json(Websites::where('id', $request->input('id'))->get());
        }
        // Search by Name
        if ($request->has('name')) {
            return response()->json(Websites::where('name', 'LIKE', "%{$request->input('name')}%")->get());
        }
        // Search by URL
        if ($request->has('url')) {
            return response()->json(Websites::where('url', 'LIKE', "%{$request->input('url')}%")->get());
        }
        return response()->json(Websites::all());
    }
}
