@section('title','New User')

@section('breadcrumb','/ Users / New User')

<x-layout>
    <div class="container">
        <div class="row">
            <div class="col">

                @include('partials.panel')

                <div class="container-shadow p-4">
                    <form action="/users" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="user_username">Username <span class="form-required">*</span></label>
                                    <input id="user_username" type="text" class="form-control auto-width" name="usr_username" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_email">Email <span class="form-required">*</span></label>
                                    <input id="user_email" type="email" class="form-control auto-width" name="usr_email" required>
                                </div>
                            </div>          
                            <div class="col">
                                <div class="form-group">
                                    <label for="user_firstname">Firstname <span class="form-required">*</span></label>
                                    <input id="user_firstname" type="text" class="form-control auto-width" name="usr_firstname" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_lastname">Lastname <span class="form-required">*</span></label>
                                    <input id="user_lastname" type="text" class="form-control auto-width" name="usr_lastname" required>
                                </div>
                            </div>  
                            <div class="col">
                                <div class="form-group">
                                    <label for="user_password">Password <span class="form-required">*</span></label>
                                    <input id="user_password" type="password" class="form-control auto-width" name="usr_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_role">Account Role <span class="form-required">*</span></label>                                    
                                    <select id="user_role" class="form-control auto-width" name="usr_role" required>
                                        <option value="">Select role..</option>
                                        @foreach($userRoles as $userRole)
                                        <option value="{{ $userRole->id }}">{{ $userRole->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>         
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="d-flex flex-column justify-content-center align-items-center pt-4">
                                    <img id="image_viewer" class="rounded-border" src="{{ asset('images/profile/default.png') }}" alt="profile-image">
                                    <input type="file" id="image_uploader" class="mt-4 bg-secondary text-white" name="usr_image">
                                    <button type="submit" class="btn btn-dark rounded-0 mt-5 px-4">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
        let btnSubmitUser = this.nextElementSibling;               

        if(input.files && input.files[0] && (ext == 'png' || ext == 'jpeg' || ext == 'jpg')) {
            let reader = new FileReader();

            reader.onload = function(e){
                $('#image_viewer').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);

            btnSubmitUser.removeAttribute('disabled');
        } else {
            imageViewer.src = originalImage;
            btnSubmitUser.setAttribute('disabled', true);
        }
    });
</script>
@endsection
</x-layout>