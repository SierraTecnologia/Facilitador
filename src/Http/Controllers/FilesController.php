<?php

namespace Facilitador\Http\Controllers;

use Cms;
use Config;
use Storage;
use Redirect;
use Response;
use Exception;
use CryptoService;
use Siravel\Models\Digital\Midia\File;
use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use App\Services\Midia\FileService;
use App\Services\ValidationService;
use App\Repositories\FileRepository;
use App\Services\CmsResponseService;

class FilesController extends SitecController
{
    public function __construct(
        FileRepository $repository,
        FileService $fileService,
        ValidationService $validationService,
        CmsResponseService $cmsResponseService
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->fileService = $fileService;
        $this->validation = $validationService;
        $this->responseService = $cmsResponseService;
    }

    /**
     * Display a listing of the Files.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->repository->paginated();

        return theme('features.files.index')
            ->with('files', $result)
            ->with('pagination', $result->render());
    }

    /**
     * Search.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request)
    {
        $input = $request->all();

        $result = $this->repository->search($input);

        return theme('features.files.index')
            ->with('files', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Files.
     *
     * @return Response
     */
    public function create()
    {
        return theme('features.files.create');
    }

    /**
     * Store a newly created Files in storage.
     *
     * @param FileRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = $this->validation->check(File::$rules);

        if (!$validation['errors']) {
            $file = $this->repository->store($request->all());
        } else {
            return $validation['redirect'];
        }

        Cms::notification('File saved successfully.', 'success');

        return redirect(route('admin.files.index'));
    }

    /**
     * Store a newly created Files in storage.
     *
     * @param FileRequest $request
     *
     * @return Response
     */
    public function upload(Request $request)
    {
        $validation = $this->validation->check([
            'location' => [],
        ]);

        if (!$validation['errors']) {
            $file = $request->file('location');
            $fileSaved = $this->fileService->saveFile($file, 'files/');
            $fileSaved['name'] = CryptoService::encrypt($fileSaved['name']);
            $fileSaved['mime'] = $file->getClientMimeType();
            $fileSaved['size'] = $file->getClientSize();
            $response = $this->responseService->apiResponse('success', $fileSaved);
        } else {
            $response = $this->responseService->apiErrorResponse($validation['errors'], $validation['inputs']);
        }

        return $response;
    }

    /**
     * Remove a file.
     *
     * @param string $id
     *
     * @return Response
     */
    public function remove($id)
    {
        try {
            Storage::delete($id);
            $response = $this->responseService->apiResponse('success', 'success!');
        } catch (Exception $e) {
            $response = $this->responseService->apiResponse('error', $e->getMessage());
        }

        return $response;
    }

    /**
     * Show the form for editing the specified Files.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $files = $this->repository->find($id);

        if (empty($files)) {
            Cms::notification('File not found', 'warning');

            return redirect(route('admin.files.index'));
        }

        return theme('features.files.edit')->with('files', $files);
    }

    /**
     * Update the specified Files in storage.
     *
     * @param int         $id
     * @param FileRequest $request
     *
     * @return Response
     */
    public function update($id, FileRequest $request)
    {
        $files = $this->repository->find($id);

        if (empty($files)) {
            Cms::notification('File not found', 'warning');

            return redirect(route('admin.files.index'));
        }

        $files = $this->repository->update($files, $request->all());

        Cms::notification('File updated successfully.', 'success');

        return Redirect::back();
    }

    /**
     * Remove the specified Files from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $files = $this->repository->find($id);

        if (empty($files)) {
            Cms::notification('File not found', 'warning');

            return redirect(route('admin.files.index'));
        }

        if (is_file(storage_path($files->location))) {
            Storage::delete($files->location);
        } else {
            Storage::disk(\Illuminate\Support\Facades\Config::get('cms.storage-location', 'local'))->delete($files->location);
        }

        $files->delete();

        Cms::notification('File deleted successfully.', 'success');

        return redirect(route('admin.files.index'));
    }

    /**
     * Display the specified Images.
     *
     * @return Response
     */
    public function apiList(Request $request)
    {
        if (\Illuminate\Support\Facades\Config::get('cms.api-key') != $request->header('cms')) {
            return $this->responseService->apiResponse('error', []);
        }

        $files = $this->repository->apiPrepared();

        return $this->responseService->apiResponse('success', $files);
    }
}
