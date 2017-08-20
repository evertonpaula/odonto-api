<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function upload() {
        $arr = [];

        $this->validate($this->request, [
            'files'   => 'array|required',
            'files.*' => 'mimes:jpeg,bmp,png',
            'files.*' => 'mimetypes:image/png,image/bmp,image/jpeg,image/jpg'
        ]);

        foreach($this->request->files as $files) {
            foreach ($files as $file) {
                $arr[] = [
                    'mime'          => $file->getMimeType(),
                    'size'          => $file->getClientSize(),
                    'isValid'       => $file->isValid(),
                    'original_name' => $file->getClientOriginalName()
                ];
            }
        }

        return $this->parseResult($arr, 'upload realizado com sucesso');
    }
}
