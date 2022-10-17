<?php

namespace App\Http\Controllers;

use App\Models\GalleryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
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

    public function gallery($productId){
        $this->authLogin();
        return view('admin.gallery.addGallery')->with(compact('productId'));
    }

    public function selectGallery(Request $request){
        $productId =  $request->pro_id;
        $gallery = GalleryModel::where('product_id', $productId)->get();
        $galleryCount = $gallery->count();
        $output = 
        '<form>';
        $output .= csrf_field();
        $output .= 
        '<table class="table table-hover">';
        $output .= 
        '<thead>
            <tr>
            <th>Số thứ tự</th>
            <th>Tên hình ảnh</th>
            <th>Hình ảnh</th>
            <th>Quản lý</th>
            </tr>
        </thead>
        <tbody>';
        if($galleryCount > 0){
            $i = 0;
            foreach($gallery as $key => $gal){
                $i++;
                $output .= 
                '<tr>
                    <td>'.$i.'</td>
                    <td contenteditable class="edit_gallery_name" data-gal_id = "'.$gal->gallery_id.'" >'.$gal->gallery_name.'</td>
                    <td>
                        <img class = "img-thumbnail" src="'.url('storage/app/public/uploads/gallery/'.$gal->gallery_image).'" height="100px" width="100px"alt="image"/>
                        <input type="file" id="img_gallery_'.$gal->gallery_id.'" name="imgGal" accept="image/*" class = "img-gal"  data-gal_id = "'.$gal->gallery_id.'" width="100px" height="100px"/>
                    </td>
                    <td>
                        <button type="button" data-gal_id = "'.$gal->gallery_id.'" class = "btn btn-danger delete-gal">Xóa</a>
                    </td>
                </tr>';
            }
        }
        else{
            $output .= 
            '<tr>
                <td colspan="4" class = "text-center">Thư viện ảnh đang trống</td>
            </tr>';
        }
        $output .= 
        '</tbody>
        </table>';
        $output .= 
        '</form>';

        return $output;
        // return $gallery->count();

    }

    public function insertGallery(Request $request, $productId){
        $this->authLogin();
        $getImages = $request->file('galleryImages');
        if($getImages){
            foreach ($getImages as $key => $image) {
                $getNameImage = $image->getClientOriginalName();
                $newNameImage = current(explode('.', $getNameImage ));
                $destinationPath = 'public/uploads/gallery';
                $newImage = $newNameImage.rand(0,99).'.'.$image->getClientOriginalExtension();
                // Storage::move($newImage, base_path('public/uploads/products'));
                $image->storeAs($destinationPath,$newImage);
                $gallery = new GalleryModel();
                $gallery->gallery_name = $newImage;
                $gallery->gallery_image = $newImage;
                $gallery->product_id = $productId;
                $gallery->save();
            }
        }
        return Redirect::back();
    }

    public function updateGalleryName(Request $request){
        $this->authLogin();
        $data = $request->all();
        $galId = $data['galId'];
        $imageName = $data['text'];
        $gallery = GalleryModel::find($galId);
        $gallery->gallery_name = $imageName;
        $gallery->save();
    }

    public function deleteGallery(Request $request){
        $this->authLogin();
        $gallery = GalleryModel::find($request->galId);
        $imageStorage = $gallery->gallery_image;
        Storage::delete('public/uploads/gallery/'.$imageStorage);
        $gallery->delete();
    }

    public function updateGalleryImage(Request $request){
        $this->authLogin();
        $data = $request->all();
        $getImage = $request->file('imgGal');
        $gallery = GalleryModel::find($data['gal_id']);
        $imageStorage = $gallery->gallery_image;
        Storage::delete('public/uploads/gallery/'.$imageStorage);
        $getNameImage = $getImage->getClientOriginalName();
        $newNameImage = current(explode('.', $getNameImage ));
        $destinationPath = 'public/uploads/gallery';
        $newImage = $newNameImage.rand(0,99).'.'.$getImage->getClientOriginalExtension();
        // Storage::move($newImage, base_path('public/uploads/products'));
        $getImage->storeAs($destinationPath,$newImage);
        $gallery->gallery_name = $getNameImage;
        $gallery->gallery_image = $newImage;
        $gallery->save();
    }
}
