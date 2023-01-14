@props(['electronic'])

<div class="btn-group" role="group" aria-label="electronicFunctionality">
    <a href="/electronics/edit/{{$electronic->id}}" class="btn btn-warning">Edit</a>

    <form class="btn-group" action="/electronics/{{$electronic->id}}" method="POST">
        @csrf
        @method('DELETE')

        <button class="btn btn-danger">Delete</button>
    </form>
</div>
