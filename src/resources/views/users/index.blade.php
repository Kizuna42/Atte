<!-- users/index.blade.php -->
@extends('layouts.app')

@section('content')
<h2>ユーザーページ</h2>
<div class="user-list" style = "text-align: center;">
    <ul>
        @foreach($users as $user)
            <li>
                <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
            </li>
        @endforeach
    </ul>
    {{ $users->links() }}
</div>
@endsection