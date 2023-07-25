<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\crud;
use DataTables;
use Yajra\DataTables\DataTablesServiceProvider;

class crudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function menu()
    {
      return view('index');
    }

    public function index(Request $request)
    {
     
        if ($request->ajax()){

            $data = crud::get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                $button = $button.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make();
             }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        crud::updateOrCreate(['id'=>$request->id],
         [
            'name' => $request->name,
            'desc' => $request->desc,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = crud::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        crud::find($id)->delete();
    }
}
