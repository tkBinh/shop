@extends('master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">{{$productType->name}}</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{route('trang-chu')}}">Trang chủ</a> / <span>{{$productType->name}}</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-3">
                        <ul class="aside-menu">
                            @foreach($productTypeList as $itemProductTypeList)
                                <li><a href="{{route('loaisanpham', $itemProductTypeList->id)}}">{{$itemProductTypeList->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-9">
                        <div class="beta-products-list">
                            <h4>{{$productType->name}}</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{count($productByType)}}</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach($productByType as $itemProductByType)
                                    <div class="col-sm-4">
                                        <div class="single-item">
                                            @if($itemProductByType->promotion_price != 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{route('chitietsanpham', $itemProductByType->id)}}"><img
                                                            src="source/image/product/{{$itemProductByType->image}}"
                                                            alt="" height="320px" width="270px"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$itemProductByType->name}}</p>
                                                <p class="single-item-price">
                                                    @if($itemProductByType->promotion_price != 0)
                                                        <span class="flash-del">{{number_format($itemProductByType->unit_price)}}</span>
                                                        <span class="flash-sale">{{number_format($itemProductByType->promotion_price)}}</span>
                                                    @elseif($itemProductByType->promotion_price == 0)
                                                        <span>{{number_format($itemProductByType->unit_price)}}</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="shopping_cart.html"><i
                                                            class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{route('chitietsanpham', $itemProductByType->id)}}">Details <i
                                                            class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Sản phẩm khác</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{count($productNotByType)}} sản phẩm khác</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @foreach($productNotByType as $itemProductNotByType)
                                    <div class="col-sm-4">
                                        <div class="single-item">
                                            @if($itemProductNotByType->promotion_price != 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{route('chitietsanpham', $itemProductNotByType->id)}}"><img
                                                            src="source/image/product/{{$itemProductNotByType->image}}"
                                                            alt="" height="320px" width="270px"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$itemProductNotByType->name}}</p>
                                                <p class="single-item-price">
                                                    @if($itemProductNotByType->promotion_price != 0)
                                                        <span class="flash-del">{{number_format($itemProductNotByType->unit_price)}}</span>
                                                        <span class="flash-sale">{{number_format($itemProductNotByType->promotion_price)}}</span>
                                                    @elseif($itemProductNotByType->promotion_price == 0)
                                                        <span>{{number_format($itemProductNotByType->unit_price)}}</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="shopping_cart.html"><i
                                                            class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{route('chitietsanpham', $itemProductNotByType->id)}}">Details <i
                                                            class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                {{$productNotByType->links()}}
                            </div>
                            <div class="space40">&nbsp;</div>

                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
