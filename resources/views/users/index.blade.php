@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users dashboard</div>

                <div class="card-body">
                    @if(!empty($errors->first()))
                        <div class="row">
                            <div class="col-12  alert alert-danger">
                                <span>{{ $errors->first() }}</span>
                            </div>
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @role('admin')
                                    <a class="btn btn-sm btn-danger delete-user" data-toggle="confirmation" data-title="Delete user?"
                                       data-id="{{ $user->id }}" >delete</a>
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h6>Are you sure that you want to delete user?</h6>
                </div>
                <div class="modal-footer">
                    <form id="DeleteUserForm" method="POST" action="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
@section('scripts')
    <script src="{{ mix('js/users.js') }}" defer></script>
@endsection
