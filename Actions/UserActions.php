<?php

namespace App\Actions;

use App\Models\User;
use App\Models\UserRole;

use App\Actions\FileManage\UploadFile;

class UserActions {

  /**
   * Validate and create a newly registered user.
   *
   * @param  array  $input
   * @return \App\Models\User
   */

  public static function create($request) {

    $photo_path = '';
    if ($request->hasFile('photo')) {
      $photo_path = UploadFile::upload($request->file('photo'), "/images/profile/");
    }

    $userData = array([
      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->password,
      'profile_photo_path' => $photo_path
    ]);
    
    $userId=User::store($userData)->id;

    foreach($request->rolls as $role) {
      $roleData = array([
        'user_id' => $userId,
        'role_id' => $role
      ]);
      UserRole::store($roleData);
    }
  }
}
