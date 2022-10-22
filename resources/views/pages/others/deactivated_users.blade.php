@section('title', 'Deactivated Users')

@section('breadcrumb','/ Deactivated Users')

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
                                <th class="align-middle">Profile Picture</th>
                                <th class="align-middle">Username</th>
                                <th class="align-middle">Email</th>
                                <th class="align-middle">Used By</th>
                                <th class="align-middle">Role</th>
                                @if(Auth::user()->userRole->name == "Owner")
                                <th class="align-middle">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($users) != 0)
                                @foreach($users as $index => $user)
                                <tr class="text-center">
                                    <td class="align-middle"><strong>{{ ++$index }}</strong></td>
                                    <td class="align-middle">
                                        <img class="rounded-border" src="{{ asset($user->image) }}" style="width: 8rem" alt="">
                                    </td>   
                                    <td class="align-middle">{{ $user->username }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">{{ ucfirst($user->firstname).' '.ucfirst($user->lastname) }}</td>
                                    <td class="align-middle">{{ $user->userRole->name }}</td>
                                    @if(Auth::user()->userRole->name == "Owner")
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="restore-btn btn btn-success mr-1" data-toggle="modal" data-target="#restoreModal" data-id="{{ $user->id }}"><i class="fas fa-user-check"></i></button>
                                            <button type="button" class="delete-btn btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal" data-id="{{ $user->id }}"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                
                                <!-- Restore Modal -->
                                <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="restoreModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="rs-header modal-header">
                                                <h5 class="modal-title" id="restoreModalLabel"><i class="fas fa-info-circle mr-2"></i><strong>RESTORE USER</strong></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <strong>Are you sure you want to restore this user?</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <form class="form-restore" action="" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                    <button type="submit" class="btn btn-success font-weight-bold rounded-0">RESTORE</button>
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
                                                <h5 class="modal-title" id="deleteModalLabel">
                                                    <i class="fas fa-exclamation-triangle mr-2"></i><strong>PERMANENTLY DELETE USER</strong>                                                    
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <strong>Are you sure you want to permanently delete this user?</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <form class="form-delete" action="" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                    <button type="submit" class="btn btn-danger font-weight-bold rounded-0">DELETE</button>
                                                </form>	
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <tr class="text-center">
                                <td colspan="7"><strong class="text-danger">No data to be shown!</strong></td>
                            </tr>           
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    @if(count($users) != 0)
                        {{ $users->links() }}
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
			formRestore.action = '/users/restore/'+$(this).attr('data-id');
		});
	});
</script>

<script type="text/javascript">
	let deleteBtn = document.querySelectorAll('button.delete-btn');
	let formDelete = document.querySelector('form.form-delete');

	deleteBtn.forEach(function(dbtn){
		dbtn.addEventListener('click',function(){
			formDelete.action = '/users/permanentdelete/'+$(this).attr('data-id');
		});
	});
</script>
@endsection
</x-layout>