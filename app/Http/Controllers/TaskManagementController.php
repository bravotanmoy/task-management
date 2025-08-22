<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Traits\TaskTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskManagementController extends Controller
{
    use TaskTrait;

    public function index(Request $request)
    {
        $getRequestData = $request->all();

        $query = Task::query();

        if (! empty($getRequestData['project_id'])) {
            $query->where('project_id', $getRequestData['project_id']);
        }

        $getTasks = $query->orderBy('priority', 'asc')->get();

        return view('task.index', [
            'getProjects' => $this->getProjects(),
            'getTasks' => $getTasks,
        ]);

    }

    public function create()
    {

        return view('task.create', [
            'getProjects' => $this->getProjects(),
            'getMaxPriority' => $this->getMaxPriority(),
        ]);
    }

    public function edit($id)
    {

        $task = Task::findOrFail($id);

        return view('task.create', [
            'getProjects' => $this->getProjects(),
            'getMaxPriority' => $this->getMaxPriority(),
            'task' => $task,
        ]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'priority' => 'required|integer|min:1',
            'project_id' => 'required|exists:projects,id',
        ]);

        try {
            $requestData = $request->all();

            $postData = [
                'name' => $requestData['name'],
                'priority' => $requestData['priority'] ?? 0,
                'project_id' => $requestData['project_id'],
            ];

            /**
             * Check priority is assigned to other task or not
             */
            if ($requestData['priority'] > 0 && $requestData['id'] <= 0) {
                $existingTask = Task::where('priority', $requestData['priority'])
                    ->first();

                if ($existingTask) {
                    return redirect()->route('task.create')->with('error', 'Priority already assigned to another task.');
                }
            }

            DB::beginTransaction();

            $getProjectObject = Task::updateOrCreate(
                ['id' => $requestData['id']],
                $postData
            );

            DB::commit();

            $message = 'Task Created successfully.';
            if ($requestData['id'] > 0) {
                $message = 'Task Updated successfully.';
            }

            return redirect()->route('task.index')->with('success', $message);

        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);

            return redirect()->route('task.create')->with('error', 'Failed To Create Task');

        }

    }

    public function destroy(string $id)
    {
        $getTask = Task::find($id);
        $getTask->delete();

        return back()->with('success', 'Task Deleted Successfully.');
    }

    public function reOrderPriority(Request $request)
    {

        try {

            $reOrderTask = $request->sorted_priority;

            DB::beginTransaction();

            foreach ($reOrderTask as $order => $taskId) {
                $task = Task::find($taskId);
                if ($task) {
                    $task->priority = $order + 1;
                    $task->save();
                }

            }

            DB::commit();

            return [
                'status' => 1,
                'message' => 'Success To Reorder Task Priority',
            ];

        } catch (Exception $e) {
            DB::rollback();

            return [
                'status' => 0,
                'message' => 'Failed To Reorder Task Priority',
            ];

        }

    }
}
