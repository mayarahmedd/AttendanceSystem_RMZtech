<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $validated)
 * @property mixed id
 * @property mixed students
 */
class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'user_id', 'date'];

    protected $dates = ['date', 'created_at'];

    /**
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'attendance_student', 'attendance_id','student_id')->withPivot('status');
    }

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * @return BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //scopes --------------------------------------------------
    public function scopeWhereCourse($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('course_id', "$search");
        });
    }// end of scopeWhenSearch

    //scopes --------------------------------------------------
    public function scopeWhereDateIs($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('date', Carbon::parse($search)->format('Y-m-d'));
        });
    }// end of scopeWhenSearch
}
