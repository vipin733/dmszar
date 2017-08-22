<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Events\TeacherStaff\TeacherStaffRegister;
use Auth;

class RegisterTeacherForm extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //login details validation
            'reg_no'         => 'required|unique:students',
            'password'       => 'required|min:8',
            'type'           => 'required|boolean',

        //profile details validation
            'avatar_image'      => 'nullable|image|max:10240',
            'name'              => 'required',
            'active'            => 'required|boolean',
            'mob_no'            => 'required|digits:10',
            'last_school'       => 'nullable',
            'experience'        => 'nullable',
            'transportation'    => 'required|boolean',
            'stopeages'         => 'required_if:transportation,1',

        // personal details validation

            'father_name'       => 'required',
            'mother_name'       => 'required',
            'date_of_birth'     => 'required|date_format:d/m/Y',
            'gender'            => 'required|integer',
            'email'             => 'required|email',      
            'emergency_no'      => 'required|digits:10',
            'date_of_joining'   => 'required|date_format:d/m/Y',


        //   addresses validation

            'permanent_address'      =>'required',
            'permanent_district'     => 'required',
            'permanent_state'        => 'required',
            'permanent_zip_pin'      =>'required|digits:6',
            'communication_address'  => 'required',
            'communication_district' => 'required',
            'communication_state'    => 'required',
            'communication_zip_pin'  =>'required|digits:6'
        ];
    }

    public function storing()
    {

      $user = Auth::user();

       if($this->transportation == 1){
            $stopage = $this->stopeages;
        }
            else{

                 $stopage = null;
            }



        if ($this->avatar && $this->hasFile('avatar_image')) {

               flash('Please select either a existing file or capture image')->error()->important();

               return back()->withInput($this->input());

        }else{

           if ($this->avatar) {
            $base64_data = str_replace('data:image/png;base64,','',$this->avatar);
            $img_data = base64_decode($base64_data, true);
            $filename= time() . ".png";
            $avatar_s ='https://s3.ap-south-1.amazonaws.com/dbmszar/teacher_staff/avatar'.'/'.$user->id.'/'.$this->reg_no.'/'. $filename;
            $image = Image::make($img_data);
            $image->orientate();
            $image->orientate();
            $image->resize(512, 512, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            $image->encode('png');
            if(!empty($img_data)){

                Storage::disk('s3')->put("teacher_staff/avatar/$user->id/$this->reg_no/$filename", $img_data);
             }
           }elseif ($this->hasFile('avatar_image')) {
            $filename = time() . ".png";
            $avatar_s ='https://s3.ap-south-1.amazonaws.com/dbmszar/teacher_staff/avatar'.'/'.$user->id.'/'.$this->reg_no.'/'. $filename;
            $image = Image::make($this->file('avatar_image'));
            $image->orientate();
            $image->orientate();
            $image->resize(512, 512, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            $image->encode('png');
            // Save the photo to the disk
            Storage::disk('s3')->put("teacher_staff/avatar/$user->id/$this->reg_no/$filename", $image->__toString());

          }else{
            $avatar_s = null;
           }
        }


         $regno       = $this->reg_no;
         $password    = $this->password;
         $number      = $this->mob_no;
         $type        = $this->type;
         $school      = $user->schoolprofile->school_name;
         $father_name = $this->father_name;
         $mother_name = $this->mother_name;
         $name        = $this->name;


        $data = [

        //login requesting
            'reg_no'     => $regno,
            'password'   => bcrypt($password),
            'type'       => $type,

        //profile requesting
            'avatar'            => $avatar_s,
            'name'              => $name,
            'active'            => $this->active,
            'mob_no'            => $number,
            'last_school'       => $this->last_school,
            'experience'        => $this->experience,
            'transportation'    => $this->transportation,
            'stopage_id'        => $stopage,

         //personal requesting

            'father_name'       => $father_name,
            'mother_name'       => $mother_name,
            'date_of_birth'     => $this->date_of_birth,
            'gender'            => $this->gender,
            'email'             => $this->email,
            'emergency_no'      => $this->emergency_no,
            'date_of_joining'   => $this->date_of_joining,


        //address requesting

            'permanent_address'         => $this->permanent_address,
            'permanent_district_id'     => $this->permanent_district,
            'permanent_state_id'        => $this->permanent_state,
            'permanent_zip_pin'         => $this->permanent_zip_pin,
            'communication_address'     => $this->communication_address,
            'communication_district_id' => $this->communication_district,
            'communication_state_id'    => $this->communication_state,
            'communication_zip_pin'     => $this->communication_zip_pin,

             'bio'                      => $this->bio,



            ];

          $user->teachers()->create($data);

          if ($type == 1) {
            $typename = 'Staff';
          }else{
           $typename = 'Teacher';
          }

          event(new TeacherStaffRegister($number,$regno,$password,$school,$typename, $father_name,$mother_name,$name ));

         flash()->success('Successfully Teacher Created and your Reg No. is '. $regno . ' and password: ' . $password);

    }
}
