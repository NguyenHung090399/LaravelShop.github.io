<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        <?php 
            $carts = \Illuminate\Support\Facades\Session::get('carts');
            $total = 0 ; 


          ?>
        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                @if (is_array($carts))
                    @if (count($carts)!=0)
                        @foreach ($products as $product)
                            @php     
                                $price = $product->price_sale != 0 ? $product->price_sale:$product->price ;  
                                $priceEnd = $price * $carts[$product->id] ; 
                                $total += $priceEnd ; 
                            @endphp
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="{{ $product->file }}" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a href="san-pham/{{ $product->id }}-{{ Str::slug($product->name,'-') }}.html" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    {{ $product->name }}
                                </a>
                                <span class="header-cart-item-info">
                                    {{ $carts[$product->id] }} x {{ number_format($price) }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    @endif
                @endif
            </ul>
            
            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Tổng tiền : {{ number_format($total) }} VNĐ
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="/carts" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        View Cart
                    </a>

                    <a href="/carts" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>