<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlEntry extends Model
{
    public const ORIGINAL_URL = 'original_url';
    public const SHORTEND_URL = 'shortened_url';

    public const UNIQUE_ID = 'unique_id';

    protected $fillable = [UrlEntry::ORIGINAL_URL, UrlEntry::SHORTEND_URL, UrlEntry::UNIQUE_ID];

    use HasFactory;
}