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
                  <legend class="text-center">Editing Pizza Information</legend>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('upload/'.$pizza->image) }}" class="img-thumbnail my-3" width="200px">
                    </div>
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" method="post" action="{{ route('admin#updatePizza',$pizza->pizza_id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"  placeholder="Name" name="name" value="{{ old('name',$pizza->pizza_name) }}">
                            @if($errors->has('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control"  placeholder="Name" name="image">
                              @if($errors->has('image'))
                              <p class="text-danger">{{ $errors->first('image') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control"  placeholder="Enter Price" name="price" value="{{ old('price',$pizza->price) }}">
                              @if($errors->has('price'))
                              <p class="text-danger">{{ $errors->first('price') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Publish Status</label>
                            <div class="col-sm-10">
                              <select name="publish" class="form-control">
                                @if ($pizza->publish_status == 1)
                                    <option value="1" selected>Publish</option>
                                    <option value="0">Unpublish</option>
                                @else
                                    <option value="1" >Publish</option>
                                    <option value="0" selected>Unpublish</option>
                                @endif
                              </select>
                              @if($errors->has('publish'))
                              <p class="text-danger">{{ $errors->first('publish') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select name="category" class="form-control">
                                    <option value="{{ $pizza -> category_id }}">{{ $pizza->category_name }}</option>
                                    @foreach($category as $item)
                                        @if($item -> category_id != $pizza->category_id)
                                            <option value="{{ $item->category_id }}">{{ $item->category_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                              @if($errors->has('category'))
                              <p class="text-danger">{{ $errors->first('category') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Discount</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control"  placeholder="Discount price" name="discount" value="{{ old('discount',$pizza->discount_price) }}">
                              @if($errors->has('discount'))
                              <p class="text-danger">{{ $errors->first('discount') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Buy 1 Get 1</label>
                            <div class="col-sm-10 mt-2">
                                @if ($pizza->buy_one_get_one_status ==1)
                                    <input type="radio" name="buyOneGetOne" class="form-input-check" value="1" checked>Yes
                                    <input type="radio" name="buyOneGetOne" class="form-input-check" value="0">No
                                @else
                                    <input type="radio" name="buyOneGetOne" class="form-input-check" value="1">Yes
                                    <input type="radio" name="buyOneGetOne" class="form-input-check" value="0" checked>No
                                @endif

                              @if($errors->has('buyOneGetOne'))
                              <p class="text-danger">{{ $errors->first('buyOneGetOne') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Waiting Time</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control"  placeholder="Enter waiting time" name="waitingTime" value="{{ old('waitingTime',$pizza->waiting_time) }}">
                              @if($errors->has('waitingTime'))
                              <p class="text-danger">{{ $errors->first('waitingTime') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                              <textarea name="description"  rows="3" class="form-control" placeholder="Enter description">{{ old('description',$pizza->description) }}</textarea>
                              @if($errors->has('description'))
                              <p class="text-danger">{{ $errors->first('description') }}</p>
                              @endif
                            </div>
                          </div>



                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white">Update</button>
                          </div>
                        </div>
                      </form>

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
