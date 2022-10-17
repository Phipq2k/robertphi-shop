<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CityModel;
use App\Models\FeeshipModel;
use App\Models\ProvinceModel;
use App\Models\WardsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class DeliveryController extends Controller
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

    public function deliveryManage(Request $request){
        $this->authLogin();
        $city = CityModel::orderby('ma_tp','ASC')->get();
        return view('admin.delivery.addDelivery')->with(compact('city'));
    }

    public function selectDelivery(Request $request){
        $this->authLogin();
        $data = $request->all();
        $output = '';
        if($data['action']){
            if($data['action'] == "city"){
                $selectProvince = ProvinceModel::where('ma_tp',$data['maId'])->orderby('ma_qh','ASC')->get();
                $output = '<option>--Chọn quận / huyện--</option>';
                foreach($selectProvince as $key => $province){
                    $output.='<option value="'.$province->ma_qh.'">'.$province->name_qh.'</option>';
                }
            
            }
            else{
                $selectWard = WardsModel::where('ma_qh',$data['maId'])->orderby('xa_id','ASC')->get();
                $output = '<option>--Chọn xã / phường--</option>';

                foreach($selectWard as $key => $ward){
                    $output.='<option value="'.$ward->xa_id.'">'.$ward->name_xa.'</option>';
                }
            }
        }
        
        echo $output;
    }

    public function addDelivery(Request $request){
        $this->authLogin();
        $data = $request->all();
        $feeShip = new FeeshipModel();
        $feeShip->fee_mtp = $data['city'];
        $feeShip->fee_mqh = $data['province'];
        $feeShip->fee_xaid = $data['ward'];
        $feeShip->fee_feeship = $data['feeShip'];
        $feeShip->save();
    }

    public function selectFeeShip(){
        $feeShip = FeeshipModel::orderby('fee_id','desc')->get();
        $output = '';
        $output .= '<div class="table-responsive">
            <table class="table table-bordered">
                <thread>
                    <tr>
                        <th>Tên tỉnh / thành phố</th>
                        <th>Tên quận / huyện</th>
                        <th>Tên xã / phường</th>
                        <th>Phí vận chuyển</th>
                    </tr>
                </thread>
                <tbody>';
                foreach($feeShip as $key => $fee){
        $output .='
                    <tr>
                        <td>'.$fee->cityModel->name_tp.'</td>
                        <td>'.$fee->provinceModel->name_qh.'</td>
                        <td>'.$fee->wardModel->name_xa.'</td>
                        <td id="'.$fee->fee_id.'" contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee feeship_edit">'.number_format($fee->fee_feeship,0,',','.').' '.'VND'.'</td>
                    </tr>
                ';
                }
        $output .= '
                </tbody>
            </table>';
        $output .= '</div>';
        echo $output; 
    }

    public function updateFeeShip(Request $request){
        $this->authLogin();
        $data = $request->all();
        $feeShip = FeeshipModel::find($data['feeshipId']);
        $feeValue = rtrim($data['feeValue'],'.');
        $feeShip->fee_feeship = $feeValue;
        $feeShip->save();

    }
}
