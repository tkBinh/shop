@extends('master')
@section('content')
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h4>Tìm kiếm</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{count($product)}} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach($product as $itemProductNew)
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            @if($itemProductNew->promotion_price != 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{route('chitietsanpham', $itemProductNew->id)}}"><img
                                                        src="source/image/product/{{$itemProductNew->image}}"
                                                        alt="" height="320px" width="270px"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$itemProductNew->name}}</p>
                                                <p class="single-item-price">
                                                    @if($itemProductNew->promotion_price != 0)
                                                        <span
                                                            class="flash-del">{{number_format($itemProductNew->unit_price)}}</span>
                                                        <span
                                                            class="flash-sale">{{number_format($itemProductNew->promotion_price)}}</span>
                                                    @elseif($itemProductNew->promotion_price == 0)
                                                        <span>{{number_format($itemProductNew->unit_price)}}</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="{{route('themgiohang',
                                                $itemProductNew->id)}}"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary"
                                                   href="{{route('chitietsanpham', $itemProductNew->id)}}">Chi tiết <i
                                                        class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->
            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection