@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Books List</div>

          <div class="card-body">
            <a href="{{ route('books.create') }}" class="btn btn-primary">Add new book</a>
            <br> <br>

            <table class="table">
              <tr>
                <th>Title</th>
                <th>Download file</th>
              </tr>
              @forelse ($books as $book)
                <tr>
                  <td>{{ $book->title }}</td>
                  <td><a href="#"></a>{{ $book->book_image }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="2">No books found</td>
                </tr>
              @endforelse
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection