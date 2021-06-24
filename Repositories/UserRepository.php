<?php

namespace App\Repositories;

use App\Modal\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserRepository {
    public function userRecord() {
        try{ 
            $response['status'] = 200;
            $response['users'] = User::paginate(15);
            return $response;
        }
        catch (\Exception $e) {
            Log::error(
                'Failed to fetch data'
            );
            return false;
        }

        
    }
}