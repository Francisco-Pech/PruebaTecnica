<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Branchoffice;
use App\Models\Registerbranchoffices;
use App\Models\Registercompany;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showByUsername(Request $request){
        $Username=$request->query('Username');
        $user=User::where('username',$Username)->select('username')->first();
        return $user;
    }

    public function branchofficessearch(Request $request)
    {
        $branchofficeId = $request->query('branchofficeId','false');

        $user=Auth::user();
        $usersRegister = [];
        $usersRegisterBranchOfffices = [];

        $companyRegister = Registercompany::where('userId', $user->id)->get();
        $branchoffices = Branchoffice::where('companyId', $companyRegister[0]->companyId)->get();
        
        $usersRegister = Registercompany::where('companyId', $companyRegister[0]->companyId)->get();
        
        if(($branchofficeId!='false')&&($branchofficeId!='')&&($branchofficeId!=NULL)){
            $usersRegister = Registerbranchoffices::where('branchOfficeId', $branchofficeId)->get();
        } 
        
        foreach($usersRegister as $key_usersRegister=>$value_usersRegister){
            $usersRegisterBranchOfffices[$key_usersRegister]=$value_usersRegister->userId;
        }

        $users = User::whereIn('id', $usersRegisterBranchOfffices)
                        ->orderBy('id','DESC')
                        ->paginate(10);

        return  view('users.branchoffices',['users'=>$users, 'branchofficeId'=>$branchofficeId],['branchoffices'=>$branchoffices]);
    }

    public function search(Request $request)
    {
        $companies = [];
        $companiesForUser = [];
        $usersForCompanies = [];
        $usersForRegister = [];
        $usersRegister = [];

        $companyId = $request->query('companyId','false');
        $search = $request->query('search','false');

        $user=Auth::user();
        $companyRegister = Registercompany::where('userId', $user->id)->get();
       
        foreach( $companyRegister as $key_companyRegister=>$value_companyRegister){
            $companiesForUser[$key_companyRegister] = $value_companyRegister->companyId;
        }
        
        if(($companyId!='false')&&($companyId!='')&&($companyId!=NULL)&&($search!='false')&&($search!='')&&($search!=NULL)){
            $usersForRegister = Registercompany::where('companyId', $companyId)->get();
        }else{
            $usersForRegister = Registercompany::whereIn('companyId', $companiesForUser)->get();
        }
        
        foreach( $usersForRegister as $key_usersForRegister=>$value_usersForRegister){
            $usersRegister[$key_usersForRegister] = $value_usersForRegister->userId;
        }

        if(($companyId!='false')&&($companyId!='')&&($companyId!=NULL)&&($search!='false')&&($search!='')&&($search!=NULL)){
            $users = User::whereIn('id',$usersRegister)->where('name','LIKE','%'.$search.'%');  
        }else{
            $users = User::whereIn('id',$usersRegister);      
        }
        
        $users=$users->orderBy('id','DESC')
                    ->paginate(10);

        $companies = Company::whereIn('id', $companiesForUser)->get();
   
        return view('users.index',['users'=>$users],['companies'=>$companies]); 
            




        //echo $companyId.'<br>';
        echo $search.'<br>';

        return 'fianl';
       
    }

    public function branchofficesindex()
    {
        $branchofficeId = [];
        $usersRegister = [];
        $usersRegisterBranchOfffices = [];

        $user=Auth::user();
        $companyRegister = Registercompany::where('userId', $user->id)->get();
        $branchoffices = Branchoffice::where('companyId', $companyRegister[0]->companyId)->get();     
        $usersRegister = Registercompany::where('companyId', $companyRegister[0]->companyId)->get();
                      
        foreach($usersRegister as $key_usersRegister=>$value_usersRegister){
            $usersRegisterBranchOfffices[$key_usersRegister]=$value_usersRegister->userId;
        }

        $users = User::whereIn('id', $usersRegisterBranchOfffices)
                        ->orderBy('id','DESC')
                        ->paginate(10);

        return  view('users.branchoffices',['users'=>$users, 'branchofficeId'=>$branchofficeId],['branchoffices'=>$branchoffices]);
    }

    public function index()
    {

        $companies = [];
        $companiesForUser = [];
        $usersForCompanies = [];
        $usersForRegister = [];
        $usersRegister = [];


        $user=Auth::user();
        $companyRegister = Registercompany::where('userId', $user->id)->get();
       
        foreach( $companyRegister as $key_companyRegister=>$value_companyRegister){
            $companiesForUser[$key_companyRegister] = $value_companyRegister->companyId;
        }
        
    
        $usersForRegister = Registercompany::whereIn('companyId', $companiesForUser)->get();
                               
        foreach( $usersForRegister as $key_usersForRegister=>$value_usersForRegister){
            $usersRegister[$key_usersForRegister] = $value_usersForRegister->userId;
        }

        $users = User::whereIn('id',$usersRegister)
                    ->orderBy('id','DESC')
                    ->paginate(10);

        $companies = Company::whereIn('id', $companiesForUser)->get();
   
        return view('users.index',['users'=>$users],['companies'=>$companies]); 
    }

    public function storeSup(Request $request)
    {
       $data = $request->only('name','lastName',
       'age','email','telephone','username', 'branchofficeId',
       'password', 'repeatPassword');

       $validation= Validator::make($data,[
           'name'=>'required|string',
           'lastName'=>'required|string',
           'age'=>'required|integer',
           'email'=>'required|string',
           'branchofficeId' => 'required|integer',
           'telephone'=>'required|string',
           'username'=>'required|string',
           'password'=>['required',
            Password::min(4)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
            ],
           'repeatPassword'=>'required|same:password',
       ]);

       if($validation->fails()){
           return redirect()->route('users.create.supervisor')
           ->withErrors($validation)
           ->withInput();
       }
       
       $user=Auth::user();
       $users=User::where('username',$data['name'])->exists();
       
       if(!$users){
            if(($user->jobTitle) == 'gerente'){
                $jobTitle = 'supervisor';
            }elseif(($user->jobTitle) == 'supervisor'){
                $jobTitle = 'empleado';
            }
        
            $userCreate = User::create([
                'name' => $data['name'],
                'lastName' => $data['lastName'],
                'age' => $data['age'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'jobTitle' => $jobTitle,
                'username' => $data['username'],
                'password' => Hash::make($data['password'])
            ]);

            Registerbranchoffices::create([
                'userId' =>  $userCreate->id,
                'branchOfficeId' => $data['branchofficeId']
            ]);
            
            $company = Branchoffice::find($data['branchofficeId']);
            
            Registercompany::create([
                'userId' =>  $userCreate->id,
                'companyId' => $company->companyId
            ]);

            return redirect()->route('users.index.branchoffices');      
       }else{
            return redirect()->route('users.create.supervisor');
       }
    }

    public function store(Request $request)
    {
        $data = $request->only('name','lastName',
       'age','email','telephone','username', 'companyId',
       'password', 'repeatPassword');

       $validation= Validator::make($data,[
           'name'=>'required|string',
           'lastName'=>'required|string',
           'age'=>'required|integer',
           'email'=>'required|string',
           'companyId' => 'required|integer',
           'telephone'=>'required|string',
           'username'=>'required|string',
           'password'=>['required',
            Password::min(4)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
            ],
           'repeatPassword'=>'required|same:password',
       ]);

       if($validation->fails()){
           return redirect()->route('users.create')
           ->withErrors($validation)
           ->withInput();
       }
       
       $user=Auth::user();
       $users=User::where('username',$data['name'])->exists();
       
       if(!$users){
            $userCreate = User::create([
                'name' => $data['name'],
                'lastName' => $data['lastName'],
                'age' => $data['age'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'jobTitle' => 'administrador',
                'username' => $data['username'],
                'password' => Hash::make($data['password'])
            ]);

            Registercompany::create([
                'userId' =>  $userCreate->id,
                'companyId' => $data['companyId']
            ]);

            return redirect()->route('users.index');      
       }else{
            return redirect()->route('users.create');
       }
    }

    public function createSup()
    {
        $user =[];
        $companyRegister = [];
        $branchoffices = [];

        $user=Auth::user();
        $companyRegisters = Registercompany::where('userId', $user->id)->get();

        $branchoffices = Branchoffice::where('companyId',$companyRegisters[0]->companyId)->get();
           
        return view('users.createSupervisor',['branchoffices' => $branchoffices]); 
    }

   public function create()
    {
        $user=Auth::user();
        $companyRegisters = Registercompany::where('userId', $user->id)->get();
  
        $companies = [];
        foreach( $companyRegisters as $key_companyRegister=>$value_companyRegister){
            $companies[$key_companyRegister] = Company::find($value_companyRegister->companyId);
            $companyRegisters[$key_companyRegister]->companies = $companies[$key_companyRegister];
        }
       
        return view('users.create',['companyRegisters' => $companyRegisters]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
