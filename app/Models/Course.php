<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'user_id', // ID del instructor
        'category_id',
        'level_id',
        'cover_image_url',
    ];

    /**
     * Obtiene los estudiantes inscritos en el curso.
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_enrollments');
    }

    /**
     * Obtiene el instructor que imparte el curso.
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Obtiene los módulos que componen el curso.
     */
    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }
}
