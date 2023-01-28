@extends('admin.layout.app')

@section('contents')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-10 offset-2 mt-5">
            <div class="col-md-9">
               <a href="{{ route('admin#pizza') }}"><button class="btn bg-dark text_white mb-3">Back</button></a>
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Adding Pizza</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane d-flex justify-content-between px-5" id="activity">
                        <div class="mt-2 text-center px-5 py-5">
                            <img class="img-thumbnail" src="{{ asset('upload/'.$pizza->image) }}" >
                        </div>
                        <div class="px-4">
                            <div class="mt-3 fs-5">
                                <b>Name</b> : <span>{{ $pizza->pizza_name }}</span>
                            </div>
                            <div class="mt-3 fs-5">
                                <b>Price</b> : <span>{{ $pizza->price }}</span>
                            </div>
                            <div class="mt-3 fs-5">
                                <b>Publish Status</b> :
                                <span>
                                    @if($pizza->publish_status == 1)
                                        YES
                                    @else
                                        NO
                                    @endif

                                </span>
                            </div>
                            <div class="mt-3 fs-5">
                                <b>Category</b> : <span>{{ $pizza->category_id }}kyats</span>
                            </div>
                            <div class="mt-3 fs-5">
                                <b>Discount Price</b> : <span>{{ $pizza->discount_price }}</span>
                            </div>
                            <div class="mt-3 fs-5">
                                <b>Buy One Get One</b> :
                                <span>
                                    @if($pizza->buy_one_get_one_status == 1)
                                        YES
                                    @else
                                        NO
                                    @endif
                                </span>
                            </div>
                            <div class="mt-3 fs-5">
                                <b>Waiting Time</b> : <span>{{ $pizza->waiting_time }} minute</span>
                            </div>
                            <div class="mt-3 fs-5">
                                <b>Description</b> : <span>{{ $pizza->description }}</span>
                            </div>
                        </div>

                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


@endsection
