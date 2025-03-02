<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Customer;
use App\Models\Breed;
use Illuminate\Http\Request;
use Excel;
use App\Rules\ExcelRule;
use App\DataTables\PetsDataTable;
use DataTables;
use Redirect;
use View;
use DB;
use Validator;
use Auth;
use App\Imports\PetImports;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('customer', 'breed')->get();
        return View::make('pet.pets', compact('pets'));
    }

    public function create()
    {
        $customers = Customer::pluck("fname", "customer_id");
        $breeds = Breed::pluck("pbreed", "petb_id");
        return View::make("pet.create", compact("customers", "breeds"));
    }

    public function store(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'pname' => 'required|string|max:255',
            'petb_id' => 'required|exists:pet_breed,petb_id',
            'age' => 'required|integer|min:0',
            'gender' => 'required|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'customer_id' => 'required|exists:customers,customer_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Find customer
        $customer = Customer::findOrFail($request->customer_id);

        // Handle image upload
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
        }

        // Create pet
        $pet = new Pet();
        $pet->pname = $request->pname;
        $pet->petb_id = $request->petb_id;
        $pet->age = $request->age;
        $pet->gender = $request->gender;
        $pet->customer_id = $customer->customer_id;
        if ($fileName) {
            $pet->img_path = $fileName;
        }
        $pet->save();

        return redirect()->route('user.profile')->with('success', 'New pet added!');
    }

public function edit($pet_id)
{
    $pet = Pet::findOrFail($pet_id);
    $customers = Customer::pluck('fname', 'customer_id');
    $breeds = Breed::all(); 

    return view('pet.edit', compact('pet', 'customers', 'breeds'));
}



  public function update(Request $request, $pet_id)
{
    $pet = Pet::findOrFail($pet_id);

    // Validate input
    $validator = Validator::make($request->all(), [
        'pname' => 'required|string|max:255',
        'petb_id' => 'required|exists:pet_breed,petb_id', // Ensure breed exists
        'age' => 'required|integer|min:0',
        'gender' => 'required|string|max:10',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'customer_id' => 'required|exists:customers,customer_id',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }

    // Handle image upload
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $fileName);
        $pet->img_path = $fileName; 
    }

    // Update pet data
    $pet->pname = $request->pname;
    $pet->petb_id = $request->petb_id; // Store single breed
    $pet->age = $request->age;
    $pet->gender = $request->gender;
    $pet->customer_id = $request->customer_id;
    $pet->save();

    return Redirect::to('/pets')->with('success', 'Pet has been updated!');
}


    public function destroy($pet_id)
    {
        $pet = Pet::findOrFail($pet_id);
        $pet->forceDelete();
        return Redirect::to('/pets')->with('success', 'Pet deleted!');
    }

    public function getPets(PetsDataTable $dataTable)
    {
        $pets = Pet::with(['customer', 'breed'])->get();
        return $dataTable->render('pet.pets', compact('pets'));
    }

    public function import(Request $request)
    {
        // Validate file import
        $request->validate([
            'pet_upload' => ['required', new ExcelRule($request->file('pet_upload'))],
        ]);

        Excel::import(new PetImports, request()->file('pet_upload'));

        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }
}
