@section('title', 'My Profile')

@section('breadcrumb','/ My Profile')

<x-layout>
    <div class="container">
        <div class="row">
            <div class="col">

                @include('partials.panel')

                <div class="container-shadow">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="image-container text-center p-4">                            
                                    <img id="image_viewer" class="rounded-border" src="{{ asset(Auth::user()->image) }}" alt="profile-image">
                                    {{-- <img id="image_viewer" class="rounded-border" src="{{ asset('images/profile/default.png') }}" alt="profile-image"> --}}
                                    <div class="my-4 w-100">
                                        <button id="btn_picture" class="btn btn-secondary rounded-0 px-4" type="button" data-toggle="collapse" data-target="#changePictureCollapse" aria-expanded="false" aria-controls="changePictureCollapse">
                                            Change Picture
                                        </button>
                                        <div class="collapse mb-5 pt-2" id="changePictureCollapse">
                                            <form action="/profile/image/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
                                            {{-- <form action="" method="POST" enctype="multipart/form-data"> --}}
                                                @csrf
                                                @method('PATCH')

                                                <div class="d-flex flex-column justify-content-center">
                                                    <input type="file" id="image_uploader" class="mt-4 bg-secondary text-white" name="prf_image">
                                                    <button type="submit" class="btn btn-dark rounded-0 mt-3 px-4" hidden>Save</button>
                                                    <input type="text" name="prf_currentuser" value="{{ Auth::user()->username }}" hidden>
                                                    {{-- <input type="text" name="prf_currentuser" value="" hidden> --}}
                                                </div>
                                            </form>
                                        </div>                                
                                    </div>             
                                    @if(Auth::user()->userRole->name != "Owner")                     
                                        <button id="btn_deleteaccount" type="button" class="btn btn-danger rounded-0" data-toggle="modal" data-target="#deleteAccountModal">
                                        DEACTIVATE ACCOUNT
                                        </button>
                                    @endif

                                    <!-- Delete Account Modal -->
                                    <div class="modal fade" id="deleteAccountModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="dm-header modal-header">
                                                    <h5 class="modal-title" id="deleteAccountModalLabel"><i class="fas fa-exclamation-triangle mr-2"></i><strong>DEACTIVATE ACCOUNT</strong></h5>                                                    
                                                </div>
                                                <form action="/profile/deleteaccount/{{ Auth::user()->id }}" method="POST">
                                                {{-- <form action="" method="POST"> --}}
                                                    @csrf
                                                    @method('DELETE')

                                                    <div class="modal-body text-center">
                                                        <strong>Are you sure you want to deactivate your account?</strong>
                                                        <div class="collapse mt-4 px-5" id="deleteAccountCollapse">
                                                            <div class="form-group m-0 d-flex flex-row align-items-center">
                                                                <div class="w-25 mr-1">
                                                                    <label class="m-0" for="deleteacc_password">Password:</label>
                                                                </div>
                                                                <div class="w-75 ml-1">
                                                                    <input id="deleteacc_password" type="password" class="form-control" name="delacc_password" placeholder="Enter your password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="btn_delaccno" class="btn btn-secondary rounded-0 px-3" data-dismiss="modal">No</button>                                             
                                                        <button type="button" id="btn_delaccyes" class="btn btn-danger rounded-0">Yes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-8">
                                <div class="info-container p-4">                        
                                    <div class="userdetails-container mb-5">
                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                            <h2 class="m-0">USER DETAILS</h2>
                                            <i class="edit-icon fas fa-pen"></i>
                                        </div>
                                        <hr class="mt-2 mb-4">
                                        <form action="/profile/user/{{ Auth::user()->id }}" method="POST">
                                        {{-- <form action="" method="POST"> --}}
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-group d-flex flex-row">
                                                <div class="w-25">
                                                    <label for="profile_username">Username</label>
                                                </div>
                                                <div class="w-75">
                                                    <input id="profile_username" type="text" class="profile-input edit-input w-100" name="prf_username" value="{{ Auth::user()->username }}" disabled>
                                                    {{-- <input id="profile_username" type="text" class="profile-input edit-input w-100" name="prf_username" value="" disabled> --}}
                                                </div>
                                            </div>
                                            <div class="form-group d-flex flex-row">
                                                <div class="w-25">
                                                    <label for="profile_firstname">Firstname</label>
                                                </div>
                                                <div class="w-75">
                                                    <input id="profile_firstname" type="text" class="profile-input edit-input w-100" name="prf_firstname" value="{{ ucfirst(Auth::user()->firstname) }}" disabled>
                                                    {{-- <input id="profile_firstname" type="text" class="profile-input edit-input w-100" name="prf_firstname" value="" disabled> --}}
                                                </div>
                                            </div>
                                            <div class="form-group d-flex flex-row">
                                                <div class="w-25">
                                                    <label for="profile_lastname">Lastname</label>
                                                </div>
                                                <div class="w-75">
                                                    <input id="profile_lastname" type="text" class="profile-input edit-input w-100" name="prf_lastname"  value="{{ ucfirst(Auth::user()->lastname) }}" disabled>
                                                    {{-- <input id="profile_lastname" type="text" class="profile-input edit-input w-100" name="prf_lastname"  value="" disabled> --}}
                                                </div>
                                            </div>
                                            <div class="form-group d-flex flex-row">
                                                <div class="w-25">
                                                    <label for="profile_email">Email</label>
                                                </div>
                                                <div class="w-75">
                                                    <input id="profile_email" type="text" class="profile-input edit-input w-100" name="prf_email" value="{{ Auth::user()->email }}" disabled>
                                                    {{-- <input id="profile_email" type="text" class="profile-input edit-input w-100" name="prf_email" value="" disabled> --}}
                                                </div>
                                            </div>     
                                            <div class="form-group d-flex flex-row">
                                                <div class="w-25">
                                                    <label for="profile_role">Account Role</label>
                                                </div>
                                                <div class="w-75">
                                                    <input id="profile_role" type="text" class="profile-input w-100" value="{{ Auth::user()->userRole->name }}" disabled>
                                                    {{-- <input id="profile_role" type="text" class="profile-input w-100" value="" disabled> --}}
                                                </div>
                                            </div>  
                                            <div class="profile-action" hidden>
                                                <button type="submit" class="btn btn-secondary rounded-0 px-4">Save</button>
                                            </div>                                                                    
                                        </form>  
                                    </div>
                                    <div class="changepassword-container">
                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                            <h2 class="m-0">CHANGE PASSWORD</h2>
                                            <i class="edit-icon fas fa-pen"></i>
                                        </div>
                                        <hr class="mt-2 mb-4">
                                        <form action="/profile/changepassword/{{ Auth::user()->id }}" method="POST">
                                        {{-- <form action="" method="POST"> --}}
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-group d-flex flex-row">
                                                <div class="w-25">
                                                    <label for="profile_currentpassword">Current</label>
                                                </div>
                                                <div class="w-75">
                                                    <input id="profile_currentpassword" type="password" class="profile-input edit-input w-100" name="prf_currentpass" placeholder="Type your current password" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex flex-row">
                                                <div class="w-25">
                                                    <label for="profile_newpassword">New</label>
                                                </div>
                                                <div class="w-75">
                                                    <input id="profile_newpassword" type="password" class="profile-input edit-input w-100" name="prf_newpass" placeholder="Type your new password" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex flex-row">
                                                <div class="w-25">
                                                    <label for="profile_cfmpassword">Confirm New</label>
                                                </div>
                                                <div class="w-75">
                                                    <input id="profile_cfmpassword" type="password" class="profile-input edit-input w-100" placeholder="Re-type new password" disabled>
                                                </div>
                                            </div>
                                            <div class="profile-action" hidden>
                                                <button id="profile_savepassword" type="submit" class="btn btn-secondary rounded-0 px-4" disabled>Save</button>
                                            </div>  
                                        </form>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                       
                </div>
            </div>
        </div>
    </div>

