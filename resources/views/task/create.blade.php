@extends('layout.master')
@section('title', (!empty($task->id) ? 'Edit' : 'Create'))

@section('content')
    <div class="container">
        <h4 class="mt-5">{{!empty($task->id) ? 'Edit' : 'Create'}} Task</h4>


        <form action="{{route('task.store')}}" method="POST" class="row g-3">
            @csrf
            <input name="id" type="hidden" value="0">
            <div class="col-12">
                <label for="task-name" class="form-label">Name</label>
                <input name="name" value="{{ $task->name ?? old('name') }}" id="task-name" type="text" class="form-control"
                    placeholder="Ex: Abc Project">
            </div>

            <div class="col-md-6">
                <label for="input-priority" class="form-label">Priority</label>
                <select name="priority" id="input-priority" class="form-select" aria-label="Select Priority">
                    <option value="0">0</option>
                    @for ($i = 1; $i < ($getMaxPriority + 1); $i++)
                        <option {{!empty($task->priority) && $task->priority == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="col-md-6">
                <label for="input-project" class="form-label">Project</label>

                <select name="project_id" id="input-project" class="form-select" aria-label="Select Project">
                    <option value="">Select A Project</option>
                    @foreach($getProjects as $project)
                        <option {{!empty($task->project_id) && $task->project_id == $project->id ? 'selected' : '' }}
                            value="{{ $project->id }}">
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>

            </div>

            <div class="col-12 float-end">
                <button type="submit" class="btn btn-primary">{{!empty($task->id) ? 'Edit' : 'Create'}}</button>
            </div>

            @if(session('error'))
                <span class="text-danger">{{ session('error') }}</span>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </form>



    </div>
@endsection