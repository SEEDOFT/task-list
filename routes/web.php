<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//because task is annonymous function, to access, use use()
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

//all data
Route::get('/tasks', function () {
    return view('index', data: [
        // 'tasks' => Task::latest()->where(column: 'completed', operator: true)->get()
        'tasks' => Task::latest()->paginate()
        // 'tasks' => Task::all()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

//update with ID
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('update', data: [
        'task' => $task
    ]);
})->name('tasks.edit');

//by index screen
Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

//store data
Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show', [
        'task' => $task
    ])->with('success', 'create new task successfull');

})->name('tasks.store');

//update data
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());
    return redirect()->route('tasks.show', [
        'task' => $task
    ])->with('success', 'update new task successfull');
})->name('tasks.update');

//delete data
Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')->with('success', 'Delete Successfully');
})->name('tasks.destroy');

//
Route::put('/tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Update successfully');
})->name('tasks.toggleComplete');

//for rollback
Route::fallback(function () {
    return 'No right ROUTE';
});
