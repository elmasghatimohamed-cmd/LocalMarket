@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Role Switcher</h1>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Rôle actuel</th>
                <th>Changer rôle</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }} ({{ $user->email }})</td>
                <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.role_switcher.update', $user) }}">
                        @csrf
                        <select name="role" class="form-control d-inline-block" style="width:auto;">
                            @foreach($roles as $role)
                                <option value="{{ $role }}" {{ $user->hasRole($role) ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-sm btn-primary">Mettre à jour</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
