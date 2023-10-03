@section('title','Staff List')
@extends('layout.backend.master')
@section('content')
<section class="content">
      <div class="container-fluid">
      	<div class="row col-12 mt-4 d-flex flex-row-reverse">
      		<a href="#" class="btn btn-primary " data-toggle="modal" data-target="#staff-add-form" >
      			<i class="fa fa-user-plus"></i> Add New Company
      		</a>
      	</div>
        <div class="row mt-2">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header ">
                <h3 class="card-title">Company Listr</h3>

                <div class="card-tools">
                	<form action="" method="get">
                  <div class="input-group input-group-sm" style="width: 150px;">
                  	
                    <input type="text" class="form-control float-right" placeholder="Search" name="searchKey" value="{{old('searchKey')}}">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  
                  </div>
                </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th class="text-center">Sl/No</th>
                      <th class="text-center">Photo</th>
                      <th class="text-center"> Name</th>
                      <th class="text-center">Phone</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($dataList as $key=>$dataInfo)
                    <tr>
                      <td class="text-center">{{++$key}}</td>
                      <td class="text-center">
                     	<img src="{{$dataInfo->avatar}}" style="width:100px; height: 100px; border: 1px solid green; border-radius: 5%;">
                     </td class="text-center">
                      <td class="text-center">{{$dataInfo->name}}</td>
                      <td class="text-center">{{$dataInfo->phone}}</td>
                      <td style="white-space: normal;" class="text-center">{{$dataInfo->email}}</td>
                      
                      <td class="text-center">
                         
                          <a href="#" class="btn btn-warning btn-sm " data-toggle="modal" data-target="#staff-edit-form" onclick="editDataInfo('{{$dataInfo}}')">
                          	<i class="fa fa-edit"></i> Edit
                        	</a>
                          <a href="{{route('admin.staff.delete',['dataId'=>$dataInfo->id])}}" class="btn btn-danger btn-sm">
                          	<i class="fa fa-trash"></i> Delete
                        	</a>
                      </td>
                      
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  	<tr>
                  		<th  class="float-center">
                  			{!! $dataList->links()!!}
                  		</th>
                  	</tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->


      <div class="modal fade " id="staff-edit-form">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Staff Info</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <div class="row ">
	          <div class="col-12">
	            
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form class="form-horizontal" action="{{route('admin.staff.update')}}" method="post"  enctype="multipart/form-data">
	              @csrf 
	                <div class="card-body">
	                 
	                  <div class="form-group row">
	                  	<input type="hidden" name="dataId" id="dataId">
	                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" name="name" placeholder=" Name" required id="name">
	                    </div>
	                  </div>
	                  <div class="form-group row">
	                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
	                    <div class="col-sm-10">
	                      <input type="email" class="form-control" name="email" placeholder=" Email" required id="email">
	                    </div>
	                  </div>
	                  <div class="form-group row">
	                    <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
	                    <div class="col-sm-10">
	                      <input type="text" class="form-control" name="phone" placeholder="Phone " required id="phone">
	                    </div>
	                  </div>

	                  <div class="form-group row">
	                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
	                    <div class="col-sm-10">
	                      <input type="password" class="form-control" name="password" placeholder="Password "  id="password">
	                    </div>
	                  </div>
										 <div class="form-group row">
	                    <label for="inputPassword3" class="col-sm-2 col-form-label">Photo</label>
	                    <div class="col-sm-10">
	                      <input type="file" class="form-control" name="photo" placeholder="photo " >
	                    </div>
	                  </div>

	                  <div class=" row col-12 float-right">
	                    <button type="submit" class="btn btn-info ">Update</button>
	                  </div>
	                </div>
	            </form>
		        </div>
		    </div>
			</div>
			<div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
		    </div>
		</div>
		</div>
		</div>



		<div class="modal fade " id="staff-add-form">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Staff Info</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <div class="row ">
		          <div class="col-12">
		            
		              <!-- /.card-header -->
		              <!-- form start -->
		              <form class="form-horizontal" action="{{route('admin.staff.add')}}" method="post"  enctype="multipart/form-data">
		              @csrf 
		                <div class="card-body">
		                 
		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
		                    <div class="col-sm-10">
		                      <input type="text" class="form-control" name="name" placeholder=" Name" required>
		                    </div>
		                  </div>
		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
		                    <div class="col-sm-10">
		                      <input type="email" class="form-control" name="email" placeholder=" Email" required>
		                    </div>
		                  </div>
		                  <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
		                    <div class="col-sm-10">
		                      <input type="text" class="form-control" name="phone" placeholder="Phone " required>
		                    </div>
		                  </div>

		                  <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
		                    <div class="col-sm-10">
		                      <input type="password" class="form-control" name="password" placeholder="Password " required>
		                    </div>
		                  </div>
											 <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Photo</label>
		                    <div class="col-sm-10">
		                      <input type="file" class="form-control" name="photo" placeholder="photo " >
		                    </div>
		                  </div>

		                  <div class=" row col-12 float-right">
		                    <button type="submit" class="btn btn-info ">Save</button>
		                  </div>
		                </div>
		            </form>
			        </div>
			    </div>
			</div>
			<div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
		    </div>
		</div>
		</div>
		</div>


    </section>
@endsection

@section('customJs')
<script type="text/javascript">
function editDataInfo(dataInfo){

		dataInfo=JSON.parse(dataInfo.replace(/\s+/g,""));
		// console.dir(dataInfo);
		$('#dataId').val(dataInfo.id);
		$('#name').val(dataInfo.name);
		$('#phone').val(dataInfo.phone);
		$('#email').val(dataInfo.email);

	}
</script>
@endsection

