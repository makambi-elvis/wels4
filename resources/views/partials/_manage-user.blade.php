@props(['user'])

<form action="/user/{{ $user->id }}" method="POST">
    @csrf
    @method('DELETE')

    <button class="btn p-1 btn-danger">Delete</button>
</form>
