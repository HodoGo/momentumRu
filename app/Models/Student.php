<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = ["id"];

    protected $casts = [
        "gender" => Gender::class,
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
    public function student_quiz(): HasMany
    {
        return $this->hasMany(StudentQuiz::class);
    }
    public function quizzes(): BelongsToMany
    {
        return $this->belongsToMany(Quiz::class, "student_quizzes", "student_id", "quiz_id")->withPivot("is_done", "score");
    }

}
