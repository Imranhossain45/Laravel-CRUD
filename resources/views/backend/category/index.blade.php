@extends('layouts.app')

@section('content')
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <table class="table">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Photo</th>
                  <th>Slug</th>
                  <th>Action</th>
                </tr>
                @forelse ($categories as $category)
                  <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                      <img src="{{ asset('storage/category/' . $category->photo) }}" width="60" alt="">
                    </td>
                    <td>{{ $category->slug }}</td>
                    <td>
                      <a href="#">View</a>
                    </td>
                  </tr>
                @empty
                @endforelse
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="">Category Name:</label>
                  <input type="text" name="name" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="">Category Slug:</label>
                  <input type="text" name="slug" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="">Description:</label>
                  <textarea name="description" class="form-control" rows="5"></textarea>
                </div>
                <div class="mb-3">
                  <label for="">Photo(300*300):</label>
                  <input type="file" name="photo" class="form-control">

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
