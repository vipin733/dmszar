<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class AuthSchoolProfileRequest extends FormRequest
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
            'school_name'        =>  'required',
            'school_board'       =>  'required|integer',
            'affiliation_no'     =>  'nullable',
            'school_code_no'     =>  'nullable',
            'website'            =>  'nullable',
            'school_email'       =>  'nullable|email',
            'telephone_no'       =>  'nullable',
            'mobile_no'          =>  'required|digits:10',
            'school_address'     =>  'required',
            'city'               =>  'required',
            'state'              =>  'required|integer',
            'district'           =>  'required|integer',
            'pincode'            =>  'required|digits:6',
            'campuse_type'       =>  'required|integer',
            'main_campuse'       =>  'required|boolean',
            'hostel_service'     =>  'required|boolean',
            'hostel_type'        =>  'required_if:hostel_service,1',
            'transport_service'  =>  'required|boolean'
        ];
    }

    public function storing()
    {
         $data = [
          'school_name'       => $this->school_name,
          'school_board_id'   => $this->school_board,
          'affiliation_no'    => $this->affiliation_no,
          'school_code_no'    => $this->school_code_no,
          'website'           => $this->website,
          'school_email'      => $this->school_email,
          'telephone_no'      => $this->telephone_no,
          'mobile_no'         => $this->mobile_no,
          'school_address'    => $this->school_address,
          'city'              => $this->city,
          'state_id'          => $this->state,
          'district_id'       => $this->district,
          'pincode'           => $this->pincode,
          'campuse_type'      => $this->campuse_type,
          'main_campuse'      => $this->main_campuse,
          'hostel_service'    => $this->hostel_service,
          'hostel_type'       => $this->hostel_type,
          'transport_service' => $this->transport_service,
        ];

        Auth::user()->schoolprofile()->update($data);

        flash('Successfully Information Updated!')->success();
    }
}
