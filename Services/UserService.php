<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Actions\UserActions;
use Illuminate\Support\Facades\Log;

class UserService
{
  protected $userRepository;

  public function __construct(UserRepository $userRepository) {

    $this->userRepository = $userRepository;
  
  }
  
  public function userRecord() {

    $user_data = $this->userRepository->userRecord();
    if ($user_data) {

      Log::info('List fetched successfully', ['method' => __METHOD__]);
      return response()->json(['response' => ['code' => 200, 'message' => 'List fetched successfully', 'data' => $user_data]]);
    
    } else {
    
      return response()->json(['response' => ['code' => 400, 'message' => 'Unable to fetch the list', 'data' => $list]]);
   
    }

  }

  public function add($request){
    
    UserActions::create($request);

  }
}