@extends('user.layout.style')

@section('content')
<div class="row mt-5 d-flex justify-content-center">

    <div class="col-4 ">
        <img src="{{ asset('upload/'.$pizza->image) }}" class="img-thumbnail" width="100%">            <br>

        <a href="{{ Route('user#index') }}">
            <button class="btn bg-dark text-white" style="margin-top: 20px;">
                <i class="fas fa-backspace"></i> Back
            </button>
        </a>
    </div>
    <div class="col-6">
        @if(Session::has('order'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            Order Success... Please wait {{ Session::get('order') }} minutes...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          </div>

        @endif
        <h4>Name</h4>
        <span class="fs-5">{{ $pizza->pizza_name }}</span> <hr>
        <h4>Price</h4>
        <span class="fs-5">{{ $pizza->price-$pizza->discount_price }} </span> Kyats<hr>
        <h4>Waiting Time</h4>
        <span class="fs-5">{{ $pizza->waiting_time }}</span> <hr>
        <form action="{{ Route('user#orderPlace') }}" method="post">
            @csrf
            <h4>Total Count </h4>
        <input type="number" name="totalCount" class="form-control">
        @if($errors->has('totalCount'))
                            <p class="text-danger">{{ $errors->first('totalCount') }}</p>
                            @endif
        <hr>

        <h4>Payment Method</h4>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="paymentType" id="inlineRadio1" value="1">
            <label for="inlineRadio1" class="form-check-label">Credit</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="paymentType" id="inlineRadio2" value="2">
            <label for="inlineRadio2" class="form-check-label">Cash on deli</label>
        </div>
        @if($errors->has('paymentType'))
        <p class="text-danger">{{ $errors->first('paymentType') }}</p>
        @endif
        <hr>
        <button type="submit" class="btn btn-primary mt-2 col-12"><i class="fas fa-shopping-cart"></i> Order Place</button>
        </form>




    </div>
</div>
@endsection

