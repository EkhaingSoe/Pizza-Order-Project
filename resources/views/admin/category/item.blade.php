@extends('admin.layout.app')

@section('contents')
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">

        <div class="row mt-4">
          <div class="col-8 offset-2 mt-4">
            <h3 class="my-3 text-center">{{ $pizza[0]->CategoryName }}</h3>
            <div class="card">
              <div class="card-header">

                <span class="fs-5 ml-5">Total - {{ $pizza->total() }}</span>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Pizza Name</th>
                      <th>Price</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pizza as $item)

                    <tr>
                      <td>{{ $item->pizza_id }}</td>
                      <td>
                        <img src="{{ asset('upload/'.$item->image) }}" width="150px">
                      </td>
                      <td>{{ $item->pizza_name }}</td>
                      <td>{{ $item->price }}</td>
                    </tr>

                    @endforeach

                  </tbody>
                </table>
                {{ $pizza->links() }}
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a href="{{ route('admin#category') }}" >
                    <button class="btn bg-dark text-white">Back</button>
                </a>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection
