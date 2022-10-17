<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @php
                        $i = 0;
                        @endphp
                        @foreach($slider as $key => $slide)
                        @php
                        $i++;
                        @endphp
                        <li data-target="#slider-carousel" data-slide-to="{{$key}}" class="{{$i == 1 ? 'active' : ''}} "></li>
                        @endforeach
                    </ol>
                    
                    <div class="carousel-inner">
                        @php
                        $i = 0;
                        @endphp
                        @foreach($slider as $key => $slide)
                        @php
                        $i++;
                        @endphp
                        <div class="item {{$i == 1 ? 'active' : ''}} ">
                            <div class="col-sm-6">
                                <h1>{{$slide->slider_name}}</h1>
                                <p>{{$slide->slider_desc}}</p>
                                {{-- <button type="button" class="btn btn-default get">Ghé thăm sản phẩm</button> --}}
                            </div>
                            <div class="col-sm-6">
                                <img src="{{URL::to('storage/app/public/uploads/sliders/'.$slide->slider_image)}}" class="img img-responsive" alt="{{$slide->slider_desc}}"/>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section><!--/slider-->