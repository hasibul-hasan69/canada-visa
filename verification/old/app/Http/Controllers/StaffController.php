<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Company;
use App\Models\JobSeeker;
use Auth;
use Carbon\Carbon;
use Session;
use Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Image;
use Hash;


class StaffController extends Controller
{
   public function changePassword (Request $request)
   {
      $profileInfo=Staff::find(Auth::guard('staff')->user()->id);

       if(!empty($profileInfo)) {
       
         if($request->password==$request->conPassword){

            $profileInfo->password=Hash::make($request->password);

            $profileInfo->updated_at=Carbon::now();

            if($profileInfo->save()){
               Session::flash('successMsg','Password Changed Successfully.');
            }
            else{
               Session::flash('warningMsg','Failed To Change Password.Please Try Again.');
            }
         }
         else{
            Session::flash('warningMsg','Confirm Password First.');
         }

         
       }
       else{
         Session::flash('warningMsg','Request Data Not Found.Please Try Again.');
       }
       return redirect()->back(); 
   }
   public function showPassworForm (Request $request)
   {
      return view('backend.change_password_form');
   }
   public function logout(Request $request)
   {
      Auth::guard('staff')->logout();

      return redirect()->route('home');
   }
   public function getJobSeekerList(Request $request)
   {
      $query=JobSeeker::with('companyInfo')->where('status','!=',0);

       if(isset($request->searchKey) && !is_null($request->searchKey)){
         $query->where(function($q) use($request){
            $q->where('name','like','%'.$request->searchKey.'%')
                ->orWhere('email','like','%'.$request->searchKey.'%')
                ->orWhere('phone','like','%'.$request->searchKey.'%');
         });
       }

      $dataList=$query->orderBy('id','desc')->paginate(30);

      return view('backend.job_seeker_list',compact('dataList'));
   }
    
    public function addJobSeekerInfo(Request $request)
    {
      
      $dataInfo=new JobSeeker();

      $dataInfo->name=$request->name;

      $dataInfo->phone=$request->phone;

      $dataInfo->email=$request->email;

      $dataInfo->passportNo=$request->passportNo;

      $dataInfo->companyId=$request->companyId;

      $dataInfo->country=$request->country;

      $dataInfo->appointDate=$request->appointDate;

      $dataInfo->reportTime=date("H:i:s");//$request->reportTime;

      $dataInfo->designation=$request->designation;

      $dataInfo->jobLocation=$request->jobLocation;

      $dataInfo->salary=$request->salary;

      $dataInfo->currency=$request->currency;

      $dataInfo->barCode=substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0,6).uniqid();

      $dataInfo->status=$request->status;

      $dataInfo->created_at=Carbon::now();

      if($dataInfo->save()){
         Session::flash('successMsg','Data Saved Successfully.');
      }
      else{
         Session::flash('warningMsg','Failed To Save Data.Please Try Again.');
      };

