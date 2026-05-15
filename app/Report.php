<?php
/**
 * Class Report.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Report
 *
 */
class Report extends Model
{
    /**
     * Fillable for the database
     *
     * @access protected
     * @var    array $fillable
     */
    protected $fillable = array(
        'name', 'email', 'description'
    );

    /**
     * Protected Date
     *
     * @access protected
     * @var    array $dates
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Submit Report
     *
     * @param mixed $request req->attr
     *
     * @return request\response
     */
    public function submitReport($request)
    {
        if (!empty($request)) {
            $user = Auth::user();
            $doctor = User::where('id', $request['doctor_id'])->first();
            $this->name = filter_var($request['name'], FILTER_SANITIZE_STRING);
            $this->email = filter_var($request['email'], FILTER_SANITIZE_STRING);
            $this->description = filter_var($request['description'], FILTER_SANITIZE_STRING);
            $this->user_id = filter_var($user->id, FILTER_SANITIZE_STRING);
            $this->doctor_id = filter_var($request['doctor_id'], FILTER_SANITIZE_STRING);
            $this->phone_number = filter_var($request['phone_number'], FILTER_SANITIZE_STRING);
            $this->save();
            $result = array(
                'type' => 'success',
                'user_id' => $request['user_id'],
                'doctor_id' => $request['doctor_id'],
                'user' => $user,
                'doctor' => $doctor,
                'message' => trans('lang.report_submitted')
            );
            return $result;
        }
    }
}
