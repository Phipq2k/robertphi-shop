<?php

namespace App\Http\Controllers;

use App\Models\BannerModel;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\CatePostModel;
use App\Models\ContactModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

session_start();



class ContactController extends Controller
{
    public function authLogin(){
        $adminId = Auth::id();
        if($adminId){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }

    //Hiển thị thông tin ra website ra trang chủ
   public function contact(Request $request){
        $contact = ContactModel::first();
        $metaTitle = "Liên hệ";
        $imageOrg = '<img src="'.url('storage/app/public/uploads/logo/'.$contact->contact_image).'" alt="logo" />';
        return view('pages.contact.contact')->with(compact('contact','metaTitle','imageOrg'));
   }

   public function contactInformationPage(){
        $this->authLogin();
        $contact = ContactModel::first();
        if($contact){
            return view('admin.contact.editContactInfo')->with(compact('contact'));
        }
        else{
            return view('admin.contact.addContactInfo');
        }
   }

   public function insertContact(Request $request){
        $this->authLogin();
        $data = $request->all();
        $contact = new ContactModel();
        $contact->contact_info = $data['contact_info'];
        $contact->contact_map = $data['contact_map'];
        $contact->contact_fanpage = $data['contact_fanpage'];

        $getImage = $request->file('contact_images');

       // echo base_path('public/uploads/products');

       if($getImage){
           $getNameImage = $getImage->getClientOriginalName();
           $newNameImage = current(explode('.', $getNameImage ));
           $destinationPath = 'public/uploads/logo';
           $newImage = $newNameImage.rand(0,99).'.'.$getImage->getClientOriginalExtension();
           // Storage::move($newImage, base_path('public/uploads/products'));
           $getImage->storeAs($destinationPath,$newImage);
           $contact->contact_images = $newImage;
           $contact->save();
           Session::put('message','Thêm thông tin trang web thành công');
           return Redirect::back(); 
       }
       else{
           return Redirect::back()->with('message','Vui lòng thêm logo cho trang web');
       }
   }

   public function updateContact(Request $request){
        $this->authLogin();
        $data = $request->all();
        $contact = ContactModel::find($data['id_contact']);
        $contact->contact_info = $data['contact_info'];
        $contact->contact_map = $data['contact_map'];
        $contact->contact_fanpage = $data['contact_fanpage'];

       $getImage = $request->file('contact_images');

       // echo base_path('public/uploads/products');

       if($getImage){
           $getNameImage = $getImage->getClientOriginalName();
           $newNameImage = current(explode('.', $getNameImage ));
           $destinationPath = 'public/uploads/logo';
           $newImage = $newNameImage.rand(0,99).'.'.$getImage->getClientOriginalExtension();
           // Storage::move($newImage, base_path('public/uploads/products'));
           $getImage->storeAs($destinationPath,$newImage);
           $contact->contact_images = $newImage;
           $contact->save();
           Session::put('message','Chỉnh sửa thông tin trang web thành công');
           return Redirect::back(); 
       }
        $contact->save();
        Session::put('message','Chỉnh sửa thông tin trang web thành công');
        return Redirect::back(); 
   }

   public function deleteContact($contactId){
        $this->authLogin();
        $contact = ContactModel::find($contactId);
        $imageStorage = $contact->contact_image;
        Storage::delete('public/uploads/logo/'.$imageStorage);
        return Redirect::back();
   }
}
