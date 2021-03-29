@extends('layouts.app')
@section('content')
<div class="row">
@if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Success!</h4>
                <p>{{ Session::get('success') }}</p>

                <button type="button" class="close" data-dismiss="alert aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-md-12">
        <div class="card-header">
                  <h3>Add Student Info</h3>
                </div>
        </div>
        <div class="col-md-4">
          <form action="{{ route('students.store') }}" method="POST">
          {!! csrf_field() !!}
          <div class="form-group">
                   <label for="exampleInputEmail1">Name:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" name="name" value="{{old('name')}}">
                    @if ($errors->has('name')) <p class="text-danger">{{ $errors->first('name') }}</p> @endif
        </div>
        
        <div class="form-group">
        <label for="exampleInputEmail1">Teachers:</label>
            <select class="js-states browser-default select2" name="teacher_id" required id="teacher_id">
            <option value="option_select" disabled selected>Teachers</option>
             @foreach($students as $student)
            <option value="{{ $student->id }}" {{$student->id == $student->id  ? 'selected' : ''}}>{{ $student->name}}</option>
            @endforeach
    </select>
      </div>

      <div class="form-group">
                   <label for="exampleInputEmail1">Image:</label>
                    <input type="file" class="form-controls" id="exampleInputimage"  name="stu_image" >
                    @if ($errors->has('file')) <p class="text-danger">{{ $errors->first('file') }}</p> @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
            <div class="col-md-12">
            @if(count($students)>0)
              <div class="card">
                <div class="card-header">
                  <h3>Student Info</h3>
                </div>
                <div class="card-body">
                  <ul class="list-group">
                    @foreach ($students as $student)
                      <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                          {{ $student->name }}
                          <span><img src="{{asset('/storage/stuimages/'.$student->stu_image)}}" width="100px" height="100px"></span>

                          <div class="button-group d-flex">
                            <button type="button" class="btn btn-sm btn-primary mr-1 edit-student" data-toggle="modal" data-target="#editStudentModal" data-id="{{ $student->id }}" data-name="{{ $student->name }}">Edit</button>

                            <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                              @csrf
                              @method('DELETE')

                              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                          </div>
                        </div>
                     </li>
                    @endforeach
                  </ul>
                </div>
              </div>
              {{$students->links()}}
              @else
        <p>No Posts Found</p>
    @endif
            </div>
            
            </div>
            @endsection
            <script type="text/javascript" 
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
    <script>
    jQuery(document).ready(function(){
     
      $('.edit-student').on('click', function() {
        
        var id = $(this).data('id');
        var name = $(this).data('name');
        var url = "{{ url('students') }}/" + id;
        $('#editStudentModal form').attr('action', url);
        $('#editStudentModal form input[name="name"]').val(name);
    });
    });

    </script>  
        