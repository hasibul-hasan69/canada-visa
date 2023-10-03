@section('title','Company List')
@extends('layout.backend.master')
@section('content')
<section class="content">
      <div class="container-fluid">
      	<div class="row col-12 mt-4 d-flex flex-row-reverse">
      		<a href="#" class="btn btn-primary " data-toggle="modal" data-target="#company-add-form">
      			<i class="fa fa-home"></i> Add New Company
      		</a>
      	</div>
        <div class="row mt-2">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header ">
                <h3 class="card-title">Company List</h3>

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
                      <th class="text-center">Company Name</th>
                      <th class="text-center">Phone</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Address</th>
                      <th class="text-center">Header</th>
                      <th class="text-center">Footer</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($dataList as $key=>$dataInfo)
                    <tr>
                      <td class="text-center">{{++$key}}</td>
                      <td class="text-center">{{$dataInfo->name}}</td>
                      <td class="text-center">{{$dataInfo->phone}}</td>
                      <td style="white-space: normal;" class="text-center">{{$dataInfo->email}}</td>
                      <td style="white-space: normal;" class="text-center">
                      	{!!$dataInfo->address!!}<br>
                      </td>
                     <td class="text-center">
                     	<img src="{{$dataInfo->header}}" style="width:150px; height: 50px;">
                     	
                     </td>
                      <td class="text-center">
                      	<img src="{{$dataInfo->footer}}" style="width:150px; height:50px;">
                      </td>
                      <td class="text-center">
                         
                          <a href="#" class="btn btn-warning btn-sm " data-toggle="modal" data-target="#company-edit-form" onclick="editDataInfo('{{$dataInfo}}')">
                          	<i class="fa fa-edit"></i> Edit
                        	</a>
                          <a href="{{route('admin.company.delete',['dataId'=>$dataInfo->id])}}" class="btn btn-danger btn-sm">
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


      <div class="modal fade " id="company-edit-form">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Company Info</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <div class="row ">
		          <div class="col-12">
		            
		              <!-- /.card-header -->
		              <!-- form start -->
		              <form class="form-horizontal" action="{{route('admin.company.update')}}" method="post"  enctype="multipart/form-data">
		              @csrf 
		                <div class="card-body">
		                  <div class="form-group row">
		                  	<input type="hidden" name="dataId" id="dataId">
		                    <label for="inputEmail3" class="col-sm-2 col-form-label">Company Name</label>
		                    <div class="col-sm-10">
		                      <input type="text" class="form-control" name="name" placeholder="Company Name" required id="name">
		                    </div>
		                  </div>
		                  <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Company Phone</label>
		                    <div class="col-sm-10">
		                      <input type="text" class="form-control" name="phone" placeholder="Phone " required id="phone">
		                    </div>
		                  </div>
		                  <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Company Email</label>
		                    <div class="col-sm-10">
		                      <input type="email" class="form-control" name="email" placeholder="Email " required id="email">
		                    </div>
		                  </div><div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Company Website</label>
		                    <div class="col-sm-10">
		                      <input type="text" class="form-control" name="website" placeholder="Website " id="website">
		                    </div>
		                  </div>

		                  
		                  <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
		                    <div class="col-sm-10">
		                      <textarea class="form-control" rows="4" name="address" placeholder="Address" required id="address"></textarea>
		                    </div>
		                  </div>

		                  <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Header Image</label>
		                    <div class="col-sm-10">
		                      <input type="file" class="form-control" name="headerImage" placeholder="Email " >
		                    </div>
		                  </div>

		                  <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Footer Image</label>
		                    <div class="col-sm-10">
		                      <input type="file" class="form-control" name="footerImage" placeholder="Email " >
		                    </div>
		                  </div>
		                  <div class=" row col-12 ">
		                    <button type="submit" class="btn btn-info float-right">Update</button>
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



		<div class="modal fade " id="company-add-form">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Company Info</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <div class="row ">
		          <div class="col-12">
		            
		              <!-- /.card-header -->
		              <!-- form start -->
		              <form class="form-horizontal" action="{{route('admin.company.add')}}" method="post"  enctype="multipart/form-data">
		              @csrf 
		                <div class="card-body">
		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-2 col-form-label">Company Name</label>
		                    <div class="col-sm-10">
		                      <input type="text" class="form-control" name="name" placeholder="Company Name" required>
		                    </div>
		                  </div>
		                  <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Company Phone</label>
		                    <div class="col-sm-10">
		                      <input type="text" class="form-control" name="phone" placeholder="Phone " required>
		                    </div>
		                  </div>
		                  <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Company Email</label>
		                    <div class="col-sm-10">
		                      <input type="email" class="form-control" name="email" placeholder="Email " required>
		                    </div>
		                  </div><div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Company Website</label>
		                    <div class="col-sm-10">
		                      <input type="text" class="form-control" name="website" placeholder="Website " >
		                    </div>
		                  </div>

		                  
		                  <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
		                    <div class="col-sm-10">
		                      <textarea class="form-control" rows="4" name="address" placeholder="Address" required></textarea>
		                    </div>
		                  </div>

		                  <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Header Image</label>
		                    <div class="col-sm-10">
		                      <input type="file" class="form-control" name="headerImage" placeholder="Email " required>
		                    </div>
		                  </div>

		                  <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-2 col-form-label">Footer Image</label>
		                    <div class="col-sm-10">
		                      <input type="file" class="form-control" name="footerImage" placeholder="Email " required>
		                    </div>
		                  </div>
		                  <div class=" row col-12 ">
		                    <button type="submit" class="btn btn-info float-right">Save</button>
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
		$('#website').val(dataInfo.website);
		$('#address').val(dataInfo.address);

	}
</script>
@endsection

