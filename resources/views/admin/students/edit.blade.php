@extends ('admin.layouts.app')


@section('breadcrumb')
 <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">edit Students</h4>
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

          @section('content')
       
        <div class="card" class="d-inline">
          
          @if(Session::has('msg'))
          <div class="alert alert-success">{{Session::get('msg')}}</div>
          @endif
          

          @if ($errors->any())
          <div class="alert alert-danger">
            
           @foreach($errors->all() as $error)
           <li> {{$error}} </li>
           @endforeach
            
          </div>
          @endif
          
          @endsection

@section('card')


        <!-- Container fluid -->
        <div class="container-fluid">
          <!-- Start Page Content -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                
                <div class="card-body">
                  
                  
                <form class="form-horizontal" action="{{route('admin.students.update',$student->id)}}" enctype="multipart/form-data" method="post">
                  @csrf
                  @method('PUT')

                  <div class="card-body">
                    
                
                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 text-end control-label col-form-label"
                        >name</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          placeholder="Name Here"
                          name="name"
                          value="{{$student->name}}"
                        />
                      </div>
                    </div>
                   
                    <div class="form-group row">
                      <label
                        for="email"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Email</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="email"
                          class="form-control"
                          id="email"
                          placeholder="Email Here"
                          name="email"
                          value="{{$student->email}}"
                        />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="phone"
                        class="col-sm-3 text-end control-label col-form-label"
                        >phone</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="phone"
                          class="form-control"
                          id="phone"
                          placeholder="phone Here"
                          name="phone"
                          value ="{{$student->phone}}"
                        />
                      </div>
                    </div>


                     <div class="form-group row">
                      <label
                        for="photo"
                        class="col-sm-3 text-end control-label col-form-label"
                        >photo</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="file"
                          class="form-control"
                          id="photo"
                          placeholder="photo Here"
                          name="photo"
                          value ="{{$student->photo}}"
                        />
                      </div>
                    </div>
                    
                    
                       
                    <div class="form-group row">
                      <label
                        for="department_id"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Department</label
                      >
                      <div class="col-sm-9">
                        <select class="form-control" name="department_id">

                          @foreach($departments as $department)
                            <option value="{{$department->id}}"
                            @if ($department->id == $student->department_id)
                                selected
                            @endif 
                            >{{$department->name}}</option>
                          @endforeach

                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary">
                        Edit
                      </button>  
                      
                    </div>
                  </div>
                </form>
              </div>
              </div>
            </div>
          </div>
          <!-- End Page Content -->

        </div>
        <!-- End Container fluid -->

@endsection