@section('script')
<script>
    let imageViewer = document.querySelector('#image_viewer');    
    let originalImage = imageViewer.src;

    $('#image_uploader').change(function(){
        let input = this;
        let url = $(this).val();
        let ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        let btnSavePicture = this.nextElementSibling;               

        if(input.files && input.files[0] && (ext == 'png' || ext == 'jpeg' || ext == 'jpg')) {
            let reader = new FileReader();

            reader.onload = function(e){
                $('#image_viewer').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);

            btnSavePicture.removeAttribute('hidden');
        } else {
            imageViewer.src = originalImage;
            btnSavePicture.setAttribute('hidden', true);
        }
    });
</script>

<script type="text/javascript">
    let editIcon = document.querySelectorAll('i.edit-icon');
    let savePassword = document.querySelector('button#profile_savepassword');

    editIcon.forEach(function(eicon,index){
        let onEdit = true;
        let values = [];
        
        eicon.addEventListener('click',function(e){
            let inputElements = e.currentTarget.parentElement.parentElement.querySelectorAll('input.edit-input');
            let profileAction = e.currentTarget.parentElement.parentElement.querySelector('div.profile-action');
            inputElements.forEach(function(ie,indx){                
                ie.classList.toggle('profile-input');
                ie.classList.toggle('active-input');
                ie.toggleAttribute('disabled');
                if(indx == 0){
                    ie.focus();
                }
            });
            profileAction.toggleAttribute('hidden');
                
            if(index == 0) {                
                if(onEdit) {
                    onEdit = false;
                    inputElements.forEach(function(ie){    
                        values.push(ie.value);    
                    });         
                } else {
                    onEdit = true;
                    inputElements.forEach(function(ie,indx){                      
                        ie.value = values[indx];
                    });
                    values = [];
                }        
            } else {
                if(onEdit) {
                    onEdit = false;
                } else {
                    onEdit = true;    
                    inputElements.forEach(function(ie,indx){                
                        ie.value = "";
                    });
                    savePassword.setAttribute('disabled', true);
                }  
            } 
        });              
    });
