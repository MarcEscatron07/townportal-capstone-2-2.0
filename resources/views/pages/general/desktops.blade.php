@section('title', 'Desktops')

@section('breadcrumb','/ Desktops')

<x-layout>
	<div class="container">
		<div class="row">
			<div class="col">
				
				@include('partials.panel')

				{{-- @if(Auth::user()->userRole->name == "Owner")
				<div class="d-flex flex-row justify-content-between mb-2 pt-3">
					<a href="/desktops/create" class="btn btn-success rounded-0">Add Desktop</a>
					<button id="btn_deleteall" type="button" class="btn btn-danger rounded-0" data-toggle="modal" data-target="#deleteAllModal">
					DELETE ALL
					</button>
				</div>
				@endif --}}
				<div class="container-shadow">				
					<table class="table">
						<thead class="text-center text-white bg-secondary">
							<tr>							
								<th class="align-middle">#</th>
								<th class="align-middle">
									<div>Assigned</div>
									<div>Computer</div>
								</th>
								<th class="align-middle">Name</th>				
								<th class="align-middle">Brand</th>				
								<th class="align-middle">Serial No.</th>
								{{-- @if(Auth::user()->userRole->name == "Owner" || Auth::user()->userRole->name == "Manager")
								<th class="align-middle">Cost</th>
								<th class="align-middle">Purchase Date</th>
								@endif --}}
								<th class="align-middle">Status</th>						
								{{-- @if(Auth::user()->userRole->name == "Owner")
								<th class="align-middle">Action</th>		
								@endif --}}
							</tr>
						</thead>
						<tbody>
							@if(count($desktops) != 0)
								@foreach($desktops as $index => $desktop)
								<tr class="text-center">
									<td class="align-middle"><strong>{{ ++$index }}</strong></td>
									<td class="align-middle">{{ $desktop->computer->location->row.$desktop->computer->pc_number }}</td>
									<td class="align-middle">{{ $desktop->name }}</td>
									<td class="align-middle">{{ $desktop->brand }}</td>		
									<td class="align-middle">{{ $desktop->serial_number }}</td>
									{{-- @if(Auth::user()->userRole->name == "Owner" || Auth::user()->userRole->name == "Manager")
									<td class="align-middle">{{ "₱".number_format($desktop->cost, 2) }}</td>			
									<td class="align-middle">{{ $desktop->purchase_date }}</td>
									@endif --}}
									<td class="align-middle">
										<div class="d-flex justify-content-center">
											{{-- @if(Auth::user()->userRole->name == "Owner" || Auth::user()->userRole->name == "Manager")
											<select class="us-desktop form-control auto-width">
											@else --}}
											<select class="us-desktop form-control auto-width" disabled>
											{{-- @endif --}}
												@foreach($statuses as $status)
													@if($status->id == $desktop->status->id)
														<option value="{{ $status->id }}" selected>{{ $desktop->status->name }}</option>
													@else
														<option value="{{ $status->id }}">{{ $status->name }}</option>
													@endif
												@endforeach
											</select>		
											<input type="number" data-id="{{ $desktop->id }}" hidden>
										</div>
									</td>						
									{{-- @if(Auth::user()->userRole->name == "Owner")
									<td class="align-middle">
										<div class="d-flex justify-content-center">
											<form action="/desktops/{{ $desktop->id }}/edit" method="GET">
												@csrf

												<button type="submit" class="btn btn-dark mr-1"><i class="fas fa-edit"></i></button>
											</form>
											<button type="button" class="delete-btn btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal" data-id="{{ $desktop->id }}"><i class="fas fa-dumpster"></i></button>
										</div>
									</td>
									@endif	 --}}
								</tr>			

								<!-- Delete Modal -->
								<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="dm-header modal-header">
												<h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-exclamation-triangle mr-2"></i><strong>DESKTOP DISPOSAL</strong></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body text-center">
											<strong>Are you sure you want to set this item for disposal?</strong>
											</div>
											<div class="modal-footer">
												<form class="form-delete" action="" method="POST">
												@csrf
												@method('DELETE')

													<button type="submit" class="btn btn-danger font-weight-bold px-4 rounded-0">YES</button>
												</form>	
											</div>
										</div>
									</div>
								</div>
								@endforeach	
							@else
							<tr class="text-center">
								<td colspan="10"><strong class="text-danger">No data to be shown!</strong></td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>
				<div class="mt-3">
                    @if(count($desktops) != 0)
					    {{ $desktops->links() }}
                    @endif
				</div>

				<!-- Delete All Modal -->
				<div class="modal fade" id="deleteAllModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteAllModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="dm-header modal-header">
								<h5 class="modal-title" id="deleteAllModalLabel"><i class="fas fa-exclamation-triangle mr-2"></i><strong>DELETE ALL</strong></h5>                                                    
							</div>
							{{-- <form action="/desktops/delete/all/{{ Auth::user()->id }}" method="POST"> --}}
							<form action="" method="POST">
								@csrf
								@method('DELETE')

								<div class="modal-body text-center">
									<strong>Are you sure you want to delete ALL data?</strong>
									<div class="collapse mt-4 px-5" id="deleteAllCollapse">
										<div class="form-group m-0 d-flex flex-row align-items-center">
											<div class="w-25 mr-1">
												<label class="m-0" for="deleteall_password">Password:</label>
											</div>
											<div class="w-75 ml-1">
												<input id="deleteall_password" type="password" class="form-control" name="delall_password" placeholder="Enter your password">
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" id="btn_delallno" class="btn btn-secondary rounded-0 px-3" data-dismiss="modal">No</button>                                             
									<button type="button" id="btn_delallyes" class="btn btn-danger rounded-0">Yes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-layout>

