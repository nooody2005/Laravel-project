@extends ('admin.layouts.app')

@section('breadcrumb')
 <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Students</h4>
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
        <h5 class="card-title">student data</h5>
        <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>name</th>
                          <th>email</th>
                          <th>phone</th>
                          <th>photo</th>
                          <th>department</th>
                          <th>actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$student->id}}</td>
                          <td>{{$student->name}}</td>
                          <td>{{$student->email}}</td>
                          <td>{{$student->phone}}</td>
                          <td><img height="75" src="{{asset('storage/'.$student->photo)}}" alt="" ></td>
                          <td>{{ $student->department_name ?? 'null' }}</td>

                          <td>
                            
   
                          </td>
                         
                        </tr>
                      </tbody>
                    </table>
                  </div>
    </div>



@endsection