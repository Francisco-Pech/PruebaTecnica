<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Branchoffice;
use App\Models\Registerbranchoffices;
use App\Models\Registercompany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class CompanyController extends Controller
{
    public function index()
    {
        $user=Auth::user();
    
        $companyRegister = Registercompany::where('userId', $user->id)->get();

        $key_companies = [];
        foreach ($companyRegister as $key_companyRegister=>$value_companyRegister)
        {
            $key_companies[$key_companyRegister] = $value_companyRegister->companyId;
        }

        $branchoffices = [];
        $branchoffices = Branchoffice::whereIn('companyId', $key_companies)
                                    ->orderBy('id','DESC')
                                    ->paginate(10);
       
        $companies = [];
        foreach ($branchoffices as $key_branchoffices=>$value_branchoffices)
        {
            $companies[$key_branchoffices] = Company::find($value_branchoffices->companyId);
            $branchoffices[$key_branchoffices]->companies = $companies[$key_branchoffices];
        }
        
        return view('companies.index',['branchoffices'=>$branchoffices]); 
    }

    public function create()
    {
        return view('companies.create'); 
    }

    public function store(Request $request)
    {
       $companiesInfo = $request->only('name','function','address');

       $validation= Validator::make($companiesInfo,[
           'name'=>'required|string',
           'function'=>'required|string',
           'address'=>'required|string',
       ]);

       if($validation->fails()){
           return redirect()->route('companies.create')
           ->withErrors($validation)
           ->withInput();
       }

       $company=Company::where('name',$companiesInfo['name'])->exists();
       
       if(!$company){
            $company = Company::create([
                'name' => $companiesInfo['name'],
                'address' => $companiesInfo['address'],
                'function' => $companiesInfo['function']
            ]);

            $user=Auth::user();

            Registercompany::create([
                'userId' =>  $user->id,
                'companyId' => $company->id
            ]);

            return redirect()->route('companies.index');
       }else{
            return redirect()->route('companies.create');
       }
    }

    public function show(company $company)
    {
        //
    }

    public function edit(company $company)
    {
        //
    }

    public function update(Request $request, company $company)
    {
        //
    }

    public function destroy(company $company)
    {
        //
    }
}
