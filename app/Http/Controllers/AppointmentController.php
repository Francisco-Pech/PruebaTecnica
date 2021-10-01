<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Company;
use App\Models\Branchoffice;
use App\Models\Registercompany;
use App\Models\Registerbranchoffices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class AppointmentController extends Controller
{
    public function showByInformationBranchOffices()
    {
        $user=Auth::user();
        $companyRegister = [];
        $appointments = [];
        $appointmentsByCompany = [];
        $appointmentsByBranchOffices = [];
        $apporintmentsBranchOffices = [];
        
        $companyRegister = Registercompany::where('userId', $user->id)->get();
        $branchoffices = Branchoffice::where('companyId', $companyRegister[0]->companyId)->get();

        foreach($branchoffices as $key_branchoffices=>$value_branchoffices){
            $apporintmentsBranchOffices[$key_branchoffices] = $value_branchoffices->id;
        }

        $appointments = Appointment::whereIn('branchOfficeId', $apporintmentsBranchOffices)
                                    ->orderBy('id','DESC')
                                    ->paginate(10);
    
        foreach($appointments as $key_appointments=>$value_appointments){
            $appointmentsByCompany[$key_appointments] = Company::find($value_appointments->companyId);
            $appointments[$key_appointments]->companies = $appointmentsByCompany[$key_appointments];
        
            $appointmentsByBranchOffices[$key_appointments] = Branchoffice::find($value_appointments->branchOfficeId);
            $appointments[$key_appointments]->branchoffices = $appointmentsByBranchOffices[$key_appointments];
        }

        return  view('appointments.indexSup',['appointments'=>$appointments]);      
    }


    public function showBySearchBranchOffices(Request $request)
    {
        
        $branchofficeId = $request->query('branchofficeId','false');

        $user=Auth::user();
        $companyRegister = [];
        $appointments = [];
        $appointmentsByCompany = [];
        $appointmentsByBranchOffices = [];
        $apporintmentsBranchOffices = [];

        $companyRegister = Registercompany::where('userId', $user->id)->get();
        $branchoffices = Branchoffice::where('companyId', $companyRegister[0]->companyId)->get();

        foreach($branchoffices as $key_branchoffices=>$value_branchoffices){
            $apporintmentsBranchOffices[$key_branchoffices] = $value_branchoffices->id;
        }

        if(($branchofficeId=='false')||($branchofficeId=='')||($branchofficeId==NULL)){
            $appointments = Appointment::whereIn('branchOfficeId', $apporintmentsBranchOffices)
                                    ->orderBy('id','DESC')
                                    ->paginate(10);
        }else{
            $appointments = Appointment::where('branchOfficeId', $branchofficeId)
                                    ->orderBy('id','DESC')
                                    ->paginate(10);
        }
        
    
        foreach($appointments as $key_appointments=>$value_appointments){
            $appointmentsByCompany[$key_appointments] = Company::find($value_appointments->companyId);
            $appointments[$key_appointments]->companies = $appointmentsByCompany[$key_appointments];
        
            $appointmentsByBranchOffices[$key_appointments] = Branchoffice::find($value_appointments->branchOfficeId);
            $appointments[$key_appointments]->branchoffices = $appointmentsByBranchOffices[$key_appointments];
        }

        return  view('appointments.index',['appointments'=>$appointments,'branchofficeId'=>$branchofficeId],['branchoffices'=>$branchoffices]); 
    }

    public function showByDateTime(Request $request)
    {
        
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
        $user=Auth::user();

        $branchofficeId = [];
        $companyRegister = [];
        $appointments = [];
        $appointmentsByCompany = [];
        $appointmentsByBranchOffices = [];
        $apporintmentsBranchOffices = [];
        
        $companyRegister = Registercompany::where('userId', $user->id)->get();
        $branchoffices = Branchoffice::where('companyId', $companyRegister[0]->companyId)->get();

        foreach($branchoffices as $key_branchoffices=>$value_branchoffices){
            $apporintmentsBranchOffices[$key_branchoffices] = $value_branchoffices->id;
        }

        $appointments = Appointment::whereIn('branchOfficeId', $apporintmentsBranchOffices)
                                    ->orderBy('id','DESC')
                                    ->paginate(10);
    
        foreach($appointments as $key_appointments=>$value_appointments){
            $appointmentsByCompany[$key_appointments] = Company::find($value_appointments->companyId);
            $appointments[$key_appointments]->companies = $appointmentsByCompany[$key_appointments];
        
            $appointmentsByBranchOffices[$key_appointments] = Branchoffice::find($value_appointments->branchOfficeId);
            $appointments[$key_appointments]->branchoffices = $appointmentsByBranchOffices[$key_appointments];
        }

        return  view('appointments.index',['appointments'=>$appointments, 'branchofficeId'=>$branchofficeId],['branchoffices'=>$branchoffices]);      
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
