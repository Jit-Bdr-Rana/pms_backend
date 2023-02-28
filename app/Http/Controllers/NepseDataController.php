<?php

namespace App\Http\Controllers;
use App\Http\Resources\NepseDataResource;
use App\Models\Company;
use App\Models\NepseData;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use SplFileObject;
use Validator;
use \Exception;
use League\Csv\Reader;
class NepseDataController extends Controller
{
        public function store(Request $request){
            $validator=Validator::make($request->all(),[
              'security_name'=>'string|required',
              'open_price'=>'integer',
              'high_price'=>'integer',
              'low_price'=>'integer',
              'close_price'=>'integer',
              'total_traded_quantity'=>'integer',
              'total_traded_value'=>'integer',
              'previous_day_close_price'=>'integer',
              'fifty_two_weeks_high'=>'integer',
              'fifty_two_weeks_low'=>'integer',
              'average_traded_value'=>'integer',
              'market_capitalization'=>'integer',
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
          $nepse_data=NepseData::create(
            [
                'security_name'=>$request->security_name,
                'open_price'=>$request->open_price,
                'high_price'=>$request->high_price,
                'low_price'=>$request->low_price,
                'close_price'=>$request->close_price,
                'total_traded_quantity'=>$request->total_traded_quantity,
                'total_traded_value'=>$request->total_traded_value,
                'previous_day_close_price'=>$request->previous_day_close_price,
                'fifty_two_weeks_high'=>$request->fifty_two_weeks_high,
                'fifty_two_weeks_low'=>$request->fifty_two_weeks_low,
                'average_traded_value'=>$request->average_traded_value,
                'market_capitalization'=>$request->market_capitalization,
                'company_id'=>$request->company_id

            ]
          );
          return response()->json(['message'=>'successfully created company','status'=>true,'data'=>$nepse_data,201]);
        }catch(\Exception $ex){
          return response()->json(['errors'=>'server fail','status'=>false,500]);
        }
          }  //

          public function getAll(){
            try{
                $compnaylist=NepseData::all();
                $rerfacor=NepseDataResource::collection($compnaylist);
                return response()->json(['message'=>'successfully get nepse data','status'=>true,'data'=>$rerfacor,201]);
            }catch(\Exception $ex){
                return response()->json(['errors'=>'server fail','status'=>false,500]);
            }
          }


          public function update(Request $request,$id){
            $validator=Validator::make($request->all(),[
              'security_name'=>'string|required',
              'open_price'=>'integer',
              'high_price'=>'integer',
              'low_price'=>'integer',
              'close_price'=>'integer',
              'total_traded_quantity'=>'integer',
              'total_traded_value'=>'integer',
              'previous_day_close_price'=>'integer',
              'fifty_two_weeks_high'=>'integer',
              'fifty_two_weeks_low'=>'integer',
              'average_traded_value'=>'integer',
              'market_capitalization'=>'integer',
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
            $nepse_data=NepseData::find($id);
            if($nepse_data){
                $nepse_data->security_name=$request->security_name??$nepse_data->security_name;
                $nepse_data->open_price=$request->open_price??$nepse_data->open_price;
                $nepse_data->high_price=$request->high_price??$nepse_data->high_price;
                $nepse_data->low_price=$request->low_price??$nepse_data->low_price;
                $nepse_data->close_price=$request->close_price??$nepse_data->close_price;
                $nepse_data->total_traded_quantity=$request->total_traded_quantity??$nepse_data->total_traded_quantity;
                $nepse_data->total_traded_value=$request->total_traded_value??$nepse_data->total_traded_value;
                $nepse_data->previous_day_close_price=$request->previous_day_close_price??$nepse_data->previous_day_close_price;
                $nepse_data->fifty_two_weeks_high=$request->fifty_two_weeks_high??$nepse_data->fifty_two_weeks_high;
                $nepse_data->fifty_two_weeks_low=$request->fifty_two_weeks_low??$nepse_data->fifty_two_weeks_low;
                $nepse_data->average_traded_value=$request->average_traded_value??$nepse_data->average_traded_value;
                $nepse_data->market_capitalization=$request->market_capitalization??$nepse_data->market_capitalization;
                $nepse_data->save();
            }
            return response()->json(['message'=>'successfully updated role','status'=>true,'data'=>$nepse_data],201);

          }catch(Exception $ex){
            return response()->json(['errors'=>'server fail','status'=>false,500]);
          }
         }



         public function getById($id){
            try{
                $nepse_data=NepseData::find($id);
                return response()->json(['message'=>'successfully get role','status'=>true,'data'=>$nepse_data,200]);
            }catch(Exception $ex){
                return response()->json(['errors'=>'server fail','status'=>false,500]);
            }
          }



          public function delete($id){
            try{
                $nepse_data=NepseData::find($id);
                $nepse_data->delete();
                return response()->json(['message'=>'successfully deleted record','status'=>true,'data'=>$nepse_data,200]);
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
                  if(  NepseData::whereDate('created_at','=',Carbon::now())->count()>0){
                    return response()->json(['message' => 'already exist.']);
                  }

            foreach ($csv as $row) {
                // Process each row of the CSV file
                // ...
                // c[]=$row->BUSINESS_DATE;

                if($isFirst){
                    $isFirst=false;
                    continue;
                }
                if($row[3]){
                    $company=Company::where("symbol",$row[3])->first();
                   if($company){
                    $nepse_data=NepseData::create(
                        [
                            'security_name'=>$row[4],
                            'open_price'=>$row[5],
                            'high_price'=>$row[6],
                            'low_price'=>$row[7],
                            'close_price'=>$row[8],
                            'total_traded_quantity'=>$row[9],
                            'total_traded_value'=>$row[10],
                            'previous_day_close_price'=>$row[11],
                            'fifty_two_weeks_high'=>$row[12],
                            'fifty_two_weeks_low'=>$row[13],
                            'average_traded_value'=>$row[17],
                            'market_capitalization'=>$row[18],
                            'company_id'=>$company->id
                        ]
                      );
                    array_push($c,$nepse_data);
                   }
                }
            }
            return response()->json(['message' => 'CSV file uploaded and processed.','data'=>$c]);
        } else {
            return response()->json(['error' => 'Invalid file.'], 400);
        }
     }

    }

