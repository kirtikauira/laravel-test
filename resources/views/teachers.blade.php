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
                  <h3>Add Teacher Info</h3>
                </div>
        </div>
        <div class="col-md-4">
          <form action="{{ route('teachers.store') }}" method="POST">
          {!! csrf_field() !!}
          <div class="form-group">
                   <label for="exampleInputEmail1">Name:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" name="name" value="{{old('name')}}">
                    @if ($errors->has('name')) <p class="text-danger">{{ $errors->first('name') }}</p> @endif
        </div>
        <div class="form-group">
                   <label for="exampleInputEmail1">Image:</label>
                    <input type="file" class="form-controls" id="exampleInputimage"  name="stu_image" >
                    @if ($errors->has('file')) <p class="text-danger">{{ $errors->first('file') }}</p> @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="col-md-4  relation-table">
        
        <select name="teacher">
             @foreach ($teacherrel as $teacherrels)
              <option value="{{ $teacherrels->id }}">{{ $teacherrels->name }}</option>
             @endforeach
       </select>
       <select name="student" id="sel_stu">
       <option value="0">- Select -</option>
       </select>
       
        </div>
            <div class="col-md-12">
            @if(count($teachers)>0)
              <div class="card">
                <div class="card-header">
                  <h3>Teachers Info</h3>
                </div>
                <div class="card-body">
                  <ul class="list-group">
                    @foreach ($teachers as $teacher)
                      <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                          {{ $teacher->name }}
                          <span><img src="{{asset('/storage/techimages/'.$teacher->tech_image)}}" width="100px" height="100px"></span>

                          <div class="button-group d-flex">
                            <button type="button" class="btn btn-sm btn-primary mr-1 edit-teacher" data-toggle="modal" data-target="#editTeacherModal" data-id="{{ $teacher->id }}" data-name="{{ $teacher->name }}">Edit</button>

                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
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
              {{$teachers->links()}}
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
     
      $('.edit-teacher').on('click', function() {
       
        var id = $(this).data('id');
        var name = $(this).data('name');
        var url = "{{ url('teachers') }}/" + id;
        $('#editTeacherModal form').attr('action', url);
        $('#editTeacherModal form input[name="name"]').val(name);
      });

      $(function() {
        $('select[name=teacher]').change(function() {
          event.preventDefault();
          var tech_id = this.value;
          if($(this).val() != '')
          {
          $.ajax({
            url: "{{ route('teachers.create') }}" ,
            type:"GET",
          data:{
            tech_id:tech_id,
          },
        success:function(data){
           $('#sel_stu').html(data.html);
        },
       });
      } 
           
            });
        });
    });
    

    </script>  
        