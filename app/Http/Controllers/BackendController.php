<?php

namespace App\Http\Controllers;

use App\Http\Classes\BackendUrlGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

/**
 * Class BackendController
 * @package App\Http\Controllers
 */
abstract class BackendController extends Controller
{
    protected $routeNameAdd;
    protected $routeNameList;
    protected $routeNameEdit;
    protected $viewData = [];

    /**
     * BackendController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();

        // Route names
        $this->routeNameList = 'admin' . ucfirst($this->controllerName) . 'List';
        $this->routeNameAdd = 'admin' . ucfirst($this->controllerName) . 'Add';
        $this->routeNameEdit = 'admin' . ucfirst($this->controllerName) . 'Edit';

        // View data
        $this->assignViewData('routeNameList', $this->routeNameList);
        $this->assignViewData('routeNameAdd', $this->routeNameAdd);
        $this->assignViewData('routeNameEdit', $this->routeNameEdit);

        // Webroot /backend
        $routes = app()['router']->getRoutes();
        $customUrlGenerator = new BackendUrlGenerator($routes, app()->make('request'));
        app()->instance('url', $customUrlGenerator);

        // Widget path
        config(['laravel-widgets.default_namespace' => app()->getNamespace() . 'Widgets\Backend']);

        // Views path
        View::addLocation(resource_path('views') . '/backend/');
    }

    /**
     * @param $key
     * @param $value
     */
    protected function assignViewData($key, $value)
    {
        $this->viewData[$key] = $value;
    }

    /**
     * @param $data
     * @param null $currentId
     * @param null $disabledId
     * @param int $parentId
     * @param string $indents
     * @param int $level
     * @return array
     */
    protected function createHierarchicalList($data, $currentId = null, $disabledId = null, $parentId = 0, $indents = '', $level = 0)
    {
        $result = [];

        if ($parentId == 0) {
            $temp = [];

            foreach ($data as $el) {
                $temp[$el->parent_id][$el->id] = [
                    'name' => $el->name,
                    'parent_id' => $el->parent_id,
                    'id' => $el->id,
                    'alias' => $el->alias,
                    'status' => $el->status,
                    'level' =>0,
                ];
            }
            $data = $temp;

            $result = [
                0 => [
                    'id' => 0,
                    'name' => '------',
                    'selected' => (0 == $currentId ? 'selected' : ''),
                ],
            ];
        }

        if (empty($data[$parentId]) || !is_array($data)) {
            return $result;
        }

        foreach ($data[$parentId] as $id => $el) {
            $result[] = [
                'id' => $el['id'],
                'name' => $indents . $el['name'],
                'selected' => $id != $disabledId ? ($id == $currentId ? 'selected' : '') : 'disabled',
            ];

            if (!empty($data[$id])) {
                $result = array_merge(
                    $result,
                    $this->createHierarchicalList(
                        $data,
                        $currentId,
                        $disabledId,
                        $id,
                        $indents . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                        $level + 1
                    )
                );
            }
        }

        return $result;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function status(Request $request)
    {
        $id = $request->input('id');
        if (!$id) {
            return [
                'success' => false,
                'message' => 'id элемента не указан',
            ];
        }

        $item = $this->model->find((int)$id);
        if (!$item) {
            return [
                'success' => false,
                'message' => 'Элемент с таким id не найден',
            ];
        }

        $item->status = (boolean)$request->input('status');
        try {
            $item->save();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Ошибка БД',
            ];
        }

        return [
            'success' => true,
            'message' => 'Статус изменен',
        ];
    }

    // ACTIONS

    /**
     * @return $this
     */
    public function index()
    {
        $this->indexGetData();
        return $this->view('index', $this->viewData);
    }

    protected function indexGetData()
    {
        if (!$this->model) {
            return;
        }

        $this->assignViewData('list', $this->model->orderBy('name', 'ASC')->paginate(50));
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function add()
    {
        $this->addGetData();
        return $this->view('edit', $this->viewData);
    }

    protected function addGetData()
    {
        if (!$this->model) {
            return;
        }

        $this->assignViewData('item', clone $this->model);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $this->editGetData($id);
        return $this->view('edit', $this->viewData);
    }

    /**
     * @param $id
     */
    protected function editGetData($id)
    {
        $item = $this->model->find((int)$id);
        $this->assignViewData('item', $item);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function saveGetData(Request $request)
    {
        $images = [];
        $imagesConfig = $this->model->getImagesConfig();
        if (count($imagesConfig)) {
            foreach ($imagesConfig as $postParamName => $dbColumnName) {
                $file = $request->file($postParamName);
                if ($file) {
                    $images[$dbColumnName] = $file->store('images');
                }
            }

        }

        return $images + $request->only($this->model->getFillableBackend()) + $this->model->getDefaultValuesForFields();
    }

    /**
     * @param Request $request
     * @param null $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, $id = null)
    {
        $request->validate($this->model->getValidationRules($id), $this->model->getValidationMessages());

        $data = $this->saveGetData($request);

        if ($id) {
            $item = $this->model->find((int)$id);
            if (!$item) {
                return redirect()->route($this->routeNameEdit, [$item->id])
                                 ->withErrors(['error' => 'Указан несуществующий id']);
            }
            $item->fill($data);
        } else {
            $item = $this->model->create($data);
        }

        DB::beginTransaction();
        try {
            $item->save();
            $this->saveAfter($request, $item->id);

            // UpdateOnCreate realisation:
            //$item = $this->model->updateOrCreate(['id' => $id], $data);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route($this->routeNameEdit, [$item->id])
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }

        DB::commit();

        if ($request->get('submit-button') === 'save-and-close') {
            return redirect()->route($this->routeNameList);
        } else {
            return redirect()->route($this->routeNameEdit, [$item->id]);
        }
    }

    /**
     * @param Request $request
     * @param null $id
     */
    protected function saveAfter(Request $request, $id = null)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteImage($id)
    {
        $item = $this->model->find((int)$id);
        if (!$item) {
            return redirect()->route($this->routeNameList);
        }

        if (!$item->image || !Storage::exists($item->image)) {
            return redirect()->route($this->routeNameEdit, [$item->id]);
        }

        if (Storage::delete($item->image)) {
            $item->image = null;
            $item->save();
        };

        return redirect()->route($this->routeNameEdit, [$item->id]);
    }
}
