<?php

namespace App\Repositories\Eloquent;

use App\Models\Lesson;
use App\Repositories\Traits\RepositoryTrait;
use App\Repositories\LessonRepositoryInterface;

class LessonRepository implements LessonRepositoryInterface
{
    use RepositoryTrait;

    protected $model;

    public function __construct(Lesson $model)
    {
        $this->model = $model;
    }

    public function getLessonsByModuleId(string $moduleId)
    {
        return $this->model
            ->where('module_id', $moduleId)
            ->with('supports.replies')
            ->get();
    }

    public function getLesson(string $identify)
    {
        return $this->model->findOrFail($identify);
    }

    public function markLessonViewed(string $lessonId)
    {
        $user = $this->getUserAuth();
        $view = $user->views()->where('lesson_id', $lessonId)->first();

        if ($view) {
            return $view->update([
                'qty' => $view->qty + 1,
            ]);
        }

        return $user->views()->create([
            'lesson_id' => $lessonId
        ]);
    }

    public function getAllByModuleId(string $moduleId, string $filter = ''): array
    {
        $data = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->orWhere('name', 'LIKE', "%{$filter}%");
                }
            })
            ->where('module_id', $moduleId)
            ->get();

        return $data->toArray();
    }

    public function findById(string $id): ?object
    {
        return $this->model->find($id);
    }

    public function createByModule(string $moduleId, array $data): object
    {
        $data['module_id'] = $moduleId;
        return $this->model->create($data);
    }

    public function update(string $id, array $data): ?object
    {
        if (!$itemDb = $this->findById($id)) {
            return null;
        }

        $itemDb->update($data);

        return $itemDb;
    }

    public function delete(string $id): bool
    {
        if (!$data = $this->findById($id))
            return false;

        return $data->delete();
    }
}
