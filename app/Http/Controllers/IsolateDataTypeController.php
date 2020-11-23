<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IsolateDataTypeController extends Controller
{
    public function view()
    {
        return view('isolatedatatype.view');
    }


   public function IsolateTypeView()
    {
        return view('isolatedatatype.isolatetypeview');
    }


 public function IsolateTypeIndividualView()
    {
        return view('isolatedatatype.isolatetypeindividualview');
    }


 public function IsolateTypeSummarizeView()
    {
        return view('isolatedatatype.isolatetypesummarizeview');
    }





    public function DataView()
    {
        return view('isolatedatatype.dataview');
    }


}
