<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

         $clients = Client::when($request->search,function($q)use($request){
            return $q->whereAny(['name','phone','address'],'like','%'.$request->search.'%');
         })->latest()->paginate('5');

        return view('dashboard.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $clients = Client::get();

        return view('dashboard.clients.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ]);
        $client=$request->all();
        // $client['phone'] = array_filter($request->phone);
        // dd($client);

        Client::create($client);

        return redirect()->route('dashboard.clients.index')->with('success',__('site.added_successfully'));


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
         $client=Client::find($id);
         return view('dashboard.clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ]);

        $client = Client::findOrFail($id); // Retrieve the client instance by ID

        $client->update($request->all()); // Update the client instance with the new data from the request


        return redirect()->route('dashboard.clients.index')->with('success',__('site.updated_successfully'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id); // Retrieve the client instance by ID

        $client->delete();

        return redirect()->route('dashboard.clients.index')->with('success','site.deleted_successfully');
    }
}
