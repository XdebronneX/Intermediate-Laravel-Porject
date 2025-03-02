<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Pet;
use App\Models\Disease;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\DataTables\ConsultationsDataTable;
use DataTables;
use Redirect;
use View;
use DB;
use Validator;
use Auth;
use App\Events\SendCheckupMail;
use Event;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
{   
    // Step 1: Debug Incoming Request Data
    // dd($request->all()); // Check if the request contains all required data

    // Step 2: Validate Request
    $validatedData = $request->validate([
        'pet_id' => 'required|exists:pets,pet_id',
        'emp_id' => 'required|exists:employees,emp_id',
        'observation' => 'required|string',
        'consult_cost' => 'numeric|nullable',
        'disease_id' => 'array|nullable',
        'disease_id.*' => 'exists:disease_injuries,disease_id'
    ]);

    // Step 3: Create Consultation
    $consultation = Consultation::create([
        'pet_id' => $validatedData['pet_id'],
        'emp_id' => $validatedData['emp_id'],
        'observation' => $validatedData['observation'],
        'consult_cost' => $validatedData['consult_cost'] ?? null,
    ]);

    // dd($consultation); // Check if consultation is created

    // Step 4: Attach Diseases (if selected)
    if (!empty($request->disease_id)) {
        $consultation->diseases()->attach($request->disease_id);
    }

    // dd($consultation->diseases()->get()); // Check if diseases are attached

    // Step 5: Dispatch Email Event
    Event::dispatch(new SendCheckupMail($consultation));

    return Redirect::to('/consults')->with('success', 'Consultation created successfully!');
}



   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function show(Consultation $consultation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    // public function edit(Consultation $consultation)
    // {
    //     //
    // }

public function edit($id)
{
    $consult = Consultation::with('diseases')->findOrFail($id); // Ensure diseases are loaded
    $selectedDiseases = $consult->diseases->pluck('disease_id')->toArray(); // Get selected diseases
    $diseases = Disease::all(); // Fetch all diseases

    return View::make('consultation.edit', compact('consult', 'selectedDiseases', 'diseases'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'pet_id' => 'required|exists:pets,pet_id',
        'emp_id' => 'required|exists:employees,emp_id',
        'observation' => 'required|string',
        'consult_cost' => 'numeric|nullable',
        'disease_id' => 'array|nullable',
        'disease_id.*' => 'exists:disease_injuries,disease_id'
    ]);

    $consults = Consultation::findOrFail($id);
    $consults->update($validatedData);

    // Sync diseases (removes old & adds new ones)
    $consults->diseases()->sync($request->disease_id ?? []);

    return Redirect::to('/consults')->with('success', 'Consultation updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation,$id)
    {
        $consultsss = Consultation::find($id);
        $consultsss->disease()->detach();
        $consultsss->delete();
        return Redirect::to('/consults')->with('success','Listener deleted!');
    }

    public function getConsults(ConsultationsDataTable $dataTable)
    {
        $consults = Consultation::with(['pet','diseases','employee'])->get();
        $diseases = Disease::get();
        return $dataTable->render('consultation.consults', compact('consults','diseases'));
    }
}
