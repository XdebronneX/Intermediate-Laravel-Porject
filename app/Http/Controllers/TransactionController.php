<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\GroomingService;
use App\Models\Pet;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\DataTables\TransactionsDataTable;
use DataTables;
use Redirect;
use View;
use Auth;
use DB;
use Session;
use App\Cart;
use PDF;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transacts = GroomingService::all()->whereNull('deleted_at');
        return view::make('shop.index',compact('transacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($groominginfo_id)
    {       $transactions = Transaction::find($groominginfo_id);
            return View::make('shop.edit',compact('transactions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $groominginfo_id)
    {
        $transactions = Transaction::find($groominginfo_id);
        $transactions->status = $request->input("status");
        $transactions->update();

        return Redirect::to('/transacts')->with('success', 'Transaction updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transactions = Transaction::find($id);
        $transactions->services()->detach();
        $transactions->delete();
        return Redirect::to('/transacts')->with('success','Transaction Deleted!');
    }

    public function getAddToCart(Request $request , $id)
    {
        $service = GroomingService::find($id);
        // $oldCart = Session::has('cart') ? $request->session()->get('cart'): null;
        $oldCart = Session::has('cart') ? Session::get('cart'): null;

        $cart = new Cart($oldCart);
        $cart->add($service, $service->service_id);
        //$request->session()->put('cart', $cart);
        Session::put('cart', $cart);
        //$request->session()->save();
        Session::save();
        //dd(Session::all());
         return redirect()->route('transact.index');
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $pets = Pet::pluck('pname','pet_id');
        //dd($oldCart);
        return view('shop.shopping-cart', ['services' => $cart->services, 'totalPrice' => $cart->totalPrice],compact('pets'));
    }

    public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->services) > 0) {
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
         return redirect()->route('service.shoppingCart');
    }

    public function storeCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('transact.index');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        //  dd($cart);
        try {
             DB::beginTransaction();
            $order = new Transaction();
            // dd($order);
            $order->pet_id = $request->pet_id;
            $order->status = 'Processing';
            // dd($order);
            $order->save();
            // dd($order);
        foreach($cart->services as $services){
                $id = $services['service']['service_id'];
                 //dd($id);
                 $order->services()->attach($id);
                // DB::table('groomingline')->insert(
                //     ['service_id' => $id,
                //      'groominginfo_id' => $order->groominginfo_id
                //     ]
                //     );
            }
            // dd($order);
        }
        catch (\Exception $e) {
            //  dd($e);
            DB::rollback();
            //  dd($order);
            return redirect()->route('service.shoppingCart')->with('error', $e->getMessage());
        }

        $customershoww = Customer::join('pets','pets.customer_id','customers.customer_id')
        ->join('grooming_info','grooming_info.pet_id','pets.pet_id')
        ->join('groomingline','groomingline.groominginfo_id','grooming_info.groominginfo_id')
        ->join('grooming_service','groomingline.service_id','grooming_service.service_id')
        ->select('customers.lname', 'customers.fname', 'pets.pname', 'grooming_service.service_name')
        ->where('customers.customer_id',$id)
        ->get();

        $maxid = DB::table('grooming_info')->where('groominginfo_id', \DB::raw("(select max(`groominginfo_id`) from grooming_info)"))->first();
        $info = DB::table('grooming_info')
        ->join('pets', 'grooming_info.pet_id', 'pets.pet_id')
        ->join('customers', 'customers.customer_id', 'pets.customer_id')
        ->select('customers.fname', 'customers.lname', 'pets.pname', 'grooming_info.created_at', 'customers.addressline', 'grooming_info.status')
        ->where('groominginfo_id',$maxid->groominginfo_id)->first();
        $tableee = DB::table('groomingline')
        ->join('grooming_service', 'groomingline.service_id', 'grooming_service.service_id')
        ->select('grooming_service.service_name', 'grooming_service.service_cost')
        ->where('groominginfo_id',$maxid->groominginfo_id)->get();

        // DB::table("rates")->get()->sum("rate_value")
        $add = DB::table('groomingline')
        ->join('grooming_service', 'groomingline.service_id', 'grooming_service.service_id')
        ->select('grooming_service.service_name', 'grooming_service.service_cost')
        ->where('groominginfo_id',$maxid->groominginfo_id)->sum('grooming_service.service_cost');
        // dd($add);
            $pdf = PDF::loadView('myPDF', compact('tableee', 'info', 'add'));



            DB::commit();
            return $pdf->stream('Reciept.pdf');
            Session::forget('cart');


            return redirect()->route('transact.index')->with('success','Successfully Purchased Your Products!!!');



    }

    public function getTransacts(TransactionsDataTable $dataTable)
    {
        $transactionss = Transaction::with('pets')->orderBy('groominginfo_id','DESC')->get();
        return $dataTable->render('shop.transactions', compact('transactionss'));
    }

}


