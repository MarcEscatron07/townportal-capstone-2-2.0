@section('title', 'Computers')

@section('breadcrumb','/ Computers')

<x-layout>
	<div class="container">
		<div class="row">
			<div class="col">

				@include('partials.panel')

				@if(Auth::user()->userRole->name == "Owner")
				<div class="mb-2 pt-3">	
					<a href="/computers/create" class="btn btn-success rounded-0">Add Computer</a>		
				</div>
				@endif
				<div class="container-shadow">				
					<table class="table">
						<thead class="text-center text-white bg-secondary">
							<tr>							
								<th class="align-middle">Row</th>
								<th class="align-middle">PC No.</th>				
								<th class="align-middle">Desktop</th>				
								<th class="align-middle">
									<div>Peripherals</div>
									<div>
										<sub>(Monitor, Mouse, Keyboard, Headset)
										</sub>
									</div>
								</th>		
								@if(Auth::user()->userRole->name == "Owner")
								<th class="align-middle">Action</th>		
								@endif
							</tr>
						</thead>
						<tbody>
							@if(count($computers) != 0)
								@foreach($computers as $computer)
								<tr class="text-center">							
									<td class="align-middle">{{ $computer->location->row }}</td>
									<td class="align-middle">{{ $computer->pc_number }}</td>
									<td class="align-middle">
										@if($computer->desktop['name'] == "")
											{{ '---' }}
										@else
											{{ $computer->desktop['name'] }}
										@endif
									</td>
									<td class="align-middle">
										@if(count($peripherals) != 0)
											@foreach($peripherals as $peripheral)
												@if($peripheral->computer_id === $computer->id)
													<small>{{ $peripheral->name }}</small>
												@endif
											@endforeach		
										@else
											{{ '---' }}
										@endif						
									</td>
									@if(Auth::user()->userRole->name == "Owner")
									<td class="align-middle">
										<div class="d-flex justify-content-center">										
											<form action="/computers/{{ $computer->id }}/edit" method="GET">
												@csrf

												<button type="submit" class="btn btn-dark mr-1"><i class="fas fa-edit"></i></button>
											</form>											
											<button id="btn_deleteall" type="button" class="delete-btn btn btn-danger" data-toggle="modal" data-target="#deleteComputerModal" data-id="{{ $computer->id }}">
											<i class="fas fa-times"></i>
											</button>
										</div>
									</td>
									@endif
								</tr>	

								<!-- Delete Data Modal -->
								<div class="modal fade" id="deleteComputerModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteComputerModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="dm-header modal-header">
												<h5 class="modal-title" id="deleteComputerModalLabel"><i class="fas fa-exclamation-triangle mr-2"></i><strong>REMOVE COMPUTER</strong></h5>                                                    
											</div>
											<form class="form-delete" action="" method="POST">
												@csrf
												@method('DELETE')

												<div class="modal-body text-center">
													<strong class="d-block">Are you sure you want to remove this computer?</strong>
													<strong class="d-block">
														<sub>[WARNING: This will PERMANENTLY DELETE the devices associated with it]</sub>
													</strong>
													<div class="div-delete collapse mt-4 px-5">
														<div class="form-group m-0 d-flex flex-row align-items-center">
															<div class="w-25 mr-1">
																<label class="m-0">Password:</label>
															</div>
															<div class="w-75 ml-1">
																<input type="password" class="inp-delete form-control" name="deldata_password" placeholder="Enter your password">
																<input type="number" name="deldata_userid" value="{{ Auth::user()->id }}" hidden>
																{{-- <input type="number" name="deldata_userid" value="" hidden> --}}
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn-deleteno btn btn-secondary rounded-0 px-3" data-dismiss="modal">No</button>                                             
													<button type="button" class="btn-deleteyes btn btn-danger rounded-0">Yes</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								@endforeach	
							@else
							<tr class="text-center">
								<td colspan="5"><strong class="text-danger">No data to be shown!</strong></td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>
				<div class="mt-3">
                    @if(count($computers) != 0)
					    {{ $computers->links() }}
                    @endif
				</div>
			</div>
		</div>
	</div>
</x-layout>

@section('script')
<script type="text/javascript">
	let userID = "";

	let deleteBtn = document.querySelectorAll('button.delete-btn');
	let formDelete = document.querySelector('form.form-delete');

    let btnDeleteNo = document.querySelector('button.btn-deleteno');
    let btnDeleteYes = document.querySelector('button.btn-deleteyes');
    let divDeleteCollapse = document.querySelector('div.div-delete');
    let inpDeletePassword = document.querySelector('input.inp-delete');

	deleteBtn.forEach(function(dbtn){
		dbtn.addEventListener('click',function(){
			inpDeletePassword.value = "";
			btnDeleteYes.setAttribute('type','button');	
			formDelete.action = "";
			userID = $(this).attr('data-id');
		});
	});

    btnDeleteNo.addEventListener('click', function(){
        divDeleteCollapse.classList.remove('show');
        btnDeleteNo.innerHTML = 'No';
        btnDeleteYes.innerHTML = 'Yes';
    });

    btnDeleteYes.addEventListener('click', function(){
        divDeleteCollapse.classList.add('show');
        btnDeleteNo.innerHTML = 'Cancel';
        btnDeleteYes.innerHTML = 'Submit';
    });

    inpDeletePassword.addEventListener('keyup', function(){
        if(inpDeletePassword.value != "") {
			formDelete.action = '/computers/'+userID;
            btnDeleteYes.setAttribute('type','submit');
        } else {
            btnDeleteYes.setAttribute('type','button');
        }
    });
</script>
@endsection