</script>

<script type="text/javascript">
    let newPassword = document.querySelector('input#profile_newpassword');
    let cfmPassword = document.querySelector('input#profile_cfmpassword');

    newPassword.addEventListener('keyup',function(){
        if(newPassword.value.trim() != "" || cfmPassword.value.trim() != ""){
            if(newPassword.value.trim() === cfmPassword.value.trim()) {
                savePassword.removeAttribute('disabled');
            } else {
                savePassword.setAttribute('disabled', true);
            }     
        }
    });

    cfmPassword.addEventListener('keyup',function(){
        if(newPassword.value.trim() != "" || cfmPassword.value.trim() != ""){
            if(newPassword.value.trim() === cfmPassword.value.trim()) {
                savePassword.removeAttribute('disabled');
            } else {
                savePassword.setAttribute('disabled', true);
            }     
        }
    });
</script>

<script type="text/javascript">
    let btnDeleteAccount = document.querySelector('button#btn_deleteaccount');
    let btnDelAccNo = document.querySelector('button#btn_delaccno');
    let btnDelAccYes = document.querySelector('button#btn_delaccyes');
    let divDelAccCollapse = document.querySelector('div#deleteAccountCollapse');
    let inputDelAccPass = document.querySelector('input#deleteacc_password');

    btnDeleteAccount.addEventListener('click', function(){
        inputDelAccPass.value = "";
        btnDelAccYes.setAttribute('type','button');
    });

    btnDelAccNo.addEventListener('click', function(){
        divDelAccCollapse.classList.remove('show');
        btnDelAccNo.innerHTML = 'No';
        btnDelAccYes.innerHTML = 'Yes';
    });

    btnDelAccYes.addEventListener('click', function(){
        divDelAccCollapse.classList.add('show');
        btnDelAccNo.innerHTML = 'Cancel';
        btnDelAccYes.innerHTML = 'Submit';
    });

    inputDelAccPass.addEventListener('keyup', function(){
        if(inputDelAccPass.value != "") {
            btnDelAccYes.setAttribute('type','submit');
        } else {
            btnDelAccYes.setAttribute('type','button');
        }
    });
</script>
@endsection
</x-layout>