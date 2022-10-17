@extends('admin_layout')
@section('admin_content')
<style type="text/css">
	p.title-statistical {
		text-align: center;
		font-size: 20px;
		font-weight: bold;
		color: whitesmoke;
	}
	label.label{
		font-size: 16px;
		color: #000000;
	}
	.statistical-content-sales input{
		margin: 5px 0;
	}

	table.table.table-bordered.table-dark{
		background: rgb(187, 207, 7);
		border: 1px solid #ccc;

	}

	table.table.table-bordered.table-dark thead{
		background: #000;
	}

	.table>thead>tr>th, .table>tfoot>tr>th, .table>thead>tr>td,.table>tfoot>tr>td {
		font-size: 0.9em;
		color: #fff;
		border-top: none !important;
	}
	.table>tbody>tr>th,.table>tbody>tr>td{
		color: #000 !important
	}

	.list-views li a{
		color:rgb(187, 207, 7);
	}

	.list-views li span{
		font-weight: bold;
	}
	p.t-list{
		text-align: left;
	}
</style>
<div class="container-fluid">
	<div class="row statistical-content-sales">
		<p class="title-statistical">THỐNG KÊ DOANH SỐ BÁN HÀNG</p>
		<form autocomplete="off">
			@csrf
			<div class="col-md-2">
				<label class="label" for="#datepicker_from">Từ ngày</label>
				<input type="text" id="datepicker_from" class="form-control"></p>
				<input type="button" id="btn_dashboard_filter" class="btn btn-success btn-sm" value="Lọc kết quả">
			</div>
			<div class="col-md-2">
				<label class="label" for="#datepicker_to">Đến ngày</label>
				<input type="text" id="datepicker_to" class="form-control"></p>
			</div>
			<div class="col-md-4">
				<label class="label" for=".select-doashboard-filter">Lọc theo</label>
				<select class="form-control select-dashboard-filter">
					<option>--Chọn--</option>
					<option value="7ngayqua">7 ngày qua</option>
					<option value="thangtruoc">Tháng trước</option>
					<option value="thangnay">Tháng này</option>
					<option value="365ngayqua">365 ngày qua</option>
				</select>
			</div>
		</form>
		<div class="col-md-12 col-xs-12">
			<div id="sales_chart" style="height: 250px"></div>
		</div>
	</div>
	<div class="row statistical-content-access">
		<p class="title-statistical">THỐNG KÊ SỐ LƯỢNG TRUY CẬP</p>
		<table class="table table-bordered table-dark table-responsive">
			<thead>
			  <tr>
				<th scope="col">Đang online</th>
				<th scope="col">Tổng tháng trước</th>
				<th scope="col">Tổng tháng này</th>
				<th scope="col">Tổng 1 năm</th>
				<th scope="col">Tổng truy cập</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				  <td>{{$visitor_online_count}}</td>
				  <td>{{$visitor_of_lastMonth_count}}</td>
				  <td>{{$visitor_of_thisMonth_count}}</td>
				  <td>{{$visitor_of_one_year_count}}</td>
				  <td>{{$visitor_total}}</td>
			  </tr>
			  <tr></tr>
			</tbody>
		  </table>
	</div>
	<div class="row statistical-content-admins">
		<div class="col-md-4 col-xs-12">
			<p class="title-statistical">THỐNG KÊ DỊCH VỤ QUẢN LÝ</p>
			<div id="admins_chart" style="height: 250px"></div>
		</div>
		<div class="col-md-4 col-xs-12">
			<p class="title-statistical t-list">TOP 20 SẢN PHẨM XEM NHIỀU</p>
			<ol class="list-views">
				@foreach ($products_top_views as $product)
				<li>
					<a target="_blank" href="{{url('/chi-tiet-san-pham/'.$product->product_slug)}}">{{$product->product_name}}</a> |
					<span>{{number_format($product->product_views,0,',','.')}}</span>
				</li>
				@endforeach
			</ol>
		</div>
		<div class="col-md-4 col-xs-12">
			<p class="title-statistical t-list">TOP 20 BÀI VIẾT XEM NHIỀU</p>
			<ol class="list-views">
				@foreach ($posts_top_views as $post)
				<li>
					<a target="_blank" href="{{url('/noi-dung-blog/'.$post->post_slug)}}">{{$post->post_title}}</a> |
					<span>{{number_format($post->post_views,0,',','.')}}</span>
				</li>
				@endforeach
			</ol>
		</div>
	</div>

</div>

@endsection