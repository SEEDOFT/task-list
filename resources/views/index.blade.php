@extends('layouts.app')

@section('title', 'The list of tasks')


@section('content')
    <nav class="mb-4">
        <a href="{{ route('tasks.create') }}" class="link">Add task</a>
    </nav>

    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task]) }}" @class(['line-through' => $task->completed])> {{ $task->title }} </a>
        </div>
    @empty
        No Tasks for today
    @endforelse

    <nav>
        @if ($tasks->count())
            {{ $tasks->links() }}
        @endif
    </nav>
@endsection
