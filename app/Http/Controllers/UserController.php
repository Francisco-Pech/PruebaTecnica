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

    public function branchofficessearch(Request $request){
        $branchofficeId = $request->query('branchofficeId','false');

        $user=Auth::user();
        $branchQuery = [];
        $usersForBranchoffices = [];

        $companyRegister = Registercompany::where('userId', $user->id)->get();
        $branchoffices = Branchoffice::where('companyId', $companyRegister[0]->companyId)->get();

       
        if( ($branchofficeId != 'false')&&($branchofficeId != '')&&($branchofficeId != NULL)){
            $branchQuery = $branchofficeId;
        }

        $users = Registerbranchoffices::where('branchOfficeId', $branchQuery)
                                    ->orderBy('id','DESC')
                                    ->paginate(10);

        foreach($users as $key_users=>$value_users){
            $usersForBranchoffices[$key_users] = User::find($value_users->userId);
            $users[$key_users]->data = $usersForBranchoffices[$key_users]; 
        }                            

        return  view('users.branchoffices',['users'=>$users],['branchoffices'=>$branchoffices]);      
    }

    public function search()
    {
        $user=Auth::user();
        
        $search = $request->query('search','false');

        $usersRegisters = [];
        $companies = [];
        $usersFilter = [];
        $companiesForUser = [];
        $usersForCompanies = [];

        $companyRegister = Registercompany::where('userId', $user->id)->get();
    
        foreach( $companyRegister as $key_companyRegister=>$value_companyRegister){
            $companies[$key_companyRegister] = $value_companyRegister->companyId;
        }

        if( ($companyId == "false")||($search == NULL)||($search=='')){
            $usersRegisters = Registercompany::whereIn('companyId', $companies);                    
        }else{
            $users = User::where('name','LIKE','%'.$search.'%')->get();

            foreach($users as $key_user=>$value_user){
                $usersFilter[$key_user] = $value_user->id;
            }

            $usersRegisters = Registercompany::where('companyId', $companyId)
                                            ->whereIn('userId', $usersFilter);
        }

        $usersRegisters = $usersRegisters->where('userId', '!=', $user->id)
                        ->orderBy('id','DESC')
                        ->paginate(10);

                      
        foreach($usersRegisters as $key_users=>$value_users){
                $usersForCompanies[$key_users] = User::find($value_users->userId);
                $usersRegisters[$key_users]->data = $usersForCompanies[$key_users];
        }
                
        $companiesForUser = Company::whereIn('id', $companies)->get();

        return view('users.index',['users'=>$usersRegisters],['companiesForUsers'=>$companiesForUser]); 
    }

    public function branchofficesindex()
    {
        $user=Auth::user();
        $companyRegister = Registercompany::where('userId', $user->id)->get();

        $branchoffices = Branchoffice::where('companyId', $companyRegister[0]->companyId)->get();


        $users = Registerbranchoffices::where('userId', $user->id)
                                        ->orderBy('id','DESC')
                                        ->paginate(10);

        return  view('users.branchoffices',['users'=>$users],['branchoffices'=>$branchoffices]);
      

        // if(($branchoffice=="false")||($branchoffice=="")){
            

        //     return $companyRegister[0]->companyId ;
        // }

        // 
        // $companies = [];
        // $companiesForUser = [];
        // $usersForCompanies = [];

        // foreach( $companyRegister as $key_companyRegister=>$value_companyRegister){
        //     $companies[$key_companyRegister] = $value_companyRegister->companyId;
        // }

        // $users = Registercompany::whereIn('companyId', $companies)
        //                         ->where('userId', '!=', $user->id)
        //                         ->orderBy('id','DESC')
        //                         ->paginate(10);

       
        // foreach($users as $key_users=>$value_users){
        //     $usersForCompanies[$key_users] = User::find($value_users->userId);
        //     $users[$key_users]->data = $usersForCompanies[$key_users];
        // }

        // $companiesForUser = Company::whereIn('id', $companies)->get();

        // return $companiesForUser;
        // 
    }

    public function index()
    {
        $user=Auth::user();
        $companyRegister = Registercompany::where('userId', $user->id)->get();
        $companies = [];
        $companiesForUser = [];
        $usersForCompanies = [];

        foreach( $companyRegister as $key_companyRegister=>$value_companyRegister){
            $companies[$key_companyRegister] = $value_companyRegister->companyId;
        }

        $users = Registercompany::whereIn('companyId', $companies)
                                ->where('userId', '!=', $user->id)
                                ->orderBy('id','DESC')
                                ->paginate(10);

       
        foreach($users as $key_users=>$value_users){
            $usersForCompanies[$key_users] = User::find($value_users->userId);
            $users[$key_users]->data = $usersForCompanies[$key_users];
        }

        $companiesForUser = Company::whereIn('id', $companies)->get();
        
        return view('users.index',['users'=>$users],['companiesForUsers'=>$companiesForUser]); 
    }

    public function store(Request $request)
    {
       $credentials = $request->only('name','lastName',
       'age','email','telephone','username', 'companyId',
       'password', 'repeatPassword');

       $validation= Validator::make($credentials,[
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
       $users=User::where('username',$credentials['name'])->exists();
       
       if(!$users){

            if( ($user->jobTitle) == "administrador"){
                $jobTitle = "gerente";
            }elseif( ($user->jobTitle) == "gerente"){
                $jobTitle = "supervisor";
            }elseif( ($user->jobTitle) == "supervisor"){
                $jobTitle = "empleado";
            }

            $userCreate = User::create([
                'name' => $credentials['name'],
                'lastName' => $credentials['lastName'],
                'age' => $credentials['age'],
                'email' => $credentials['email'],
                'telephone' => $credentials['telephone'],
                'jobTitle' => $jobTitle,
                'username' => $credentials['username'],
                'password' => Hash::make($credentials['password'])
            ]);

            Registercompany::create([
                'userId' =>  $userCreate->id,
                'companyId' => $credentials['companyId']
            ]);
            return redirect()->route('users.index');
       }else{
            return redirect()->route('users.create');
       }
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
