<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Company;
use App\Models\Branchoffice;
use App\Models\Registercompany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

/*
use App\Models\Registerbranchoffices;

*/

class BranchofficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();

        $registerCompany = [];
        $branchoffices = [];

        $registerCompany = Registercompany::where('userId', $user->id)->get();
        $branchoffices = Branchoffice::where('companyId',$registerCompany[0]->companyId)
                                        ->orderBy('id','DESC')
                                        ->paginate(10);

        foreach($branchoffices as $key_branchoffices=>$value_branchoffices){
            $branchoffices[$key_branchoffices]->start = substr($value_branchoffices->startTime,0,5);
            $branchoffices[$key_branchoffices]->end = substr($value_branchoffices->endTime,0,5);
        }

        return view('branchoffices.index',['branchoffices'=>$branchoffices]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=Auth::user();

        $registerCompany = [];
        $userForCompanies = [];
        $usersAdministrador = [];
        $companiesForAdministrador = [];
        $companiesForUser = [];
        $companies = [];

        

        $registerCompany = Registercompany::where('userId', $user->id)->get();
        $userForCompanies = Registercompany::where('companyId',$registerCompany[0]->companyId)->get();

        foreach($userForCompanies as $key_userForCompanies=>$value_userForCompanies){
            $usersAdministrador[$key_userForCompanies] = User::where('id',$value_userForCompanies->userId)
                                                                ->where('jobTitle','administrador')
                                                                ->get();
        }

        $companiesForAdministrador = Registercompany::where('userId',$usersAdministrador[0][0]->id )->get();

        foreach($companiesForAdministrador as $key_companiesForAdministrador=>$value_companiesForAdministrador){
            $companiesForUser[$key_companiesForAdministrador] = $value_companiesForAdministrador->companyId;
        }

        $companies = Company::whereIn('id',$companiesForUser)->get();

        return view('branchoffices.create',['companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $branchofficeData = $request->only('address','companyId','startTime','endTime');

       $validation= Validator::make($branchofficeData,[
           'address'=>'required|string',
           'companyId' => 'required|integer',
           'startTime'=>'required',
           'endTime'=>'required'
       ]);

       if($validation->fails()){
           return redirect()->route('branchoffices.create')
           ->withErrors($validation)
           ->withInput();
       }

       $companies=Company::where('id',$branchofficeData['companyId'])->exists();
       
       if($companies){

            Branchoffice::create([
                'address' => $branchofficeData['address'],
                'startTime' => $branchofficeData['startTime'],
                'endTime' => $branchofficeData['endTime'],
                'companyId' => $branchofficeData['companyId']
            ]);

            return redirect()->route('branchoffices.index');
       }else{
            return redirect()->route('branchoffices.create');
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\branchoffice  $branchoffice
     * @return \Illuminate\Http\Response
     */
    public function show(branchoffice $branchoffice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\branchoffice  $branchoffice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branchoffices = [];
        $userForCompanies = [];
        $registerCompanies = [];
        $users = [];
        $companies = [];
        $filterCompanies = [];
        $companiesforUsers = [];
        $companybranchoffices = [];

        $branchoffices = Branchoffice::find($id);
        $companybranchoffices = Company::find($branchoffices->companyId);

        $userForCompanies = Registercompany::where('companyId',$branchoffices->companyId)->get();

        foreach($userForCompanies as $key_userForCompanies=>$value_userForCompanies){
            $registerCompanies[$key_userForCompanies] = $value_userForCompanies->userId;
        }

        $users = User::whereIn('id',$registerCompanies)
                       ->where('jobTitle', 'administrador')
                       ->get();

        $companiesforUsers  = Registercompany::where('userId',$users[0]->id)->get();
    
        foreach($companiesforUsers as $key_companiesforUsers=>$value_companiesforUsers  ){
            if(($companybranchoffices->id) != $value_companiesforUsers->companyId){
                $filterCompanies[$key_companiesforUsers] = $value_companiesforUsers->companyId;
            }   
        }

        $companies = Company::WhereIn('id', $filterCompanies)->get();

        return view('branchoffices.edit',['branchoffices'=>$branchoffices,'companybranchoffices'=>$companybranchoffices],['companies'=>$companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\branchoffice  $branchoffice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $branchofficeData = $request->only('address','companyId','startTime','endTime');

        $validation= Validator::make($branchofficeData,[
           'address'=>'required|string',
           'companyId' => 'required|integer',
           'startTime'=>'required',
           'endTime'=>'required'
        ]);

        if($validation->fails()){
           return redirect()->route('branchoffices.edit',['id'=>$id])
           ->withErrors($validation)
           ->withInput();
        }

        $companies=Company::where('id',$branchofficeData['companyId'])->exists();
       
        if($companies){
 
            $branchoffice= Branchoffice::findOrFail($id);

            $branchoffice->update([
                 'address' => $branchofficeData['address'],
                 'startTime' => $branchofficeData['startTime'],
                 'endTime' => $branchofficeData['endTime'],
                 'companyId' => $branchofficeData['companyId']
             ]);
 
             return redirect()->route('branchoffices.index');
        }else{
             return redirect()->route('branchoffices.edit',['id'=>$id]);
        }

        return 'final';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\branchoffice  $branchoffice
     * @return \Illuminate\Http\Response
     */
    public function destroy(branchoffice $branchoffice)
    {
        //
    }
}
