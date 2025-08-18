@extends('layout.master')

@section('title', ' List ')


@section('page-style')

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #sortable {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        #sortable li {
            margin: 5px;
            padding: 5px;
            width: 100%;
            cursor: move;
        }

        .task-delete-form {
            display: inline;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h4 class="mt-5">Welcome to Task Management List</h4>

        <div class="d-flex mt-3">
            <form action="{{ route('task.index') }}" id="project-filter" method="GET" class="me-2">
                <select name="project_id" id="project-wise-filter" class="form-select w-auto ms-auto"
                    aria-label="Default select example">
                    <option value="">Select A Project</option>
                    @foreach($getProjects as $project)
                        <option {{ request('project_id') == $project->id ? 'selected' : '' }} value="{{ $project->id }}">
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </form>

        </div>

        @if(session('success'))
            <span class="text-success">{{ session('success') }}</span>
        @endif

        <div class="row">
            <div class="col-md-6 col-sm-12">

                <ul id="sortable" class="list-group">

                    @if($getTasks->isEmpty())
                        <p class="text-danger">No Task Found</p>
                    @else

                        @foreach($getTasks as $task)
                            <li data-task-id=" {{ $task->id }}" class="list-group-item">
                                <i class="fa fa-arrows" aria-hidden="true"></i>
                                {{ $task->name }} '(' {{ $task->project->name  }}')'
                                {{ !empty($task->priority) ? ' - Priority: ' . $task->priority : '' }}
                                <span class="float-end">
                                    <a href="{{ route('task.edit', $task->id) }}" class="text-success"><i
                                            class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                                    <form action="{{ route('task.destroy', $task->id) }}" class="task-delete-form" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-icon btn-sm btn-danger-transparent rounded-pill text-danger"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </span>
                            </li>
                        @endforeach

                    @endif



                </ul>

            </div>


        </div>


    </div>


    @section('page-script')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
        <script>
            $(function () {
                $("#sortable").sortable({
                    stop: function (event, ui) {
                        let sortedPriority = $("#sortable");
                        let sortedArray = [];
                        $("#sortable li").each(function () {
                            let item = $(this);
                            let taskId = item.data('task-id');
                            sortedArray.push(taskId);

                        })


                        console.log(sortedArray);

                        if (sortedArray.length > 0) {

                            $.ajax({
                                url: "{{ route('task-priority-reorder') }}",
                                method: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    sorted_priority: sortedArray
                                },
                                success: function (response) {
                                    if (response.status) {
                                        location.reload();
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });

                        }


                    }
                });

                // Project Filter
                $('#project-wise-filter').change(function () {
                    let projectId = $(this).val();
                    let url = new URL(window.location.href);
                    if (projectId) {
                        url.searchParams.set('project_id', projectId);
                    } else {
                        url.searchParams.delete('project_id');
                    }
                    window.location.href = url.toString();
                });

            });

        </script>

    @endsection
@endsection