      return redirect()->back();
    }
    public function updateJobSeekerInfo(Request $request)
    {
       $dataInfo=JobSeeker::find($request->dataId);

       if(!empty($dataInfo)) {

          $dataInfo->name=$request->name;

          $dataInfo->phone=$request->phone;

          $dataInfo->email=$request->email;

          $dataInfo->passportNo=$request->passportNo;

          $dataInfo->companyId=$request->companyId;

          $dataInfo->country=$request->country;

          $dataInfo->appointDate=$request->appointDate;

          $dataInfo->designation=$request->designation;

          $dataInfo->jobLocation=$request->jobLocation;

          $dataInfo->salary=$request->salary;

          $dataInfo->currency=$request->currency;

          $dataInfo->barCode=substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0,6).uniqid();

          $dataInfo->status=$request->status;

          $dataInfo->updated_at=Carbon::now();

             if($dataInfo->save()){
                Session::flash('successMsg','Data Updated Successfully.');
             }
             else{
                Session::flash('warningMsg','Failed To Update Data.Please Try Again.');
             }
       }
       else{
         Session::flash('warningMsg','Request Data Not Found.Please Try Again.');
       }       
       return redirect()->back();
    }
    public function deleteJobSeekerInfo(Request $request)
    {
       $dataInfo=JobSeeker::find($request->dataId);
       
       $dataInfo->status=0;

       $dataInfo->deleted_at=Carbon::now();

       $dataInfo->save();

       Session::flash('errMsg',"Job Seeker Info Deleted Successfully.");

       return redirect()->back();
    } 
   
   public function getStaffList(Request $request)
   {
      $query=Staff::where('status','!=',0);

       if(isset($request->searchKey) && !is_null($request->searchKey)){
         $query->where(function($q) use($request){
            $q->where('name','like','%'.$request->searchKey.'%')
                ->where('email','like','%'.$request->searchKey.'%')
                ->where('phone','like','%'.$request->searchKey.'%');
         });
       }

      $dataList=$query->orderBy('id','desc')->paginate(30);

      return view('backend.staff_list',compact('dataList'));
   }
    
    public function addStaffInfo(Request $request)
    {
      
      $dataInfo=new Staff();

      $dataInfo->name=$request->name;

      $dataInfo->phone=$request->phone;

      $dataInfo->email=$request->email;

      if(isset($request->password) && !is_null($request->password))
        $dataInfo->password=Hash::make($request->password);

      $dataInfo->created_at=Carbon::now();

        if(isset($request->photo) && !is_null($request->file('photo')))
         {
            $image=$request->file('photo');


             $imageName =  uniqid() . "." . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('staffs')) {

                Storage::disk('public')->makeDirectory('staffs');
            }

            $note_img = Image::make($image)->stream();

            Storage::disk('public')->put('staffs/' . $imageName, $note_img);

            $path = env('APP_URL').'/storage/app/public/staffs/'.$imageName;

            $dataInfo->avatar=$path;

         }

      if($dataInfo->save()){
         Session::flash('successMsg','Data Saved Successfully.');
      }
      else{
         Session::flash('warningMsg','Failed To Save Data.Please Try Again.');
      };

      return redirect()->back();
    }
    public function updateStaffInfo(Request $request)
    {
       $dataInfo=Staff::find($request->dataId);

       if(!empty($dataInfo)) {

         $dataInfo->name=$request->name;

      $dataInfo->phone=$request->phone;

      $dataInfo->email=$request->email;

      if(isset($request->password) && !is_null($request->password))
        $dataInfo->password=Hash::make($request->password);

        if(isset($request->photo) && !is_null($request->file('photo')))
         {
            $image=$request->file('photo');


             $imageName =  uniqid() . "." . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('staffs')) {

                Storage::disk('public')->makeDirectory('staffs');
            }

            $note_img = Image::make($image)->stream();

            Storage::disk('public')->put('staffs/' . $imageName, $note_img);

            $path = env('APP_URL').'/storage/app/public/staffs/'.$imageName;

            $dataInfo->avatar=$path;

         }

          $dataInfo->updated_at=Carbon::now();

         if($dataInfo->save()){
            Session::flash('successMsg','Data Updated Successfully.');
         }
         else{
            Session::flash('warningMsg','Failed To Update Data.Please Try Again.');
         }
       }
       else{
         Session::flash('warningMsg','Request Data Not Found.Please Try Again.');
       }       
       return redirect()->back();
    }
    public function deleteStaffInfo(Request $request)
    {
       $dataInfo=Staff::find($request->dataId);
       
       $dataInfo->status=0;

       $dataInfo->deleted_at=Carbon::now();

       $dataInfo->save();

       Session::flash('errMsg',"Staff Info Deleted Successfully.");

       return redirect()->back();
    } 
   
   public function getCompanyList(Request $request)
   {
      $query=Company::where('status','!=',0);

       if(isset($request->searchKey) && !is_null($request->searchKey)){
         $query->where(function($q) use($request){
            $q->where('name','like','%'.$request->searchKey.'%')
                ->where('email','like','%'.$request->searchKey.'%')
                ->where('phone','like','%'.$request->searchKey.'%');
         });
       }

      $dataList=$query->orderBy('id','desc')->paginate(30);

      return view('backend.company_list',compact('dataList'));
   }
    
    public function addCompanyInfo(Request $request)
    {
      
      $dataInfo=new Company();

      $dataInfo->name=$request->name;

      $dataInfo->phone=$request->phone;

      $dataInfo->email=$request->email;

      $dataInfo->address=$request->address;

      $dataInfo->website=$request->website;

      $dataInfo->created_at=Carbon::now();

      if(isset($request->headerImage) && !is_null($request->file('headerImage')))
         {
            $image=$request->file('headerImage');

             $imageName =  uniqid() . "." . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('staffs')) {

                Storage::disk('public')->makeDirectory('company');
            }

            $note_img = Image::make($image)->stream();

            Storage::disk('public')->put('company/' . $imageName, $note_img);

            $path = env('APP_URL').'/storage/app/public/company/'.$imageName;

            $dataInfo->header=$path;

         }

         if(isset($request->footerImage) && !is_null($request->file('footerImage')))
         {
            $image=$request->file('footerImage');

             $imageName =  uniqid() . "." . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('company')) {

                Storage::disk('public')->makeDirectory('company');
            }

            $note_img = Image::make($image)->stream();

            Storage::disk('public')->put('company/' . $imageName, $note_img);

            $path = env('APP_URL').'/storage/app/public/company/'.$imageName;

            $dataInfo->footer=$path;

         }

      if($dataInfo->save()){
         Session::flash('successMsg','Data Saved Successfully.');
      }
      else{
         Session::flash('warningMsg','Failed To Save Data.Please Try Again.');
      };

      return redirect()->back();
    }
    public function updateCompanyInfo(Request $request)
    {
       $dataInfo=Company::find($request->dataId);

       if(!empty($dataInfo)) {

          $dataInfo->name=$request->name;

          $dataInfo->phone=$request->phone;

          $dataInfo->email=$request->email;

          $dataInfo->address=$request->address;

          $dataInfo->website=$request->website;


          if(isset($request->headerImage) && !is_null($request->file('headerImage')))
             {
                $image=$request->file('headerImage');

                 $imageName =  uniqid() . "." . $image->getClientOriginalExtension();

                if (!Storage::disk('public')->exists('staffs')) {

                    Storage::disk('public')->makeDirectory('company');
                }

                $note_img = Image::make($image)->stream();

                Storage::disk('public')->put('company/' . $imageName, $note_img);

                $path = env('APP_URL').'/storage/app/public/company/'.$imageName;

                $dataInfo->header=$path;

             }

             if(isset($request->footerImage) && !is_null($request->file('footerImage')))
             {
                $image=$request->file('footerImage');

                 $imageName =  uniqid() . "." . $image->getClientOriginalExtension();

                if (!Storage::disk('public')->exists('company')) {

                    Storage::disk('public')->makeDirectory('company');
                }

                $note_img = Image::make($image)->stream();

                Storage::disk('public')->put('company/' . $imageName, $note_img);

                $path = env('APP_URL').'/storage/app/public/company/'.$imageName;

                $dataInfo->footer=$path;

             }

          $dataInfo->updated_at=Carbon::now();

             if($dataInfo->save()){
                Session::flash('successMsg','Data Updated Successfully.');
             }
             else{
                Session::flash('warningMsg','Failed To Update Data.Please Try Again.');
             }
       }
       else{
         Session::flash('warningMsg','Request Data Not Found.Please Try Again.');
       }       
       return redirect()->back();
    }
    public function deleteCompanyInfo(Request $request)
    {
       $dataInfo=Company::find($request->dataId);
       
       $dataInfo->status=0;

       $dataInfo->deleted_at=Carbon::now();

       $dataInfo->save();

       Session::flash('errMsg',"Company Info Deleted Successfully.");

       return redirect()->back();
    }
    public function printJobSeekerInfo(Request $request)
    {
         $dataInfo=JobSeeker::with('companyInfo')->where('id',$request->dataId)->first();

         // return view('backend.job_seeker_info',compact('dataInfo'));
         // return view('backend.test_pdf',compact('dataInfo'));

         $pdf = Pdf::loadView('backend.job_seeker_info', compact('dataInfo'));
         // $pdf = Pdf::loadView('backend.test_pdf', compact('dataInfo'));
         $pdf->setPaper('A4');
         return $pdf->download($dataInfo->name.'.pdf');
    }
}
