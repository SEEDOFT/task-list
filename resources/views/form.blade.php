@extends('layouts.app')
@section('title', isset($task) ? 'Update Data' : 'Add Data')
@section('content')
    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        @csrf
        @isset($task)
            @method('put')
        @endisset
        <div class="mb-4 mt-4">
            <label for="title">{{ isset($task) ? 'Update title' : 'Add title' }} </label>
            <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}"
                @class(['border-red-500' => $errors->has('title')])>
            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div class="mb-4 mt-4">
        <div>
            <label for="description">{{ isset($task) ? 'Update description' : 'Add description' }} </label>
            <textarea name="description" id="description" rows="5" @class(['border-red-500' => $errors->has('title')])>
                {{ $task->description ?? old('description') }}
            </textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4 mt-4">
            <label for="long_description">{{ isset($task) ? 'Update long description' : 'Add long description' }} </label>
            <textarea name="long_description" id="long_description" rows="10" @class(['border-red-500' => $errors->has('title')])>
                {{ $task->long_description ?? old(key: 'long_description') }}
            </textarea>
            @error('long_description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex gap-2 items-center">
            <button type="submit" class="btn">{{ isset($task) ? 'Update data' : 'Add data' }}</button>
            <a href="{{ route('tasks.index') }}" class="link">Cancel</a>
        </div>
    </form>
@endsection
