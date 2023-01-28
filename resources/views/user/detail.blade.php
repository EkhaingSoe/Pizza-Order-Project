@extends('user.layout.style')

@section('content')
<div class="row mt-5 d-flex justify-content-center">

    <div class="col-4 ">
        <img src="{{ asset('upload/'.$pizza->image) }}" class="img-thumbnail" width="100%">            <br>
        <a href="{{ Route('user#order') }}">
            <button class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i> Buy</button>
        </a>
        <a href="{{ Route('user#index') }}">
            <button class="btn bg-dark text-white" style="margin-top: 20px;">
                <i class="fas fa-backspace"></i> Back
            </button>
        </a>
    </div>
    <div class="col-6">
        <h4>Name</h4>
        <span class="fs-5">{{ $pizza->pizza_name }}</span> <hr>
        <h4>Price</h4>
        <span class="fs-5">{{ $pizza->price }} </span> Kyats<hr>
        <h4>Discount Price</h4>
        <span class="fs-5">{{ $pizza->discount_price }}</span> Kyats <hr>
        <h4>Buy one get one</h4>
        <span class="fs-5">
            @if ($pizza->buy_one_get_one_status)
                Not have
            @else
                Have
            @endif
        </span> <hr>
        <h4>Waiting Time</h4>
        <span class="fs-5">{{ $pizza->waiting_time }}</span> <hr>
        <h4>Description</h4>
        <span class="fs-5">{{ $pizza->description}}</span> <hr>
        <h4 class="text-danger">Total</h4>
        <span class="fs-5 ">{{ $pizza->price-$pizza->discount_price}}</span> Kyats <hr>


    </div>
</div>
@endsection

