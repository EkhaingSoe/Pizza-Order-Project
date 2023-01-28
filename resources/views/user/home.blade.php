@extends('user.layout.style')

@section('content')
<!-- Page Content-->
<div class="container px-4 px-lg-5" id="home">
    <!-- Heading Row-->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" id="code-lab-pizza" src="https://www.pizzamarumyanmar.com/wp-content/uploads/2019/04/chigago.jpg" alt="..." /></div>
        <div class="col-lg-5">
            <h1 class="font-weight-light" id="about">CODE LAB Pizza</h1>
            <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
            <a class="btn btn-primary" href="#!">Enjoy!</a>
        </div>
    </div>

    <!-- Content Row-->
    <div class="d-flex ">
        <div class="col-3 me-5">
            <div class="">
                <div class="py-5 text-center">
                    <form class="d-flex m-5" action="{{ route('user#searchItem') }}" method="get">
                        @csrf
                        <input class="form-control me-2" type="search" placeholder="Search" name="searchData" aria-label="Search">
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>

                    <div class="">
                        <a class="text-decoration-none text-black" href="{{ Route('user#index') }}"><div class="m-2 p-2">All</div></a>
                        @foreach ($category as $item )
                        <a class="text-decoration-none text-black" href="{{ Route('user#pizzaSearch',$item->category_id) }}"><div class="m-2 p-2">{{ $item->category_name }}</div></a>



                        @endforeach
                    </div>
                    <hr>
                    <form action="{{ route('user#searchPizzaPrice') }}" method="get">
                        <div class="text-center m-4 p-2">
                            <h3 class="mb-3">Start Date - End Date</h3>


                                <input type="date" name="startDate" id="" class="form-control"> -
                                <input type="date" name="endDate" id="" class="form-control">

                        </div>
                        <hr>
                        <div class="text-center m-4 p-2">
                            <h3 class="mb-3">Min - Max Amount</h3>


                                <input type="number" name="minPrice" id="" class="form-control" placeholder="minimum price"> -
                                <input type="number" name="maxPrice" id="" class="form-control" placeholder="maximun price">

                        </div>
                        <button type="submit" class="btn bg-dark text-white">Search</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <div class="row gx-4 gx-lg-5" id="pizza">

                @if($status == 1)
                @foreach ($pizza as $item )
                <div class="col-md-4 mb-5">
                    <div class="card h-100" style="width: 270px">
                        <!-- Sale badge-->
                        @if($item->buy_one_get_one_status==1)
                        <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Buy 1 Get 1</div>
                        @endif
                        <!-- Product image-->
                        <img class="card-img-top" id="pizza_image" src="{{ asset('upload/'.$item->image) }}" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $item->pizza_name }}</h5>
                                <!-- Product price-->
                                {{--  <span class="text-muted text-decoration-line-through">$20.00</span> $18.00  --}}
                                {{ $item->price }}
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ Route('user#pizzaDetail',$item->pizza_id) }}">More Details</a></div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <h3>There is no data...</h3>
                @endif

            </div>
        </div>
    </div>
</div>

<div class="text-center d-flex justify-content-center align-items-center" id="contact">
    <div class="col-4 border shadow-sm ps-5 pt-5 pe-5 pb-2 mb-5">
        {{--  @if(Session::has('contactSuccess'))
        <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
            {{ Session::get('contactSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          </div>

        @endif  --}}
        <h3>Contact Us</h3>

        <form action="{{ route('user#createContact') }}" class="my-4" method="post">
            @csrf
            <input type="text" name="name" value="{{ old('name') }}" class="form-control my-3" placeholder="Name">
            @if($errors->has('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
            <input type="text"  name="email" value="{{ old('email') }}" class="form-control my-3" placeholder="Email">
            @if($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
            <textarea class="form-control my-3" name="message" value="{{ old('message') }}"  rows="3" placeholder="Message"></textarea>
            @if($errors->has('message'))
                            <p class="text-danger">{{ $errors->first('message') }}</p>
            @endif
            <button type="submit" class="btn btn-outline-dark">Send  <i class="fas fa-arrow-right"></i></button>
        </form>
    </div>
</div>
@endsection
