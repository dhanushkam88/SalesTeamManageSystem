<?php


namespace App\Repositories\DocImport;

use App\Imports\DocImport;
use Maatwebsite\Excel\Facades\Excel;

class DocImportRepository implements DocImportRepositoryInterface
{
    public function importDoc ()
    {
        try {
            if (request()->hasFile('file')) {
                Excel::import(new DocImport, request()->file('file')->store('temp'));
                return redirect()->back()->with('message', 'Upload successful');
            }
        }catch (Exception $e) {
            $data = $e->getMessage();
        }
    }
}

