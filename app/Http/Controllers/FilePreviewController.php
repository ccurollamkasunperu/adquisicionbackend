<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FilePreviewController extends Controller
{
    public function base64FromPath(Request $request)
    {
        $ruta = (string) $request->input('ruta');
        $disk = Storage::disk('local');

        $existsStorage = $disk->exists($ruta);
        $existsFile    = file_exists($ruta);

        $mime = $disk->mimeType($ruta) ?? 'application/octet-stream';
        if ($mime === 'application/octet-stream') {
            $ext = strtolower(pathinfo($ruta, PATHINFO_EXTENSION));
            $map = [
                'jpg'  => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png'  => 'image/png',
                'pdf'  => 'application/pdf',
            ];
            if (isset($map[$ext])) {
                $mime = $map[$ext];
            }
        }

        $allowed = ['image/jpg','image/jpeg','image/png','application/pdf'];
        $dataUri = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($ruta));

        return response()->json([
            'name'         => basename($ruta),
            'mime'         => $mime,
            'dataUri'      => $dataUri,
            'ruta_fisica'  => $ruta
        ]);
    }
}
