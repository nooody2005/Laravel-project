@extends ('admin.layouts.app')


@section('breadcrumb')
 <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Add Department</h4>
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


        @section('content')
       
        <div class="card" class="d-inline">
          
          @if(Session::has('msg'))
          <div class="alert alert-success">{{Session::get('msg')}}</div>
          @endif
          

       
          
          @endsection
     
          @endsection

@section('card')


        <!-- Container fluid -->
        <div class="container-fluid">
          <!-- Start Page Content -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                
                <div class="card-body">
                  
                  
                <form class="form-horizontal" action="{{route('admin.departments.store_depart')}}" enctype="multipart/form-data" method="post">
                  @csrf
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
                          placeholder="department name Here"
                          name="name"
                          value=""
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
                          placeholder="department photo Here"
                          name="photo"
                          value=""
                        />
                      </div>
                    </div>

                    
                     <div class="form-group row">
                      <label
                        for="description"
                        class="col-sm-3 text-end control-label col-form-label"
                        >description</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="description"
                          placeholder="department description Here"
                          name="description"
                          value=""
                        />
                      </div>
                    </div>
                   
                    
                       
                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary">
                        Add
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

