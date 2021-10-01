<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Company;
use App\Models\Branchoffice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


/*
use App\Models\User;

use App\Models\Registerbranchoffices;
use App\Models\Registercompany;
*/

class AppointmentController extends Controller
{
    public function showByDateTime(Request $request)
    {
        return 'hola';
        $companyId=$request->query('companyId','false');
        $branchofficeId=$request->query('branchofficeId','false');
        $date=$request->query('date','false');
    
        if($companyId != 'false'){
            $companybranchofficesQuery= Company::find($companyId);  
        }
        $times = [];
        $companies = [];
        $branchoffices = [];
        $companyForBranchoffice = [];
        $companiesForAdministrator = [];

        $branchoffices = Branchoffice::where('companyId', $companyId)->get();
        $companiesForAdministrator = Company::all();

        foreach($companiesForAdministrator as $key_companiesForAdministrator=>$value_companiesForAdministrator){
            if(($companyId) != $value_companiesForAdministrator->id){
                $companyForBranchoffice[$key_companiesForAdministrator] = $value_companiesForAdministrator->id;
            }   
        }

        $companies = Company::whereIn('id',$companyForBranchoffice)->get();

        if($branchofficeId == 'false'){     
            return view('appointments.edit',['branchoffices'=>$branchoffices,'companybranchofficesQuery'=>$companybranchofficesQuery,'times'=>$times],['companies'=>$companies]); 
        }

        $branchofficeQuery = [];
        $branchForOfficeCompany = [];
        $branchofficeQuery = Branchoffice::find($branchofficeId);
        
        foreach($branchoffices as $key_branchoffices=>$value_branchoffices){
            if(($branchofficeQuery->id) != $value_branchoffices->id){
                $branchForOfficeCompany[$key_branchoffices] = $value_branchoffices->id;
            }
        }

        $branchoffices = Branchoffice::whereIn('id', $branchForOfficeCompany)->get();

        return view('appointments.editDateTime',['branchoffices'=>$branchoffices,'companybranchofficesQuery'=>$companybranchofficesQuery, 'branchofficeQuery'=>$branchofficeQuery, 'times'=>$times],['companies'=>$companies]); 
    }

    public function showByBranchofficeDateTime(Request $request)
    {
        $companyId=$request->query('companyId','false');
        $branchofficeId=$request->query('branchofficeId','false');
    
        if($companyId != 'false'){
            $companybranchofficesQuery= Company::find($companyId);  
        }
        $times = [];
        $companies = [];
        $branchoffices = [];
        $companyForBranchoffice = [];
        $companiesForAdministrator = [];

        $branchoffices = Branchoffice::where('companyId', $companyId)->get();
        $companiesForAdministrator = Company::all();

        foreach($companiesForAdministrator as $key_companiesForAdministrator=>$value_companiesForAdministrator){
            if(($companyId) != $value_companiesForAdministrator->id){
                $companyForBranchoffice[$key_companiesForAdministrator] = $value_companiesForAdministrator->id;
            }   
        }

        $companies = Company::whereIn('id',$companyForBranchoffice)->get();

        if($branchofficeId == 'false'){     
            return view('appointments.edit',['branchoffices'=>$branchoffices,'companybranchofficesQuery'=>$companybranchofficesQuery,'times'=>$times],['companies'=>$companies]); 
        }

        $branchofficeQuery = [];
        $branchForOfficeCompany = [];
        $branchofficeQuery = Branchoffice::find($branchofficeId);
        
        foreach($branchoffices as $key_branchoffices=>$value_branchoffices){
            if(($branchofficeQuery->id) != $value_branchoffices->id){
                $branchForOfficeCompany[$key_branchoffices] = $value_branchoffices->id;
            }
        }

        $branchoffices = Branchoffice::whereIn('id', $branchForOfficeCompany)->get();

        return view('appointments.editDateTime',['branchoffices'=>$branchoffices,'companybranchofficesQuery'=>$companybranchofficesQuery, 'branchofficeQuery'=>$branchofficeQuery, 'times'=>$times],['companies'=>$companies]); 
    }

    public function showByBranchoffice(Request $request)
    {
        $companyId=$request->query('companyId');
        $companybranchofficesQuery= Company::find($companyId);
        $times = [];
        $companies = [];
        $branchoffices = [];
        $companyForBranchoffice = [];
        $companiesForAdministrator = [];

        $branchoffices = Branchoffice::where('companyId', $companyId)->get();
        $companiesForAdministrator = Company::all();

        foreach($companiesForAdministrator as $key_companiesForAdministrator=>$value_companiesForAdministrator){
            if(($companyId) != $value_companiesForAdministrator->id){
                $companyForBranchoffice[$key_companiesForAdministrator] = $value_companiesForAdministrator->id;
            }   
        }

        $companies = Company::whereIn('id',$companyForBranchoffice)->get();

        return view('appointments.edit',['branchoffices'=>$branchoffices,'companybranchofficesQuery'=>$companybranchofficesQuery,'times'=>$times],['companies'=>$companies]); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('appointments.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = [];
        $branchoffices = [];
        $times = [];

        $companies = Company::all();
        return view('appointments.create',['branchoffices'=>$branchoffices,'times'=>$times],['companies'=>$companies]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(appointment $appointment)
    {
        //
    }
}
