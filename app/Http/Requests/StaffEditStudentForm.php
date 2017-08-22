<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Student;
use Auth;

class StaffEditStudentForm extends FormRequest
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

            'active'         => 'required|boolean',

        //profile details validation

            'avatar_image'      => 'nullable|image|max:10240',
            'name'              => 'required',
            'course'            => 'required',
            'created_course'    => 'required',
            'asession'          => 'required',
            'date_of_admission' => 'required|date_format:d/m/Y',
            'hostel'            => 'required|boolean',
            'hostel_type'       => 'required_if:hostel,1',
            'transportation'    => 'required|boolean',
            'stopeages'         => 'required_if:transportation,1',

        // personal details validation

            'father_name'       => 'required',
            'mother_name'       => 'required',
            'date_of_birth'     => 'required|date_format:d/m/Y',
            'gender'            => 'required|integer',
            'religion'          => 'required',
            'castec'            => 'nullable',
            'occupation'        => 'nullable',
            'caste'             => 'nullable',
            'emer_no'           => 'required|digits:10',
            'parent_no'         => 'required|digits:10',
            'parent_email'      => 'nullable|email',

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

         $user = Auth::user()->owner;

        $student = Student::where('uuid',$this->uuid)
                          ->where('reg_no',$this->reg_no)
                          ->where('user_id',$user->id)->first();

       if($this->transportation == 1){
            $stopage = $this->stopeages;
        }
            else{

                 $stopage = null;
            }

             if($this->hostel == 1){
            $hostels = $this->hostel_type;
        }
            else{

                 $hostels = null;
            }



        if ($this->avatar && $this->hasFile('avatar_image')) {

               flash('Please select either a existing file or capture image')->error()->important();

               return back()->withInput($this->input());

        }else{

           if ($this->avatar) {
            $base64_data = str_replace('data:image/png;base64,','',$this->avatar);
            $img_data = base64_decode($base64_data, true);
            $filename= time() . ".png";
            $avatar_s ='https://s3.ap-south-1.amazonaws.com/dbmszar/student/avatar'.'/'.$user->id.'/'.$student->reg_no.'/'. $filename;
            $image = Image::make($img_data);
            $image->orientate();
            $image->orientate();
            $image->resize(512, 512, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            $image->encode('png');
            if(!empty($img_data)){

                Storage::disk('s3')->put("student/avatar/$user->id/$student->reg_no/$filename", $img_data);
             }
           }elseif ($this->hasFile('avatar_image')) {
            $filename = time() . ".png";
            $avatar_s ='https://s3.ap-south-1.amazonaws.com/dbmszar/student/avatar'.'/'.$user->id.'/'.$student->reg_no.'/'. $filename;
            $image = Image::make($this->file('avatar_image'));
            $image->orientate();
            $image->orientate();
            $image->resize(512, 512, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            $image->encode('png');
            // Save the photo to the disk
            Storage::disk('s3')->put("student/avatar/$user->id/$student->reg_no/$filename", $image->__toString());

          }else{
            $avatar_s =  $student->avatar;
           }
        }



         $data = [

        //login requesting
            'active'            => $this->active,

        //profile requesting
            'avatar'            => $avatar_s,
            'name'              => $this->name,
            'course_id'         => $this->course,
            'created_course_id' => $this->created_course,
            'created_asession_id'=> $this->asession,
            'date_of_admission' => $this->date_of_admission,
            'last_school'       => $this->last_school,
            'transportation'    => $this->transportation,
            'stopage_id'        => $stopage,
            'hostel'            => $this->hostel,
            'hostel_type_id'    => $hostels,

         //personal requesting

            'father_name'       => $this->father_name,
            'mother_name'       => $this->mother_name,
            'date_of_birth'     => $this->date_of_birth,
            'gender'            => $this->gender,
            'religion'          => $this->religion,
            'castec'            => $this->castec,
            'caste'             => $this->caste,
            'occupation'        => $this->occupation,
            'emer_no'           => $this->emer_no,
            'parent_no'         => $this->parent_no,
            'parent_email'      => $this->parent_email,

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

            $student->update($data);

            flash()->success('Successfully Student Record Update!');
    }
}
