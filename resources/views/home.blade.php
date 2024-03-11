@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>User List</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                    @if($isAdmin)
                     <th>Additional Actions</th>
                     @endif
                    
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="{{ route('users.show', $user->id) }}">Show</a></td>
                        @if($isAdmin)
                            <td><a href="{{ route('users.edit', $user->id) }}">Edit</a> |
                            
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form> |

                            @if ($user->trashed())
                            <form action="{{ route('users.restore', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit">Restore</button>
                            </form>
                        @endif

                            </td>

   
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection