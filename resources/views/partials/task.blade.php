<form action="/task/{{ $task->id_task }}" method="post" id="tid{{ $task->id_task }}">
    @csrf
    {{ $task->title }}
    <br>
    {{ $task->description }}

    <input type="text" name="action" value="deltask" style="display: none;">


    <button type="submit" class="btn btn-danger">
        Delete
    </button>
</form>
