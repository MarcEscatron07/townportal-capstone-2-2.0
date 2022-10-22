@section('title', 'Maintenance Log')

@section('breadcrumb','/ Maintenance Log')

<x-layout>
	<div class="container">
		<div class="row">
			<div class="col">
				
				@include('partials.panel')

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
								<th class="align-middle">Type</th>
								<th class="align-middle">Serial No.</th>								
								<th class="align-middle">Logged At</th>					
								<th class="align-middle">Remarks</th>
								@if(Auth::user()->userRole->name == "Owner")
								<th class="align-middle">Action</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@if(count($maintenancelogs) != 0)
								@foreach($maintenancelogs as $index => $maintenance)
								<tr class="text-center">
									<td class="align-middle"><strong>{{ ++$index }}</strong></td>
									<td class="align-middle">{{ $maintenance->assigned_computer }}</td>
									<td class="align-middle">{{ $maintenance->name }}</td>
									<td class="align-middle">{{ $maintenance->brand }}</td>
									<td class="align-middle">{{ $maintenance->type }}</td>
									<td class="align-middle">{{ $maintenance->serial_number }}</td>									
									<td class="align-middle">{{ $maintenance->logged_at }}</td>																	
									<td class="align-middle">
										<button type="button" class="btn-remarks btn btn-info" data-toggle="modal" data-target="#remarksModal" data-id="{{ $maintenance->id }}"><i class="fas fa-marker"></i></button>
									</td>
									@if(Auth::user()->userRole->name == "Owner")
									<td class="align-middle">	
										<div class="d-flex justify-content-center">									
											<button type="button" class="restore-btn btn btn-success mr-1" data-toggle="modal" data-target="#restoreModal" data-id="{{ $maintenance->id }}"><i class="fas fa-check-double"></i></button>										
											<button type="button" class="delete-btn btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal" data-id="{{ $maintenance->id }}"><i class="fas fa-dumpster"></i></button>
										</div>
									</td>
									@endif
								</tr>

								<!-- Remarks Modal -->								
								<div class="modal fade" id="remarksModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="remarksModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="rm-header modal-header">
												<h5 class="modal-title" id="remarksModalLabel"><i class="fas fa-pen-square mr-2"></i>Remarks</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span class="spn-close" aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body pt-3">
												<input type="checkbox" class="checkbox-edit mb-3" checked> Edit
												<textarea class="textarea-remarks form-control" placeholder="Type your remarks here.."></textarea>
											</div>
											@if(Auth::user()->userRole->name == "Owner")
											<div class="modal-footer remarks-footer">
												<form class="form-remarks" action="" method="POST">
													@csrf
													@method('PATCH')
		
													<button type="submit" data-id="{{ $maintenance->id }}" class="save-remarks btn btn-info rounded-0">Save</button>
												</form>
											</div>
											@endif
										</div>
									</div>
								</div>
								
								<!-- Restore Modal -->
                                <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="restoreModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="rs-header modal-header">
												<h5 class="modal-title" id="restoreModalLabel"><i class="fas fa-info-circle mr-2"></i><strong>SET STATUS</strong></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body text-center">
												<strong>Set this device's status as 'working'?</strong>
											</div>
											<div class="modal-footer">
												<form class="form-restore" action="" method="POST">
												@csrf
												@method('DELETE')

													<button type="submit" class="btn btn-success font-weight-bold px-4 rounded-0">YES</button>
												</form>	
											</div>
										</div>
									</div>
								</div>

								<!-- Delete Modal -->
								<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
										<div class="dm-header modal-header">
											<h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-exclamation-triangle mr-2"></i><strong>SET FOR DISPOSAL</strong></h5>
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
								<td colspan="8"><strong class="text-danger">No data to be shown!</strong></td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>
				<div class="mt-3">
                    @if(count($maintenancelogs) != 0)
					    {{ $maintenancelogs->links() }}
                    @endif
				</div>
			</div>
		</div>
	</div>

@section('script')
<script type="text/javascript">
	let restoreBtn = document.querySelectorAll('button.restore-btn');
	let formRestore = document.querySelector('form.form-restore');

	restoreBtn.forEach(function(rbtn){
		rbtn.addEventListener('click',function(){
			formRestore.action = '/maintenancelog/status/'+$(this).attr('data-id');
		});
	});
</script>

<script type="text/javascript">
	let deleteBtn = document.querySelectorAll('button.delete-btn');
	let formDelete = document.querySelector('form.form-delete');

	deleteBtn.forEach(function(dbtn){
		dbtn.addEventListener('click',function(){
			formDelete.action = '/maintenancelog/disposal/'+$(this).attr('data-id');
		});
	});
</script>

<script type="text/javascript">
		let btnRemarks = document.querySelectorAll('button.btn-remarks');
		let chkEdit = document.querySelector('input.checkbox-edit');
		let txaRemarks = document.querySelector('textarea.textarea-remarks');
		let divRemarksFooter = document.querySelector('div.remarks-footer');

		chkEdit.addEventListener('change', function(){
			txaRemarks.toggleAttribute('disabled');
			if(chkEdit.checked){
				divRemarksFooter.removeAttribute('hidden');
			} else {
				divRemarksFooter.setAttribute('hidden', true);
			}
		});

		btnRemarks.forEach(function(btnRem){
			btnRem.addEventListener('click', function(){
				txaRemarks.value = "";
				
				let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
				let remarksID = btnRem.dataset.id;

				let url = '/maintenancelog/remarks/'+remarksID;

				let data = new FormData;
				data.append('remarksID', remarksID);
				data.append('_token', token);

				fetch(url, {
					method: 'POST',
					credentials: 'same-origin',
					body: data
				}).then((res) => {
					return res.text();
				}).then((data) => {
					if(data == "None"){
						chkEdit.checked = true;
						txaRemarks.removeAttribute('disabled');	
						divRemarksFooter.removeAttribute('hidden');					
					} else {
						txaRemarks.value = data;
						chkEdit.checked = false;
						txaRemarks.setAttribute('disabled',true);
						divRemarksFooter.setAttribute('hidden', true);
					}

					let saveRemarks = document.querySelector('button.save-remarks');	
					let formRemarks = document.querySelector('form.form-remarks');

					saveRemarks.addEventListener('click', function(){	
						if(txaRemarks.value.trim() == ""){
							let newUrl = '/maintenancelog/remarks/'+remarksID+'/update/None';
							formRemarks.action = newUrl;
						} else {
							let newUrl = '/maintenancelog/remarks/'+remarksID+'/update/'+txaRemarks.value;
							formRemarks.action = newUrl;
						}
					});					
				}).catch((err) => {console.log(err)});
			});
		});
</script>
@endsection
</x-layout>