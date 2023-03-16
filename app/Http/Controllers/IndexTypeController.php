<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndexType;
use Validator;
use Exception;

class IndexTypeController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'string|required',
            'value' => 'string|required',
            'date' => 'string|required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->getMessages();
            $error = [];
            foreach ($errors as $key => $value) {
                $error[$key] = $value;
            }
            return response()->json(['errors' => $error, 'status' => false], 400);
        }
        try {
            $index_type = IndexType::create(
                [
                    'type' => $request->type,
                    'value' => $request->value,
                    'date' => $request->date,
                ]
            );
            return response()->json(['message' => 'successfully created indices', 'status' => true, 'data' => $index_type, 201]);
        } catch (Exception $ex) {
            return response()->json(['errors' => 'server fail', 'status' => false, 500]);
        }
    }

    public function importCsv(Request $request)
    {
        $file = $request->file('csv_file');

        if ($file->isValid()) {
            // $filePath = $file->getPathname();

            // $csv = new SplFileObject($filePath);
            // $csv->setFlags(SplFileObject::READ_CSV);

            // dd($csv);

            // foreach ($csv as $row) {
            //     // Process each row of the CSV file
            //     // ...

            // }
            $csv = Reader::createFromPath($file->getPathname());
            $c = [];
            $isFirst = true;


            foreach ($csv as $row) {
                // Process each row of the CSV file
                // ...
                // c[]=$row->BUSINESS_DATE;

                if ($isFirst) {
                    $isFirst = false;
                    continue;
                }
                $nepse_data = IndexType::create(
                    [

                        'type' => $row[0],
                        'value' => $row[1],
                        'date' => $row
                    ]
                );
                array_push($c, $nepse_data);
            }
            return response()->json(['message' => 'CSV file uploaded and processed.', 'data' => $c]);
        } else {
            return response()->json(['error' => 'Invalid file.'], 400);
        }
    }
}