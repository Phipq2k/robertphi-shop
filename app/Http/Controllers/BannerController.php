<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BannerModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
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

    public function addBanner(Request $request){
        $this->authLogin();
        return view('admin.slider.addSlider');
    }

    public function saveBanner(Request $request){
        $this->authLogin();
        $data = $request->all();
        $getImage = $request->file('SliderImage');

        // echo base_path('public/uploads/sliders');

        if($getImage){
            $getNameImage = $getImage->getClientOriginalName();
            $newNameImage = current(explode('.', $getNameImage ));
            $destinationPath = 'public/uploads/sliders';
            $newImage = $newNameImage.rand(0,99).'.'.$getImage->getClientOriginalExtension();
            // Storage::move($newImage, base_path('public/uploads/products'));
            $getImage->storeAs($destinationPath,$newImage);
            $slider = new BannerModel();
            $slider->slider_name = $data['SliderName'];
            $slider->slider_desc = $data['SliderDescription'];
            $slider->slider_status = $data['SliderStatus'];
            $slider->slider_image = $newImage;
            $slider->save();
            Session::put('message','Thêm Banner thành công');
            return Redirect::to('add-banner');
        }
        else{
            Session::put('message','Vui lòng thêm hình ảnh Banner');
            return Redirect::to('add-banner');
        }

        // dd($data);

    }

    public function managerBanner(Request $request){
        $this->authLogin();
        $allSlider = BannerModel::orderBy('slider_id','desc')->get();
        return view('admin.slider.listSlider')->with(compact('allSlider'));
    }

    public function unactiveSlider($sliderId){
        $this->authLogin();
        BannerModel::where('slider_id',$sliderId)->update(['slider_status' =>0]);
        Session::put('message','Không kích hoạt Banner thành công');
        return Redirect::to('/manager-banner');
    }

    public function activeSlider($sliderId){
        $this->authLogin();
        BannerModel::where('slider_id',$sliderId)->update(['slider_status' =>1]);
        Session::put('message','Kích hoạt Banner thành công');
        return Redirect::to('/manager-banner');
    }

    public function deleteSlider($sliderId){
        $this->authLogin();
        $banner = BannerModel::find($sliderId);
        $imageStorage = $banner->slider_image;
        Storage::delete('public/uploads/sliders/'.$imageStorage);
        $banner->delete();
        Session::put('message','Xóa banner thành công');
        return Redirect::back();
    }

}
