@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Add new book</div>

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <div class="card-body">
            <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            Title:
            <br>
            <input type="text" name="title" class="form-control">

            <br>

            Image/File:
            <br>
            <input type="file" name="book_image" id="">
            <br><br>

            <input type="submit" value="Save book" class="btn btn-success">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection