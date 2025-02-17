<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function generate(Request $request)
    {
        $data = $request->all();
    
        // Define document templates
        $templates = [
            'delivery_certificate' => 'delivery_certificate.docx',
            'filing_notification' => 'filing_notification.docx',
        ];
    
        $documentType = $request->input('document_type');
    
        if (!isset($templates[$documentType])) {
            return back()->with('error', 'Invalid document type selected.');
        }
    
        $templateFile = $templates[$documentType];
        $templatePath = storage_path('app/templates/' . $templateFile);
    
        if (!file_exists($templatePath)) {
            return back()->with('error', 'Template file not found: ' . $templateFile);
        }
    
        $generatedFiles = [];
    
        try {
            // ✅ Generate for Recipient 1
            $outputFile1 = storage_path('app/public/generated_' . $documentType . '_recipient1_' . time() . '.docx');
            $templateProcessor1 = new TemplateProcessor($templatePath);
            $templateProcessor1->setValue('{NAME_OF_THE_RECIPIENT}', $data['recipient_name1'] ?? 'N/A');
            $templateProcessor1->setValue('{ADDRESS_OF_THE_RECIPIENT}', $data['recipient_address1'] ?? 'N/A');
            $templateProcessor1->setValue('{FILE_NUMBER}', $data['file_number'] ?? 'N/A');
            $templateProcessor1->setValue('{REQUEST_NUMBER}', $data['request_number'] ?? 'N/A');
            $templateProcessor1->setValue('{DECISION_NUMBER}', $data['decision_number'] ?? 'N/A');
            $templateProcessor1->setValue('{DECISION_DATE}', $data['decision_date'] ?? 'N/A');
            $templateProcessor1->setValue('{NOTIFICATION_REPORT_DATE}', $data['delivery_date'] ?? 'N/A');
            $templateProcessor1->saveAs($outputFile1);
            $generatedFiles[] = $outputFile1;
    
            // ✅ Generate for Recipient 2 (if exists)
            if (!empty($data['recipient_name2'])) {
                $outputFile2 = storage_path('app/public/generated_' . $documentType . '_recipient2_' . time() . '.docx');
                $templateProcessor2 = new TemplateProcessor($templatePath);
                $templateProcessor2->setValue('{NAME_OF_THE_RECIPIENT}', $data['recipient_name2'] ?? 'N/A');
                $templateProcessor2->setValue('{ADDRESS_OF_THE_RECIPIENT}', $data['recipient_address2'] ?? 'N/A');
                $templateProcessor2->setValue('{FILE_NUMBER}', $data['file_number'] ?? 'N/A');
                $templateProcessor2->setValue('{REQUEST_NUMBER}', $data['request_number'] ?? 'N/A');
                $templateProcessor2->setValue('{DECISION_NUMBER}', $data['decision_number'] ?? 'N/A');
                $templateProcessor2->setValue('{DECISION_DATE}', $data['decision_date'] ?? 'N/A');
                $templateProcessor2->setValue('{NOTIFICATION_REPORT_DATE}', $data['delivery_date'] ?? 'N/A');
                $templateProcessor2->saveAs($outputFile2);
                $generatedFiles[] = $outputFile2;
            }
    
        } catch (\Exception $e) {
            return back()->with('error', 'Error generating document: ' . $e->getMessage());
        }
    
        if (empty($generatedFiles)) {
            return back()->with('error', 'No files were generated.');
        }
    
        // Zip files for download
        $zipFilePath = storage_path('app/public/generated_documents_' . time() . '.zip');
        $zip = new \ZipArchive();
        if ($zip->open($zipFilePath, \ZipArchive::CREATE) === TRUE) {
            foreach ($generatedFiles as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();
        }
    
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
    
}
