<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    

  public function store($request){
        dd('its store ');
  }

  public function getAll(){
     dd("it return all the list of companies");
  }



}
