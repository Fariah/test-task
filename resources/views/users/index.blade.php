@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('users.list.dashboard.title') }}</div>

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
                            <th scope="col">{{ __('users.list.title') }}</th>
                            <th scope="col">{{ __('users.list.email') }}</th>
                            <th scope="col">{{ __('users.list.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @can('isAdmin')
                                        <a class="btn btn-sm btn-danger delete-user" data-id="{{ $user->id }}" >
                                            {{ __('users.list.delete') }}
                                        </a>
                                    @endcan
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
                    <h6>{{ __('users.list.confirm') }}</h6>
                </div>
                <div class="modal-footer">
                    <form id="DeleteUserForm" method="POST" action="">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('users.form.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('users.form.delete') }}</button>
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
