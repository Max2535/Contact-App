<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company' => ['nullable'],
            'bio' => ['nullable'],
            'profile_picture' => ['nullable', 'mimes:jpeg,bmp,png'],
        ];
    }

    public function handleRequest()
    {
        $profileData = $this->validated();
        $profile = $this->user();

        if ($this->hasFile('profile_picture')) {
            if (Storage::exists($this->profile_picture)) {
                unlink(public_path() . '/' . $profile->profile_picture);
                //Storage::delete($this->profile_picture);
            }

            $picture = $this->profile_picture;
            // $picture->getClientOriginalName();
            // $picture->getClientOriginalExtension();
            // $picture->getClientSize();
            // $picture->getClientMimeType();
            $fileName = "profile-picture-{$profile->id}.{$picture->getClientOriginalExtension()}";
            // $picture->move(public_path('upload'), $fileName);
            $fileName = $picture->storeAs('uploads',$fileName);
            //$fileName = Storage::putFileAs('uploads', $picture, $fileName);
            $profileData['profile_picture'] = $fileName;
        }

        return $profileData;
    }
}
