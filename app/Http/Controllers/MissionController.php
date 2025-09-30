<?php

namespace App\Http\Controllers;

use App\Http\Responses\BaseResponse;
use App\Models\Mission;
use App\Services\MissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mission $mission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        //
    }

    public function addResultToUser(Mission $mission, Request $request, MissionService $service) : BaseResponse {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|file',
            'text' => 'nullable|required_without:file|string'
        ], [
            'file.file' => 'Поле должно содержать файл',
            'text.required_without' => 'Необходимо предоставить либо файл, либо текст'
        ]);

        if ($validator->fails()) {
            return new BaseResponse([
                'error' => 'Ошибка валидации',
                'details' => $validator->errors()->toArray()
            ], 422);
        }

        $file = $request->file('file');
        $text = $validated['text'] ?? null;


        return new BaseResponse($service->addResultToUser($mission, $file, $text));
    }
}
