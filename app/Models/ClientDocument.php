<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDocument extends Model
{
    /** @use HasFactory<\Database\Factories\ClientDocumentsFactory> */
    use HasFactory;

    protected $fillable = [
        "document_type",
        "document_name",
        "document_path",
        "notes",
    ];
}