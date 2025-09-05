@extends ('admin.layouts.app')

@section('breadcrumb')
 <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Departments</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{route('admin.students.create')}}">Add New</a></li>
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>

@endsection



@section('card') 
<div class="card">
  <div class="card-body">
    @if(Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif


    <div class="card">
    <div class="card-body">
        <h5 class="card-title">All departments</h5>
        <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>name</th>
                          <th>image</th>
                          <th>description</th>
                          
                          <th>actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($departments as $department)
                        <tr>
                          <td>{{$department->id}}</td>
                          <td>{{$department->name}}</td>
                        <td><img height="75" src="{{asset('storage/'.$department->photo)}}" alt="" ></td>
                        <td>{{$department->description}}</td>
                        

                          
                          <td>
                            
                            
                            <a class="btn btn-outline-success" href="{{route('admin.departments.edit_depart',$department->id)}}">edit</a>
                            
                            <form action="{{route('admin.departments.destroy_depart',$department->id)}}" method="post" class="d-inline">

                              @csrf
                              @method('delete')
                              <input type="submit" value="delete" class="btn btn-danger">

                            </form>
                          </td>
                         
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
    </div>



@endsection