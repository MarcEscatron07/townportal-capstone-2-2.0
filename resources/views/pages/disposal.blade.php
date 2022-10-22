@section('title', 'Disposal Archive')

@section('breadcrumb','/ Disposal Archive')

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
                                <th class="align-middle">Asset Name</th>
                                <th class="align-middle">Asset Brand</th>
                                <th class="align-middle">Type</th>
                                <th class="align-middle">Serial No.</th>
                                @if(Auth::user()->userRole->name == "Owner" || Auth::user()->userRole->name == "Manager")                         
                                <th class="align-middle">Disposal Details</th>
                                @endif
                                <th class="align-middle">Archived At</th>
                                @if(Auth::user()->userRole->name == "Owner")
                                <th class="align-middle">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($disposals) != 0)
                                @foreach($disposals as $index => $disposal)
                                <tr class="text-center">
                                    <td class="align-middle"><strong>{{ ++$index }}</strong></td>
                                    <td class="align-middle">{{ $disposal->assigned_computer }}</td>
                                    <td class="align-middle">{{ $disposal->name }}</td>
                                    <td class="align-middle">{{ $disposal->brand }}</td>
                                    <td class="align-middle">{{ $disposal->type }}</td>
                                    <td class="align-middle">{{ $disposal->serial_number }}</td>     
                                    @if(Auth::user()->userRole->name == "Owner" || Auth::user()->userRole->name == "Manager")   
                                    <td class="align-middle">
                                        <button type="button" class="btn-details btn btn-info" data-toggle="modal" data-target="#detailsModal" data-id="{{ $disposal->id }}"><i class="fas fa-list-ul"></i></button>
                                    </td>  
                                    @endif
                                    <td class="align-middle">{{ $disposal->archived_at }}</td>
                                    @if(Auth::user()->userRole->name == "Owner")
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="restore-btn btn btn-success mr-1" data-toggle="modal" data-target="#restoreModal" data-id="{{ $disposal->id }}"><i class="fas fa-trash-restore"></i></button>
                                            <button type="button" class="delete-btn btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal" data-id="{{ $disposal->id }}"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                    @endif
                                </tr>

                                <!-- Details Modal -->								
								<div class="modal fade" id="detailsModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable details-modal" role="document">
                                        <div class="modal-content">
                                            <form class="form-details" action="" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <div class="rm-header modal-header">
                                                    <h5 class="modal-title" id="detailsModalLabel"><i class="fas fa-list-alt mr-2"></i>Disposal Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span class="spn-close" aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body py-3">
                                                    <input type="checkbox" class="checkbox-edit" checked> Edit
                                                    <div class="container details-container rounded p-3">
                                                        <div class="row details-row">
                                                            <div class="col-3 pt-5" style="border-right: 1px solid rgba(0,0,0,.1); background-color: #dedede;">
                                                                <div class="form-group form-details py-2">
                                                                    <label for="disposal_name">Name:</label>
                                                                </div>
                                                                <div class="form-group form-details py-2">
                                                                    <label for="disposal_brand">Brand:</label>
                                                                </div>
                                                                <div class="form-group form-details py-2">
                                                                    <label for="disposal_type">Type:</label>
                                                                </div>
                                                                <div class="form-group form-details py-2">
                                                                    <label for="disposal_serial">Serial Number:</label>
                                                                </div>
                                                                <div class="form-group form-details py-2">
                                                                    <label for="disposal_cost">Cost:</label>
                                                                </div>
                                                                <div class="form-group form-details py-1">
                                                                    <label for="disposal_pdate">Purchase Date:</label>
                                                                </div>
                                                                <div class="form-group form-details py-2">
                                                                    <label for="disposal_pdate">Disposal Date:</label>
                                                                </div>
                                                            </div>
                                                            <div class="col text-center" style="border-right: 1px solid rgba(0,0,0,.1);">
                                                                <h1 class="mt-2 mb-4">Disposed Item:</h1>
                                                                <div class="form-group form-details">
                                                                    <input type="text" class="disposed-input form-control" disabled>
                                                                </div>
                                                                <div class="form-group form-details">
                                                                    <input type="text" class="disposed-input form-control" disabled>
                                                                </div>
                                                                <div class="form-group form-details">
                                                                    <input type="text" class="disposed-input form-control" disabled>
                                                                </div>
                                                                <div class="form-group form-details">
                                                                    <input type="text" class="disposed-input form-control" disabled>
                                                                </div>
                                                                <div class="form-group form-details">
                                                                    <input type="text" class="disposed-input form-control" disabled>
                                                                </div>
                                                                <div class="form-group form-details">
                                                                    <input type="text" class="disposed-input form-control" disabled>
                                                                </div>
                                                                <div class="form-group form-details">
                                                                    <input type="text" class="disposed-input form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col text-center">
                                                                <h1 class="mt-2 mb-4">New Item:</h1>
                                                                <div class="form-group form-details"> 
                                                                    <input type="text" class="details-input form-control" name="dsp_name" required>
                                                                </div>
                                                                <div class="form-group form-details"> 
                                                                    <input type="text" class="details-input form-control" name="dsp_brand" required>
                                                                </div>
                                                                <div class="form-group form-details"> 
                                                                    <input type="text" class="details-input form-control" name="dsp_type" readonly required>
                                                                </div>
                                                                <div class="form-group form-details"> 
                                                                    <input type="text" class="details-input form-control" name="dsp_serial" required>
                                                                </div>
                                                                <div class="form-group form-details"> 
                                                                    <input type="number" min="1" step="1" class="details-input form-control" name="dsp_cost" required>
                                                                </div>
                                                                <div class="form-group form-details"> 
                                                                    <input type="date" class="details-input form-control" name="dsp_pdate" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row details-row">
                                                            <div class="col py-3">
                                                                <div class="form-group m-0">
                                                                    <label for="disposal_reason">Reason for Disposal:</label>
                                                                    <textarea class="textarea-reason form-control" placeholder="Type reason for disposal here.." name="dsp_reason"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(Auth::user()->userRole->name == "Owner")
                                                <div class="modal-footer details-footer">
                                                    <button type="submit" data-id="{{ $disposal->id }}" class="save-details btn btn-info rounded-0">Save</button>
                                                </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Restore Modal -->
                                <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="restoreModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="rs-header modal-header">
                                                <h5 class="modal-title" id="restoreModalLabel"><i class="fas fa-info-circle mr-2"></i><strong>RESTORE DATA</strong></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <strong>Are you sure you want to restore this data?</strong>
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
                                            <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-exclamation-triangle mr-2"></i><strong>PERMANENTLY DELETE DATA</strong></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <strong>Are you sure you want to permanently delete this data?</strong>
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
								<td colspan="12"><strong class="text-danger">No data to be shown!</strong></td>
							</tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    @if(count($disposals) != 0)
                        {{ $disposals->links() }}
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
			formRestore.action = '/disposalarchive/restore/'+$(this).attr('data-id');
		});
	});
