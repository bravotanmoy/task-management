<?php

namespace App\Traits;

use App\Models\Project;
use App\Models\Task;

trait TaskTrait
{
    public function getProjects()
    {

        return Project::all();
    }

    public function getMaxPriority()
    {

        return Task::max('priority') ?? 0;
    }
}
