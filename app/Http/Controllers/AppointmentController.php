<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Company;
use App\Models\Branchoffice;
use App\Models\Registercompany;
use App\Models\Registerappointment;
use App\Models\Registerbranchoffices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class AppointmentController extends Controller
{
    public function showAppointmentEmployee(){
        
        $appointmentregister = [];
        $appointmentsByUser = [];
        $appointments = [];
        $appointmentsByCompany = [];
        $appointmentsByBranchOffices = [];
        $user = [];

        $user=Auth::user();
        $appointmentregister = Registerappointment::where('userId', $user->id)->get();

        foreach($appointmentregister as $key_appointmentregister=>$value_appointmentregister){
            $appointmentsByUser[$key_appointmentregister] = $value_appointmentregister->appointmentId;   
        }
                                 
        $appointments = Appointment::whereIn('id', $appointmentsByUser)
                                    ->orderBy('id','DESC')
                                    ->paginate(10);

        foreach($appointments as $key_appointments=>$value_appointments){
            $appointmentsByCompany[$key_appointments] = Company::find($value_appointments->companyId);
            $appointments[$key_appointments]->companies = $appointmentsByCompany[$key_appointments];
        
            $appointmentsByBranchOffices[$key_appointments] = Branchoffice::find($value_appointments->branchOfficeId);
            $appointments[$key_appointments]->branchoffices = $appointmentsByBranchOffices[$key_appointments];
        }

        return  view('appointments.indexEmp',['appointments'=>$appointments]);      
    }

    public function arrayTime($timeStart = [], $timeEnd = [], $companyId = [], $branchofficeId = [], $dateCurrent = [])
    {
        $turns = [];
        $appointmentDate = [];
        $appointmentTime = [];
        $half_hours_total = [];

        $half_hours_total = (strtotime($timeEnd)-strtotime($timeStart))/(60*30);
        $half_hours_total = abs($half_hours_total); 
        $half_hours_total = floor($half_hours_total);

        $turns[0] = date("H:i:s", strtotime($timeStart));

        for($i=1;$i<$half_hours_total;$i++){
            $turns[$i] = date("H:i:s", strtotime($timeStart)+(60*30*$i));
        }

        $appointmentDate = Appointment::where('companyId', $companyId)
                                        ->where('branchOfficeId', $branchofficeId)
                                        ->where('date', $dateCurrent)
                                        ->get();

        foreach($appointmentDate as $key_appointmentDate=>$value_appointmentDate){
            $key_turn = array_search($value_appointmentDate->time, $turns);
            unset($turns[$key_turn]);
        }     

        return $turns;
    }

    public function showTime(Request $request){
        $companies = [];
        $branchoffices = [];
        $times = [];
        $timesCurrent = [];
        
        $companyId = $request->query('companyId','false');
        $branchofficeId = $request->query('branchofficeId','false');
        $dateCurrent = $request->query('date','false');
        $timesCurrent = $request->query('time','false');

        if(($companyId!='false')&&($companyId!='')&&($companyId!=NULL)&&
        ($branchofficeId!='false')&&($branchofficeId!='')&&($branchofficeId!=NULL)&&
        ($dateCurrent!='false')&&($dateCurrent!='')&&($dateCurrent!=NULL)&&
        ($timesCurrent!='false')&&($timesCurrent!='')&&($timesCurrent!=NULL)){
         

            $companieSelect = Company::find($companyId);
            $branchofficeSelect =  Branchoffice::find($branchofficeId);
           
            return  view('appointments.editCustomer',['companieSelect'=>$companieSelect, 'branchofficeSelect'=>$branchofficeSelect,'dateCurrent'=>$dateCurrent,'timesCurrent'=>$timesCurrent]);      
        
        }else{
            $companiesEnable = [];
            $companiesCounter = [];
            $companieSelect = [];
            $branchofficeEnable = [];
            $branchofficeCounter = [];
            $branchofficeSelect = [];

            $companiesEnable = Company::all();

            foreach($companiesEnable as $key_companiesEnable=>$value_companiesEnable){
                    if($companyId != ($value_companiesEnable->id)){
                        $companiesCounter[$key_companiesEnable] = $value_companiesEnable->id;
                    }
            }    
            
            $companieSelect = Company::find($companyId);
            $companies = Company::whereIn('id', $companiesCounter)->get();

            $branchofficeEnable = Branchoffice::where('companyId', $companyId)->get();


            foreach($branchofficeEnable as $key_branchofficeEnable=>$value_branchofficeEnable){
                if($branchofficeId != ($value_branchofficeEnable->id)){ 
                    $branchofficeCounter[$key_branchofficeEnable] = $value_branchofficeEnable->id;
                }
            }    
            
            $branchofficeSelect =  Branchoffice::find($branchofficeId);
            $branchoffices = Branchoffice::whereIn('id', $branchofficeCounter)->get();
          
            $times = AppointmentController::arrayTime( $branchofficeSelect->startTime , $branchofficeSelect->endTime, $companyId, $branchofficeId, $dateCurrent);

            return  view('appointments.editTime',['companies'=>$companies,'companieSelect'=>$companieSelect, 'branchofficeSelect'=>$branchofficeSelect,'times'=>$times, 'dateCurrent'=>$dateCurrent],['branchoffices'=>$branchoffices]);      
        
        }
    }

    public function showDate(Request $request){
        $companies = [];
        $branchoffices = [];
        $times = [];
        
        $companyId = $request->query('companyId','false');
        $branchofficeId = $request->query('branchofficeId','false');
        $dateCurrent = $request->query('date','false');

        if(($companyId!='false')&&($companyId!='')&&($companyId!=NULL)&&
        ($branchofficeId!='false')&&($branchofficeId!='')&&($branchofficeId!=NULL)&&
        ($dateCurrent!='false')&&($dateCurrent!='')&&($dateCurrent!=NULL)){

            $companiesEnable = [];
            $companiesCounter = [];
            $companieSelect = [];
            $branchofficeEnable = [];
            $branchofficeCounter = [];
            $branchofficeSelect = [];

            $companiesEnable = Company::all();

            foreach($companiesEnable as $key_companiesEnable=>$value_companiesEnable){
                    if($companyId != ($value_companiesEnable->id)){
                        $companiesCounter[$key_companiesEnable] = $value_companiesEnable->id;
                    }
            }    
            
            $companieSelect = Company::find($companyId);
            $companies = Company::whereIn('id', $companiesCounter)->get();

            $branchofficeEnable = Branchoffice::where('companyId', $companyId)->get();


            foreach($branchofficeEnable as $key_branchofficeEnable=>$value_branchofficeEnable){
                if($branchofficeId != ($value_branchofficeEnable->id)){ 
                    $branchofficeCounter[$key_branchofficeEnable] = $value_branchofficeEnable->id;
                }
            }    
            
            $branchofficeSelect =  Branchoffice::find($branchofficeId);
            $branchoffices = Branchoffice::whereIn('id', $branchofficeCounter)->get();
          
            $times = AppointmentController::arrayTime( $branchofficeSelect->startTime , $branchofficeSelect->endTime, $companyId, $branchofficeId, $dateCurrent);

            return  view('appointments.editTime',['companies'=>$companies,'companieSelect'=>$companieSelect, 'branchofficeSelect'=>$branchofficeSelect,'times'=>$times, 'dateCurrent'=>$dateCurrent],['branchoffices'=>$branchoffices]);      
        }
    }

    public function showBranchOffices(Request $request)
    {
        $companies = [];
        $branchoffices = [];
        $dateCurrent = [];
        $times = [];

        $companyId = $request->query('companyId','false');
        $branchofficeId = $request->query('branchofficeId','false');
        $dateCurrent = $request->query('date','false');

       if(($companyId!='false')&&($companyId!='')&&($companyId!=NULL)&&
          ($branchofficeId=='false')||($branchofficeId=='')||($branchofficeId==NULL)){
             
            $companiesEnable = [];
            $companiesCounter = [];
            $companieSelect = [];
            $companiesEnable = Company::all();

            foreach($companiesEnable as $key_companiesEnable=>$value_companiesEnable){
                    if($companyId != ($value_companiesEnable->id)){
                        $companiesCounter[$key_companiesEnable] = $value_companiesEnable->id;
                    }
            }    
            
            $companieSelect = Company::find($companyId);
            $companies = Company::whereIn('id', $companiesCounter)->get();

            $branchoffices = Branchoffice::where('companyId', $companyId)->get();
            
            return  view('appointments.editBranchoffice',['companies'=>$companies,'companieSelect'=>$companieSelect,'times'=>$times],['branchoffices'=>$branchoffices]);      
       }

        if(($companyId!='false')&&($companyId!='')&&($companyId!=NULL)&&
        ($branchofficeId!='false')&&($branchofficeId!='')&&($branchofficeId!=NULL))
        {
          
            $companiesEnable = [];
            $companiesCounter = [];
            $companieSelect = [];
            $branchofficeEnable = [];
            $branchofficeCounter = [];
            $branchofficeSelect = [];

            $companiesEnable = Company::all();

            foreach($companiesEnable as $key_companiesEnable=>$value_companiesEnable){
                    if($companyId != ($value_companiesEnable->id)){
                        $companiesCounter[$key_companiesEnable] = $value_companiesEnable->id;
                    }
            }    
            
            $companieSelect = Company::find($companyId);
            $companies = Company::whereIn('id', $companiesCounter)->get();

            $branchofficeEnable = Branchoffice::where('companyId', $companyId)->get();


            foreach($branchofficeEnable as $key_branchofficeEnable=>$value_branchofficeEnable){
                if($branchofficeId != ($value_branchofficeEnable->id)){
                    $branchofficeCounter[$key_branchofficeEnable] = $value_branchofficeEnable->id;
                }
            }    
            
            $branchofficeSelect =  Branchoffice::find($branchofficeId);
            $branchoffices = Branchoffice::whereIn('id', $branchofficeCounter)->get();
          
            $times = AppointmentController::arrayTime( $branchofficeSelect->startTime , $branchofficeSelect->endTime, $companyId, $branchofficeId, $dateCurrent);

            date_default_timezone_set('America/Merida');
            
            $dateCurrent = date('Y-m-d', strtotime(date('Y-m-d')."+ 1 days"));
 

            return  view('appointments.editDate',['companies'=>$companies,'companieSelect'=>$companieSelect, 'branchofficeSelect'=>$branchofficeSelect,'times'=>$times, 'dateCurrent'=>$dateCurrent],['branchoffices'=>$branchoffices]);      
        }

    }
     
    public function showCompany(){
        $companies = [];
        $branchoffices = [];
        $times = [];

        $companies = Company::all();
        return  view('appointments.edit',['companies'=>$companies, 'times'=>$times],['branchoffices'=>$branchoffices]);      
    }

    public function assignUser(Request $request,$id)
    {
        $userId = $request->query('userId','false');

        if(($userId!='false')&&($userId!='')&&($userId!=NULL)&&($id!=NULL)&&($id!='')){
            
            $registerAssign = Registerappointment::where('appointmentId',$id)->get();

            $register = Registerappointment::findOrFail($registerAssign[0]->id);
            $register->delete();
        
            Registerappointment::create([
                'userId' => $userId,
                'appointmentId' => $id
            ]);

        return redirect()->route('appointments.branchoffice.index'); 
        }
    }

    public function showByInformationBranchOffices()
    { 
        $companyRegister = [];
        $appointments = [];
        $appointmentRegister = [];
        $appointmentsByCompany = [];
        $appointmentsForId = [];
        $appointmentId = [];
        $appointmentsByBranchOffices = [];
        $apporintmentsBranchOffices = [];
        $branchOfficcesregister = [];
        $branchOfficesByUser = [];
        $branchOffice = [];
        $users = [];

        $user=Auth::user();
       
        $branchOfficcesregister = Registerbranchoffices::where('userId', $user->id)->get();
        $branchOfficesByUser = Registerbranchoffices::where('branchOfficeId',$branchOfficcesregister[0]->branchOfficeId)->get();
        $appointments = Appointment::where('branchOfficeId', $branchOfficcesregister[0]->branchOfficeId)
                                    ->orderBy('id','DESC')
                                    ->paginate(10);

        foreach($appointments as $key_appointments=>$value_appointments){
            $appointmentsByCompany[$key_appointments] = Company::find($value_appointments->companyId);
            $appointments[$key_appointments]->companies = $appointmentsByCompany[$key_appointments];
        
            $appointmentsByBranchOffices[$key_appointments] = Branchoffice::find($value_appointments->branchOfficeId);
            $appointments[$key_appointments]->branchoffices = $appointmentsByBranchOffices[$key_appointments];
        
            $appointmentsForId[$key_appointments] = $value_appointments->id;
        }

        $appointmentRegister = Registerappointment::whereIn('appointmentId', $appointmentsForId)->get();

        foreach($appointmentRegister as $key_appointmentRegister=>$value_appointmentRegister){
            $appointmentId[$key_appointmentRegister] = $value_appointmentRegister->appointmentId;
        }
    
        foreach($appointments as $key_appointments=>$value_appointments){ 
            if( in_array($value_appointments->id,$appointmentId)){
                $appointments[$key_appointments]->register = Registerappointment::where('appointmentId', $value_appointments->id)->get();
                $appointments[$key_appointments]->user = User::find($appointments[$key_appointments]->register[0]->userId);
            }else{
                $appointments[$key_appointments]->register = NULL;
                $appointments[$key_appointments]->user = NULL;
            }
        }
       
        foreach($branchOfficesByUser as $key_branchOfficesByUser=>$value_branchOfficesByUser){
            $branchOffice[$key_branchOfficesByUser] = $value_branchOfficesByUser->userId;
        }
        
        $users = User::whereIn('id',$branchOffice)
                        ->where('jobTitle', 'empleado')
                        ->get();

        return  view('appointments.indexSup',['appointments'=>$appointments],['users'=>$users]);      
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

    public function appointment(Request $request){
        $companyId = $request->query('companyId','false');
        $branchofficeId = $request->query('branchofficeId','false');
        $dateCurrent = $request->query('date','false');
        $timesCurrent = $request->query('time','false');

        $companieSelect = Company::find($companyId);
        $branchofficeSelect =  Branchoffice::find($branchofficeId);
           
        return  view('appointments.editCustomer',['companieSelect'=>$companieSelect, 'branchofficeSelect'=>$branchofficeSelect,'dateCurrent'=>$dateCurrent,'timesCurrent'=>$timesCurrent]);          
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $appointment = $request->only('companyId','branchofficeId',
        'date','time','nameCustomer', 'telephoneCustomer','emailCustomer');

        $validation= Validator::make($appointment,[
            'companyId'=>'required',
            'branchofficeId'=>'required',
            'date'=>'required',
            'time'=>'required',
            'nameCustomer' => 'required',
            'telephoneCustomer'=>'required',
            'emailCustomer'=>'required'
        ]);
 

        if($validation->fails()){
            return redirect()->route('appointments.information',['companyId'=>$appointment['companyId'], 'branchofficeId'=>$appointment['branchofficeId'], 'date'=>$appointment['date'], 'time' =>$appointment['time'] ])
            ->withErrors($validation)
            ->withInput();
        }

        Appointment::create([
            'companyId'=>$appointment['companyId'],
            'branchOfficeId'=>$appointment['branchofficeId'],
            'date'=>$appointment['date'],
            'time'=>$appointment['time'],
            'nameCustomer' => $appointment['nameCustomer'],
            'telephoneCustomer'=> $appointment['telephoneCustomer'],
            'emailCustomer'=> $appointment['emailCustomer']
        ]);

        return redirect()->route('home.index');
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
