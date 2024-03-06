<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProjectDocument extends Model
{
    use HasFactory;

    protected $table = 'project_documents';

    protected $fillable = [
        'project_id',
        'purchase_request',
        'price_quotation',
        'abstract_of_canvass',
        'material_and_cost_estimates',
        'budget_utilization_request',
        'project_initiation_proposal',
        'annual_procurement_plan',
        'purchase_order',
        'market_study',
        'certificate_of_fund_allotment',
        'complete_staff_work',
        'accomplishment_report',
        'supplementary_document',
    ];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Retrieve all PDF files associated with the project document
    public function getAllPdfs()
    {
        $pdfs = [];
        foreach ($this->fillable as $column) {
            if ($this->$column !== null) {
                $pdfs[$column] = $this->$column;
            }
        }
        return $pdfs;
    }

    public function getFileContent($columnName)
    {
        // Check if the specified column name exists in the fillable attributes
        if (!in_array($columnName, $this->fillable)) {
            return null; // Column not allowed
        }
    
        // Get the file path from the specified column name
        $filePath = $this->$columnName;
    
        // Check if the file path exists
        if (!$filePath || !Storage::exists($filePath)) {
            return null; // File not found
        }
    
        // Retrieve and return the file content
        return Storage::get($filePath);
    }
    
}
