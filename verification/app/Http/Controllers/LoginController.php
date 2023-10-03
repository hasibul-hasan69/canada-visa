<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\JobSeeker;
use Carbon\Carbon;
use Hash;
use Auth;
use Toastr;
use Session;


class LoginController extends Controller
{
    public function getVisaStaus(Request $request)
    {
        $dataInfo=JobSeeker::with('companyInfo')->where('barCode',$request->dataId)->first();

        if(!empty($dataInfo))
            return view('frontend.visa_status',compact('dataInfo'));
        else
            return view('frontend.not_found');
    }
    public function logout(Request $request)
    {
        Auth::guard('staff')->logout();

        return redirect()->route('home');
    }
    public function loginAttempt(Request $request)
    {

        $userInfo=Staff::where('email',strtolower(trim($request->userName)))->first();

        if(!empty($userInfo)) {

            if(Hash::check($request->password, $userInfo->password)){
                
                if(Auth::guard('staff')->attempt(['email'=>strtolower(trim($request->userName)),'password'=>$request->password])){
                    
                    Session::flash('successMsg',"Logged In Successfully.");

                    return redirect()->route('admin.job_seeker');
                }
                else{
                    
                    Session::flash('errMsg',"Cardential Failed.Please Try Again.");

                    return redirect()->back();
                }
            }
            else{
                
                Session::flash('errMsg',"Wrong Password.Please Enter Valid Password.");

                return redirect()->back();  
            }
        }
        else{

            Session::flash('errMsg',"Invalid Username.Please Enter a Valid Username");

            return redirect()->back();
        }
    }
    public function loginPage(Request $request)
    {
       return view('frontend.login');
    }
    
}
