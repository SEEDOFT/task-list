@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <p class="mb-4 mt-4"><span class="text-red-500">Description: </span>{{ $task->description }}</p>
    <p class="mb-4 mt-4"><span class="text-red-500">Long Description: </span>
        @if (!$task->long_description)
            No long description is available
        @else
            {{ $task->long_description }}
        @endif
    </p>
    <p class="mb-4 mt-4 text-red-500"><span class="text-blue-500">Completed:
        </span>{{ $task->completed ? 'Completed' : 'Not completed' }}</p>
    <p class="mb-4 mt-4 text-gray-400">Created </span>{{ $task->created_at->diffForHumans() }} Update
        {{ $task->updated_at->diffForHumans() }}
    </p>

    <div>
        <a href="{{ route('tasks.edit', parameters: ['task' => $task]) }}" class=" underline decoration-red-500">Update</a>

        <form action="{{ route('tasks.toggleComplete', ['task' => $task]) }}" method="post">
            @csrf
            @method('put')
            <button type="submit" class=" underline decoration-pink-500">Mark as
                {{ $task->completed ? 'Not completed' : 'Completed' }}</button>
        </form>
        <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class=" text-red-500">Delete</button>
        </form>
    </div>

@endsection
