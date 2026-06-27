<?php



namespace app\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserService
{
    public function __construct(protected readonly UserRepository $userRepository){}


    public function imageSave($image)
    {
        $name = $image->getClientOriginalName();
        $path = $image->store('user-image', 'public');
        return $path;
    }
    public function update($data)
    {
        $dataSend = $data->validate([
            "image" => "nullable|file|mimes:jpg,jpeg,png|max:10240",
            "password" => "nullable|string",
            "new_password" => "nullable|string|min:6",
            "lang" => "nullable|string"
        ]);
        $path_image = null;
        if ($dataSend['password'] && $dataSend['new_password'])
            {
                if($data->hasFile('image'))
                    {
                        $path_image = $this->imageSave($dataSend['image']);
                    }

                if (Hash::check($dataSend['password'], Auth::user()->password))
                    {
                        $dataSend['password'] = $dataSend['new_password'];
                        $dataSend = Arr::except($dataSend,  'new_password');
                    }
                else {
                        return []; // Xato chiqarayotgan qilish zarur
                    }
            }

        elseif ($data->hasFile('image'))
            {
                $path_image = $this->imageSave($dataSend['image']);
                $dataSend = Arr::except($dataSend, ['password', 'new_password']);
            }

        else 
            {
                $dataSend = Arr::except($dataSend, ['password', 'new_password']);
            }

        $dataSend = Arr::except($dataSend, 'image');
        $user = Auth::user();
        $user->update($dataSend);
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            ["image" => $path_image]
        );
        return $user;
        
    }
}