</script>

<script type="text/javascript">
	let deleteBtn = document.querySelectorAll('button.delete-btn');
	let formDelete = document.querySelector('form.form-delete');

	deleteBtn.forEach(function(dbtn){
		dbtn.addEventListener('click',function(){
			formDelete.action = '/disposalarchive/dispose/'+$(this).attr('data-id');
		});
	});
</script>

<script type="text/javascript">
    let btnDetails = document.querySelectorAll('button.btn-details');
    let chkEdit = document.querySelector('input.checkbox-edit');
    let inpDisposed = document.querySelectorAll('input.disposed-input')
    let inpDetails = document.querySelectorAll('input.details-input');    
    let txaReason = document.querySelector('textarea.textarea-reason');
    let divDetailsFooter = document.querySelector('div.details-footer');

    let typeIndex = 2;
    let inpDtlCount = 6;

    chkEdit.addEventListener('change', function(){        
        inpDetails.forEach(function(inpDtl,indexDtl){
            inpDtl.classList.toggle('details-input');
            inpDtl.classList.toggle('newdetails-control');
            inpDtl.toggleAttribute('disabled');
        });
        txaReason.classList.toggle('newdetails-control');
        txaReason.toggleAttribute('disabled');
        if(chkEdit.checked){
            divDetailsFooter.removeAttribute('hidden');
        } else {
            divDetailsFooter.setAttribute('hidden', true);
        }
    });

    btnDetails.forEach(function(btnDtl){
        btnDtl.addEventListener('click', function(){
            inpDisposed.forEach(function(inpDsp){
                inpDsp.value = "";
            });
            inpDetails.forEach(function(inpDtl){
                inpDtl.value = "";
            });
            txaReason.value = "";

            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let detailsID = btnDtl.dataset.id;

            let getUrl = '/disposalarchive/disposed/details/get/'+detailsID;

            let getData = new FormData;
            getData.append('detailsID', detailsID);
            getData.append('_token', token);

            fetch(getUrl, {
                method: 'POST',
                credentials: 'same-origin',
                body: getData
            }).then((getRes) => {
                return getRes.text();
            }).then((getData) => {
                $getArray = getData.split('\n');    
                inpDisposed.forEach(function(inpDsp,indexDsp){
                    inpDsp.value = $getArray[indexDsp];
                    if(indexDsp == typeIndex) { // fixed index to set up the type for 'New Item' dynamically
                        inpDetails[indexDsp].value = $getArray[indexDsp];
                    }
                });

                let hasUrl = '/disposalarchive/hasdetails/'+detailsID;

                let hasData = new FormData;
                hasData.append('detailsID', detailsID);
                hasData.append('_token', token);

                fetch(hasUrl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: hasData
                }).then((hasRes) => {
                    return hasRes.text();
                }).then((hasData) => {           
                    let saveDetails = document.querySelector('button.save-details');
                    let formDetails = document.querySelector('form.form-details');

                    if(hasData == 0) {
                        saveDetails.innerHTML = "Save";
                        enableEdit();
                    } else {
                        saveDetails.innerHTML = "Save Changes";
                        disableEdit();

                        let editUrl = '/disposalarchive/details/edit/'+detailsID;

                        let editData = new FormData;
                        editData.append('detailsID', detailsID);
                        editData.append('_token', token);

                        fetch(editUrl, {
                            method: 'POST',
                            credentials: 'same-origin',
                            body: editData
                        }).then((editRes) => {
                            return editRes.text();
                        }).then((editData) => {
                            $editArray = editData.split('\n');
                            inpDetails.forEach(function(inpDtl,indexDtl){
                                if(indexDtl < inpDtlCount) {    // fixed count for details-input                                    
                                    inpDtl.value = $editArray[indexDtl];
                                }
                            });
                            txaReason.value = $editArray[inpDtlCount];  // fixed count for details-input
                        }).catch((err) => {console.log(err)});
                    }

                    saveDetails.addEventListener('click', function(){
                        if(hasData == 0) {
                            let newUrl = '/disposalarchive/details/save/'+detailsID;
                            formDetails.action = newUrl;
                        } else {
                            let newUrl = '/disposalarchive/details/update/'+detailsID;
                            formDetails.action = newUrl;
                        }
                    });
                }).catch((hasErr) => {console.log(err)});                    
            }).catch((getErr) => {console.log(err)});
        });
    });

    function enableEdit() {
        chkEdit.checked = true;
        chkEdit.setAttribute('disabled', true);
        divDetailsFooter.removeAttribute('hidden');
        inpDetails.forEach(function(inpDtl,indexDtl){
            inpDtl.classList.remove('newdetails-control');
            inpDtl.classList.add('details-input');
            inpDtl.removeAttribute('disabled');
        });
        txaReason.classList.remove('newdetails-control');
        txaReason.removeAttribute('disabled');
    }

    function disableEdit() {
        chkEdit.checked = false;
        chkEdit.removeAttribute('disabled');
        divDetailsFooter.setAttribute('hidden', true);
        inpDetails.forEach(function(inpDtl,indexDtl){
            inpDtl.classList.remove('details-input');
            inpDtl.classList.add('newdetails-control');
            inpDtl.setAttribute('disabled', true);
        });
        txaReason.classList.add('newdetails-control');
        txaReason.setAttribute('disabled', true);
    }
</script>
@endsection
</x-layout>