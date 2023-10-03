@section('title','Job Holder')
@extends('layout.backend.master')
@section('content')
<section class="content">
      <div class="container-fluid">
      	<div class="row col-12 mt-4 d-flex flex-row-reverse">
      		<a href="#" class="btn btn-primary " data-toggle="modal" data-target="#job-holder-add-form" >
      			<i class="fa fa-user-plus"></i> Add New Job Holder
      		</a>
      	</div>
        <div class="row mt-2">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header ">
                <h3 class="card-title">Job Holder</h3>

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
                      <th class="text-center">Name</th>
                      <th class="text-center">Phone</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Comapny Info</th>
                      <th class="text-center">Approve Date</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($dataList as $key=>$dataInfo)
                    <tr>
                      <td class="text-center">{{++$key}}</td>
                      <td class="text-center">{{$dataInfo->name}}</td>
                      <td class="text-center">{{$dataInfo->phone}}</td>
                      <td class="text-center" style="white-space: normal;">{{$dataInfo->email}}</td>
                      <td class="text-center" style="white-space: normal;">
                      	{!!$dataInfo->companyInfo->name!!}<br>
                      	{!!$dataInfo->companyInfo->phone!!}<br>
                      	{!!$dataInfo->companyInfo->address!!}<br>
                      </td>
                      <td class="text-center">{{date_format(date_create($dataInfo->approveDate),'d F, Y')}}</td>
                      <td class="text-center">
                      	@if($dataInfo->status==1)
                      		<span class="badge badge-warning text-dark">Pending</span>
                      	@elseif($dataInfo->status==2)
                      		<span class="badge badge-success text-light">Approve</span>
                      	@elseif($dataInfo->status==3)
                      		<span class="badge badge-danger text-light">Rejected</span>
                      	@endif
                      </td>
                      <td class="text-center">
                          <a href="{{route('admin.job_seeker.print',['dataId'=>$dataInfo->id])}}" class="btn btn-primary btn-sm" >
                          		<i class="fa fa-print"></i> Print
                        	</a>
                          <a href="#" class="btn btn-warning btn-sm " data-toggle="modal" data-target="#job-holder-edit-form" onclick="editDataInfo('{{$dataInfo}}')">
                          	<i class="fa fa-edit"></i> Edit
                        	</a>
                          <a href="{{route('admin.job_seeker.delete',['dataId'=>$dataInfo->id])}}" class="btn btn-danger btn-sm">
                          	<i class="fa fa-trash"></i> Delete
                        	</a>
                      </td>
                      
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  	<tr>
                  		<th colspan="8" class="float-center">
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


      <div class="modal fade " id="job-holder-edit-form">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Job Seeker Info</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            	 <form class="form-horizontal" action="{{route('admin.job_seeker.update')}}" method="post"  enctype="multipart/form-data">
              
		              @csrf 
		                <div class="card-body">
							<div class="row ">
								<div class="col-6">
					                  <div class="form-group row">
					                  	<input type="hidden" name="dataId" id="dataId">
					                    <label for="inputEmail3" class="col-sm-2 col-form-label">Company</label>
					                    <div class="col-sm-10">
					                     <select class="form-control" required name="companyId" id="companyId">
					                     		<option value="">--Select A Company--</option>
					                     @php($companies=App\Models\Company::orderBy('name','asc')->get())
					                     		@foreach($companies as $key=>$companyInfo)
					                     			<option value="{{$companyInfo->id}}">{{$companyInfo->name}}</option>
					                     		@endforeach
					                     </select>
					                    </div>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputEmail3" class="col-sm-2 col-form-label">Applicant Name</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="name" placeholder="Applicant Name" required id="name">
					                    </div>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Applicant Phone</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="phone" placeholder="Phone " id="phone">
					                    </div>
					                  </div>
														<div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Applicant Email</label>
					                    <div class="col-sm-10">
					                      <input type="email" class="form-control" name="email" placeholder="Email " id="email">
					                    </div>
					                  </div>
														<div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Applicant Passport No</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="passportNo" placeholder="Passport No " id="passportNo">
					                    </div>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Applicant Country</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="country" placeholder="country " required value="Bangladesh" id="country">
					                    </div>
					                  </div>
				                </div>

				                <div class="col-6">
					                  <div class="form-group row">
					                  	
					                    <label for="inputEmail3" class="col-sm-2 col-form-label">Appoint Date</label>
					                    <div class="col-sm-10">
					                     <input type="date" class="form-control" name="appointDate" placeholder="Appoint Date" required id="appointDate">
					                    </div>
					                  </div>
					                  <!--<div class="form-group row">-->
					                  <!--  <label for="inputEmail3" class="col-sm-2 col-form-label">Report Time</label>-->
					                  <!--  <div class="col-sm-10">-->
					                  <!--    <input type="datetime-local" class="form-control" name="reportTime" placeholder="Report Time " required>-->
					                  <!--  </div>-->
					                  <!--</div>-->
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Job Location</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="jobLocation" placeholder="Job Location " required id="jobLocation">
					                    </div>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Designation</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="designation" placeholder="designation " required id="designation">
					                    </div>
					                  </div>
														<div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Salary</label>
					                    <div class="col-sm-10">
					                      <input type="number" class="form-control" name="salary" placeholder="Salary " required step="0.01" id="salary">
					                    </div>
					                  </div>
														<div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Currency</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="currency" placeholder="currency " required id="currency">
					                    </div>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
					                    <div class="col-sm-10">
					                    	<select class="form-control" required name="status" id="status">
					                    		<option value="">-- Select Status--</option>
					                    		<option value="1">Pending</option>
					                    		<option value="2" >Approve</option>
					                    		<option value="3">Rejected</option>
					                    	</select>
					                    </div>
					                  </div>
					                  
				                </div>
							        </div>
							        <div class=" row col-12 ">
		                    <button type="submit" class="btn btn-info float-right">Update</button>
		                  </div>
							    </div>
							  </form>
			


             </div>
			<div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
		    </div>
		</div>
		</div>
		</div>



		<div class="modal fade " id="job-holder-add-form">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Job Seeker Info</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" action="{{route('admin.job_seeker.add')}}" method="post"  enctype="multipart/form-data">
              
		              @csrf 
		                <div class="card-body">
							<div class="row ">
								<div class="col-6">
					                  <div class="form-group row">
					                  	
					                    <label for="inputEmail3" class="col-sm-2 col-form-label">Company</label>
					                    <div class="col-sm-10">
					                     <select class="form-control" required name="companyId">
					                     		<option value="">--Select A Company--</option>
					                     @php($companies=App\Models\Company::orderBy('name','asc')->get())
					                     		@foreach($companies as $key=>$companyInfo)
					                     			<option value="{{$companyInfo->id}}">{{$companyInfo->name}}</option>
					                     		@endforeach
					                     </select>
					                    </div>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputEmail3" class="col-sm-2 col-form-label">Applicant Name</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="name" placeholder="Applicant Name" required>
					                    </div>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Applicant Phone</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="phone" placeholder="Phone " >
					                    </div>
					                  </div>
														<div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Applicant Email</label>
					                    <div class="col-sm-10">
					                      <input type="email" class="form-control" name="email" placeholder="Email " >
					                    </div>
					                  </div>
														<div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Applicant Passport No</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="passportNo" placeholder="Passport No " required>
					                    </div>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Applicant Country</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="country" placeholder="country " required value="Bangladesh">
					                    </div>
					                  </div>
				                </div>

				                <div class="col-6">
					                  <div class="form-group row">
					                  	
					                    <label for="inputEmail3" class="col-sm-2 col-form-label">Appoint Date</label>
					                    <div class="col-sm-10">
					                     <input type="date" class="form-control" name="appointDate" placeholder="Appoint Date" required>
					                    </div>
					                  </div>
					                  <!--<div class="form-group row">-->
					                  <!--  <label for="inputEmail3" class="col-sm-2 col-form-label">Report Time</label>-->
					                  <!--  <div class="col-sm-10">-->
					                  <!--    <input type="datetime-local" class="form-control" name="reportTime" placeholder="Report Time " required>-->
					                  <!--  </div>-->
					                  <!--</div>-->
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Job Location</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="jobLocation" placeholder="Job Location " required>
					                    </div>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Designation</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="designation" placeholder="designation " required>
					                    </div>
					                  </div>
														<div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Salary</label>
					                    <div class="col-sm-10">
					                      <input type="number" class="form-control" name="salary" placeholder="Salary " required step="0.01">
					                    </div>
					                  </div>
														<div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Currency</label>
					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" name="currency" placeholder="currency " required>
					                    </div>
					                  </div>
					                  <div class="form-group row">
					                    <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
					                    <div class="col-sm-10">
					                    	<select class="form-control" required name="status">
					                    		<option value="">-- Select Status--</option>
					                    		<option value="1">Pending</option>
					                    		<option value="2" selected>Approve</option>
					                    		<option value="3">Rejected</option>
					                    	</select>
					                    </div>
					                  </div>
					                  
				                </div>
							        </div>
							        <div class=" row col-12 ">
		                    <button type="submit" class="btn btn-info float-right">Save</button>
		                  </div>
							    </div>
							  </form>
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
		$('#companyId').val(dataInfo.company_info.id);
		$('#name').val(dataInfo.name);
		$('#phone').val(dataInfo.phone);
		$('#email').val(dataInfo.email);
		$('#country').val(dataInfo.country);
		$('#passportNo').val(dataInfo.passportNo);
		$('#appointDate').val(dataInfo.appointDate);
		$('#jobLocation').val(dataInfo.jobLocation);
		$('#designation').val(dataInfo.designation);
		$('#salary').val(dataInfo.salary);
		$('#currency').val(dataInfo.currency);
		$('#status').val(dataInfo.status);
	}
</script>
@endsection

