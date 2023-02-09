@extends('layouts.app')

@section('content')

  <section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          @if (Session::has('success'))
            {{ Session::get('success') }}
          @endif
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <div class="card">

            <div class="card-body">
              <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="">Title:</label>
                  <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>

                <div class="mb-3">
                  <label for="">Body:</label>
                  <textarea name="body" class="form-control" rows="5">{{ old('body') }}</textarea>
                </div>
                <div class="mb-3">
                  <label for="">Category:</label>
                  <select name="category" class="form-control">
                    <option selected disabled>Select Category</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="mb-3">
                  <label for="">Photo</label>
                  <input type="file" class="form-control" name="photo">
                </div>
                <div class="mb-3">
                  <input type="submit" class="form-control btn btn-primary">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
