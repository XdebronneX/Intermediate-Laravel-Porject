<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Customer;
use Spatie\Searchable\Search;
use Illuminate\Support\Facades\View;

class SearchController extends Controller
{
    // Display Pet Search Page
    public function searchPet()
    {
        return view('search.searchPet');
    }

    // Handle Pet Search Query
    public function searchPetQuery(Request $request)
    {
        $searchTerm = $request->input('searchPet');

        $searchResults = (new Search())
            ->registerModel(Pet::class, 'pname')
            ->perform($searchTerm);

        return View::make('search.searchPet', compact('searchResults', 'searchTerm'));
    }

    // Show Pet Details with Disease Information
    public function searchPetQueryShow($id)
    {
        $petDetails = Pet::join('health_consultation', 'pets.pet_id', '=', 'health_consultation.pet_id')
            ->join('consultation_disease', 'health_consultation.consult_id', '=', 'consultation_disease.consultation_consult_id')
            ->join('disease_injuries', 'consultation_disease.disease_disease_id', '=', 'disease_injuries.disease_id')
            ->select('pets.pname', 'disease_injuries.disease_name')
            ->where('pets.pet_id', $id)
            ->with('consults')
            ->get();

        return View::make('search.searchpetShow', compact('petDetails'));
    }

    // Display Customer Search Page
    public function searchCustomer()
    {
        return view('search.searchCustomer');
    }

    // Handle Customer Search Query
    public function searchCustomerQuery(Request $request)
    {
        $searchTerm = $request->input('searchCustomer');

        $searchResults = (new Search())
            ->registerModel(Customer::class, 'lname')
            ->perform($searchTerm);

        return View::make('search.searchCustomer', compact('searchResults', 'searchTerm'));
    }

    // Show Customer Details with Pet & Grooming Info
    public function searchCustomerQueryShow($id)
    {
        $customerDetails = Customer::join('pets', 'pets.customer_id', '=', 'customers.customer_id')
            ->join('grooming_info', 'grooming_info.pet_id', '=', 'pets.pet_id')
            ->join('groomingline', 'groomingline.groominginfo_id', '=', 'grooming_info.groominginfo_id')
            ->join('grooming_service', 'groomingline.service_id', '=', 'grooming_service.service_id')
            ->select('customers.lname', 'customers.fname', 'pets.pname', 'grooming_service.service_name')
            ->where('customers.customer_id', $id)
            ->with('pets')
            ->get();

        return View::make('search.searchcustomerShow', compact('customerDetails'));
    }
}