@section('script')
<script type="text/javascript">
	let deleteBtn = document.querySelectorAll('button.delete-btn');
	let formDelete = document.querySelector('form.form-delete');

	deleteBtn.forEach(function(dbtn){
		dbtn.addEventListener('click',function(){
			formDelete.action = '/desktops/'+$(this).attr('data-id');
		});
	});
</script>

<script type="text/javascript">
	//This will load all the DOM element of the page
	document.addEventListener('DOMContentLoaded', function(event){
		let desktopStatus = document.querySelectorAll('select.us-desktop');

		// each add to cart button will have an event listener called 'click'
		desktopStatus.forEach(function(sel){
			sel.addEventListener('change', function(){
				let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
				// console.log(token);
				// let itemname = sel.getAttribute('data-itemname'); //works with data-id as well
				// console.log(itemname);
				// let itemids = sel.getAttribute('data-id'); 
				// let itemID = sel.dataset.id;
				let statusID = sel.value;	
				let desktopID = sel.nextElementSibling.dataset.id;

				//url, method, data, csrf token
				let url = '/desktops/status/'+statusID+'/desktop/'+desktopID;

				let data = new FormData;
				data.append('statusID', statusID);
				data.append('desktopID', desktopID);
				data.append('_token', token);
				// when using PUT,PATCH,DELETE
				data.append('_method', 'PATCH');
				fetch(url, {
					method: 'POST',
					credentials: 'same-origin',
					body: data
					// if not using PUT, PATCH, DELETE, use the code below
					// headers: {
					// 	"X-CSRF-TOKEN": token
					// }					
				}).then((res) => {
					return res.text();
				}).then((data) => {
					console.log(data);

					let counterSpan = document.querySelector('span.maintenance-count');
                    if(data == '0') {
						counterSpan.setAttribute('hidden', true);
                    } else {
                        counterSpan.removeAttribute('hidden');
						counterSpan.innerHTML = data;
                    }

					// document.location.reload();
				}).catch((err) => {console.log(err)});
			});
		});
	});
</script>

<script type="text/javascript">
    let btnDeleteAll = document.querySelector('button#btn_deleteall');
    let btnDelAllNo = document.querySelector('button#btn_delallno');
    let btnDelAllYes = document.querySelector('button#btn_delallyes');
    let divDelAllCollapse = document.querySelector('div#deleteAllCollapse');
    let inputDelAllPass = document.querySelector('input#deleteall_password');

    btnDeleteAll.addEventListener('click', function(){
        inputDelAllPass.value = "";
        btnDelAllYes.setAttribute('type','button');
    });

    btnDelAllNo.addEventListener('click', function(){
        divDelAllCollapse.classList.remove('show');
        btnDelAllNo.innerHTML = 'No';
        btnDelAllYes.innerHTML = 'Yes';
    });

    btnDelAllYes.addEventListener('click', function(){
        divDelAllCollapse.classList.add('show');
        btnDelAllNo.innerHTML = 'Cancel';
        btnDelAllYes.innerHTML = 'Submit';
    });

    inputDelAllPass.addEventListener('keyup', function(){
        if(inputDelAllPass.value != "") {
            btnDelAllYes.setAttribute('type','submit');
        } else {
            btnDelAllYes.setAttribute('type','button');
        }
    });
</script>
@endsection