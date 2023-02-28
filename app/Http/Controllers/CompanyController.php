<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use League\Csv\Reader;
use Validator;
use \Exception;
class CompanyController extends Controller
{


  public function store(Request $request){
    $validator=Validator::make($request->all(),[
      'symbol'=>'string|required',
      'name'=>'string|required',
      'sector'=>'string|required'
 ]);
  if($validator->fails()){
    $errors=$validator->errors()->getMessages();
    $error=[];
    foreach($errors as $key=>$value){
        $error[$key]=$value;
    }
    return response()->json(['errors'=>$error,'status'=>false],400);
  }
 try{
  $company=Company::create(
    [
        'symbol'=>$request->symbol,
        'name'=>$request->name,
        'sector'=>$request->sector,
    ]
  );
  return response()->json(['message'=>'successfully created company','status'=>true,'data'=>$company,201]);
}catch(Exception $ex){
  return response()->json(['errors'=>'server fail','status'=>false,500]);
}
  }

  public function getAll(){
    try{
      $compantlist=Company::all();
      return response()->json(['message'=>'successfully get compnay record','status'=>true,'data'=>$compantlist,201]);
  }catch(Exception $ex){
      return response()->json(['errors'=>'server fail','status'=>false,500]);
  }
  }

  public function update(Request $request,$id){
    $validator=Validator::make($request->all(),[
        'symbol'=>'string',
        'name'=>'string',
        'sector'=>'string'
   ]);

  if($validator->fails()){
    $errors=$validator->errors()->getMessages();
    $error=[];
    foreach($errors as $key=>$value){
        $error[$key]=$value;
    }
    return response()->json(['errors'=>$error,'status'=>false],400);
  }
  try{
    $company=Company::find($id);
    if($company){
        $company->name=$request->name??$company->name;
        $company->sector=$request->sector??$company->sector;
        $company->symbol=$request->symbol??$company->symbol;
        $company->save();
    }
    return response()->json(['message'=>'successfully updated role','status'=>true,'data'=>$company],201);

  }catch(Exception $ex){
    return response()->json(['errors'=>'server fail','status'=>false,500]);
  }
 }


 public function getById($id){
    try{
        $company=Company::find($id);
        return response()->json(['message'=>'successfully get role','status'=>true,'data'=>$company,200]);
    }catch(Exception $ex){
        return response()->json(['errors'=>'server fail','status'=>false,500]);
    }
  }

  public function delete($id){
    try{
        $company=Company::find($id);
        $company->delete();
        return response()->json(['message'=>'successfully deleted record','status'=>true,'data'=>$company,200]);
    }catch(Exception $ex){
        return response()->json(['errors'=>'server fail','status'=>false,500]);
    }
  }


  public function importCsv(Request $request){
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
        $c=[];
        $isFirst=true;

        foreach ($csv as $row) {
            // Process each row of the CSV file
            // ...
            // c[]=$row->BUSINESS_DATE;

            if($isFirst){
                $isFirst=false;
                continue;
            }
                $company=Company::create(
                    [
                        'symbol'=>$row[3],
                        'name'=>$row[4]
                    ]
                  );
                array_push($c,$company);


        }
        return response()->json(['message' => 'CSV file uploaded and processed.','data'=>$c]);
    } else {
        return response()->json(['error' => 'Invalid file.'], 400);
    }
 }

}
