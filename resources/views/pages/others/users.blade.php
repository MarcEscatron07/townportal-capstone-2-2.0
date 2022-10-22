@section('title', 'Users')

@section('breadcrumb','/ Users')

<x-layout>
    <div class="container">
        <div class="row">
            <div class="col">

                @include('partials.panel')

                @if(Auth::user()->userRole->name == "Owner")
				<div class="mb-2 pt-3">	
					<a href="/users/create" class="btn btn-success rounded-0">Add a User</a>
				</div>
                @endif
                <div class="container-shadow">
                    <table class="table">
                        <thead class="text-center text-white bg-secondary">
                            <tr>
                                <th class="align-middle">#</th>
                                <th class="align-middle">Profile Picture</th>                                
                                <th class="align-middle">Username</th>                       
                                <th class="align-middle">Firstname</th>
                                <th class="align-middle">Lastname</th>
                                <th class="align-middle">Email</th>
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
                                    <td class="align-middle">{{ $user->firstname }}</td>                                
                                    <td class="align-middle">{{ $user->lastname }}</td>                                
                                    <td class="align-middle">{{ $user->email }}</td>                                
                                    <td class="align-middle">{{ $user->userRole->name }}</td>     
                                    @if(Auth::user()->userRole->name == "Owner")
                                        @if($user->userRole->name == "Owner")    
                                        <td class="align-middle"></td>
                                        @else                       
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center">
                                                <form action="/users/{{ $user->id }}/edit" method="GET">
                                                    @csrf

                                                    <button type="submit" class="btn btn-dark mr-1"><i class="fas fa-edit"></i></button>
                                                </form>
                                                <button type="button" class="delete-btn btn btn-danger ml-1" data-toggle="modal" data-target="#deleteModal" data-id="{{ $user->id }}"><i class="fas fa-user-times"></i></button>
                                            </div>
                                        </td>    
                                        @endif    
                                    @endif
                                </tr>             

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="dm-header modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-exclamation-triangle mr-2"></i><strong>DEACTIVATE USER</strong></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <strong>Are you sure you want to deactivate this user?</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <form class="form-delete" action="" method="POST">
                                            @csrf
                                            @method('DELETE')

                                                <button type="submit" class="btn btn-danger font-weight-bold rounded-0">DEACTIVATE</button>
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
                    @if(count($users) != 0)				
                        {{ $users->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

@section('script')
<script type="text/javascript">
	let deleteBtn = document.querySelectorAll('button.delete-btn');
	let formDelete = document.querySelector('form.form-delete');

	deleteBtn.forEach(function(dbtn){
		dbtn.addEventListener('click',function(){
			formDelete.action = '/users/'+$(this).attr('data-id');
		});
	});
</script>
@endsection
</x-layout>