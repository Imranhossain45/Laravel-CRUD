@extends('layouts.app')

@section('content')
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active-tab-pane"
                type="button" role="tab">Active Post</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="draft-tab" data-bs-toggle="tab" data-bs-target="#draft-tab-pane" type="button"
                role="tab">Draft</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="trash-tab" data-bs-toggle="tab" data-bs-target="#trash-tab-pane" type="button"
                role="tab">Trash</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="active-tab-pane">

              <div class="card mt-3">
                <div class="card-body">
                  <table class="table">

                    <tr>
                      <th>Id</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Category</th>
                      <th>Body</th>
                      <th>Created_At</th>
                      <th>Action</th>
                    </tr>

                    @forelse ($ativePosts as $post)
                      <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                          <img src="{{ asset('storage/post/' . $post->photo) }}" width="60" alt="">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ Str::limit($post->body, 50, '...') }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>
                          <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                          <a href="{{ route('post.status', $post->id) }}"
                            class=" btn {{ $post->status == 'publish' ? 'btn btn-warning' : 'btn btn-success' }}">{{ $post->status == 'publish' ? 'Draft' : 'Publish' }}</a>

                          <form action="{{ route('post.destroy', $post->id) }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Trash</button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="8">No Post Found!</td>
                      </tr>
                    @endforelse


                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="draft-tab-pane">
              <div class="card mt-3">
                <div class="card-body">
                  <table class="table">

                    <tr>
                      <th>Id</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Category</th>
                      <th>Body</th>
                      <th>Created_At</th>
                      <th>Action</th>
                    </tr>

                    @forelse ($draftPosts as $post)
                      <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                          <img src="{{ asset('storage/post/' . $post->photo) }}" width="60" alt="">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ Str::limit($post->body, 50, '...') }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>
                          <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                          
                          <a href="{{ route('post.status', $post->id) }}"
                            class=" btn {{ $post->status == 'publish' ? 'btn btn-warning' : 'btn btn-success' }}">{{ $post->status == 'publish' ? 'Draft' : 'Publish' }}</a>

                          <form action="{{ route('post.destroy', $post->id) }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Trash</button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="8">No Post Found!</td>
                      </tr>
                    @endforelse


                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="trash-tab-pane">
              <div class="card mt-3">
                <div class="card-body">
                  <table class="table">

                    <tr>
                      <th>Id</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Category</th>
                      <th>Body</th>
                      <th>Created_At</th>
                      <th>Action</th>
                    </tr>

                    @forelse ($trashPosts as $post)
                      <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                          <img src="{{ asset('storage/post/' . $post->photo) }}" width="60" alt="">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ Str::limit($post->body, 50, '...') }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>
                          <a href="{{ route('post.restore', $post->id) }}" class="btn btn-sm btn-success">Restore</a>


                          <form action="{{ route('post.force.delete', $post->id) }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger delete">Delete</button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="8">No Post Found!</td>
                      </tr>
                    @endforelse


                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
@endsection
@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.7/sweetalert2.min.css">
@endsection

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.7/sweetalert2.all.min.js"></script>

  <script>
    $('.delete').on('click', function() {
      var parent = $(this).parent();

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          parent.submit();
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success',
          );
        }
      })
    })
  </script>
@endsection
