<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Interfaces\CommonRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommonController extends Controller
{
    //
    protected $CommonRepository;

    public function __construct(CommonRepositoryInterface $CommonRepository)
    {
        $this->CommonRepository = $CommonRepository;
    }

    public function StatusSelect(Request $request)
    {
        $status = $this->CommonRepository->StatusSelect();
        return response()->json([
            'status'=> "OK",
            "message"=>"Se ejecuto correctamente",
            "data"=> $status
        ],Response::HTTP_OK);
    }

    public function PrioritySelect(Request $request)
    {
        $priority = $this->CommonRepository->PrioritySelect();
        return response()->json([
            'status'=> "OK",
            "message"=>"Se ejecuto correctamente",
            "data"=> $priority
        ],Response::HTTP_OK);
    }
}
