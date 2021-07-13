<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Redirect;
use Session;
use App\Models\Company;
use App\Models\Employe;

class AdminController extends Controller
{
    function index()
    {
     return view('login');
    }

    function checklogin(Request $request)
    {
     $this->validate($request, [
      'email'   => 'required|email',
      'password'  => 'required|alphaNum|min:3'
     ]);

     $user_data = array(
      'email'  => $request->get('email'),
      'password' => $request->get('password')
     );

     if(Auth::attempt($user_data))
     {
      Session::flash('success', "User Loging Successfully.");
      return redirect('company/list');
     }
     else
     {

      Session::flash('success', "Wrong Login Details.");
      return back()->with('error', 'Wrong Login Details');
     }

    }

    function list()
    {
      // print_r('hvgvg'); die();
      $company=Company::select('*')->get();
     return view('company.listpage',compact('company'));
      }

    function logout()
    {
     Auth::logout();
     return redirect('main');
    }

    public function store(Request $request){
      return view('company.add');

    }

    public function alldata(Request $request){
        $name="";
      $companydata = new Company();
      $companydata->name=$request->get('company');
      $companydata->email=$request->get('email');
      $companydata->website_url=$request->get('link');
    //  print_r($request->file('logo')); die();
      if(!empty($request->file('logo')))
                {

                    $extension = $request->file('logo')->getClientOriginalExtension();
                    $fileNameExt = time();
                    $fileName = $fileNameExt . '.' . $extension;
                    $destinationPath = public_path('/image/');
                    $request->file('logo')->move($destinationPath, $fileName);
                    $imagePath = '/image/'. $fileName;
                    $companydata->logo = $imagePath;
                }
      $companydata->save();
      return redirect::route('list');

    }
       public function edit($id)
       {

         

        $editdata= Company::where('id',$id)->first();
        
       
        return view('company.edit',compact('editdata'));
    
       }
       public function update(Request $request, $id){
       
           
        $updatedata =Company::where('id',$id)->first();
        $updatedata->name=$request->get('company');
        
        $updatedata->email=$request->get('email');
        
        $updatedata->logo=$request->get('logo');
        $updatedata->website_url=$request->get('link');
        
        $updatedata->save();
        return Redirect::route('list');
         }



         public function delete($id){
           $updatedata =Company::where('id',$id)->delete();
           return Redirect::route('list');
           
         }

        public function employeList(){
        $employe=Employe::select('*')->get();
          return view('employe.list',compact('employe'));
        }



        public function employestore(Request $request){
          $company=Company::select('*')->get();

          return view('employe.add',compact('company'));
        }

        public function employedata(Request $request){

          $employedata = new Employe();
       $employedata->first_name=$request->get('name');
      $employedata->last_name=$request->get('lastname');
      $employedata->company_id=$request->get('company_name');
      $employedata->email=$request->get('email');
      $employedata->phone=$request->get('phone');
      $employedata->save();
      return redirect::route('employe.list');

        }
        public function employeedit($id)
        {
          $editdata= Employe::where('id',$id)->first();
          $allcompany=Company::select('*')->get();

          return view('employe.edit',compact('editdata','allcompany'));

        }
        public function employeupdate(Request $request, $id){

        $updatedata =Employe::where('id',$id)->first();
        $updatedata->first_name=$request->get('name');
        
        $updatedata->last_name=$request->get('lastname');
        
        $updatedata->company_id=$request->get('company_name');
        $updatedata->email=$request->get('email');
        $updatedata->phone=$request->get('phone');
        
        $updatedata->save();
        return Redirect::route('employe.list');

        }


         public function employedelete($id){
           $updatedata =Employe::where('id',$id)->delete();
           return Redirect::route('employe.list');
           }      
}



?>