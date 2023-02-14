<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    

  public function store($request){
    //company information store here
        dd('its store ');
  }

  public function getAll(){
    //get all company here 
     dd("it return all the list of companies");
  }



}
