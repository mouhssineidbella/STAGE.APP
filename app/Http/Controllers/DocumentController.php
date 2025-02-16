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

        // Match document type with the correct template filename
        $templates = [
            'notification_report' => 'notification_report.docx',
            'notification_report_copy1' => 'notification_report_copy1.docx',
            'notification_report_copy2' => 'notification_report_copy2.docx',
            'filing_notification' => 'filing_notification.docx',
            'delivery_certificate' => 'delivery_certificate.docx',
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

        $outputFileName = 'generated_' . $documentType . '_' . time() . '.docx';
        $outputFile = storage_path('app/public/' . $outputFileName);

        try {
            $templateProcessor = new TemplateProcessor($templatePath);

            // Log the placeholders before replacement
            Log::info('Replacing placeholders in document:', $data);

            // Replace placeholders
            $templateProcessor->setValue('{FILE_NUMBER}', $data['file_number'] ?? 'N/A');
            $templateProcessor->setValue('{REQUEST_NUMBER}', $data['request_number'] ?? 'N/A');
            $templateProcessor->setValue('{DECISION_NUMBER}', $data['decision_number'] ?? 'N/A');
            $templateProcessor->setValue('{DECISION_DATE}', $data['decision_date'] ?? 'N/A');
            $templateProcessor->setValue('{NAME_OF_THE_RECIPIENT}', $data['recipient_name1'] ?? 'N/A');
            $templateProcessor->setValue('{ADDRESS_OF_THE_RECIPIENT}', $data['recipient_address1'] ?? 'N/A');
            $templateProcessor->setValue('{NOTIFICATION_REPORT_DATE}', $data['delivery_date'] ?? 'N/A');

            // Log after replacement
            Log::info('Placeholders replaced successfully.');

            $templateProcessor->saveAs($outputFile);

        } catch (\Exception $e) {
            return back()->with('error', 'Error generating document: ' . $e->getMessage());
        }

        if (!file_exists($outputFile)) {
            return back()->with('error', 'Failed to generate the document.');
        }

        return response()->download($outputFile)->deleteFileAfterSend(true);
    }
}
