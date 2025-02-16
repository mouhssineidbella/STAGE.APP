<?php

require 'vendor/autoload.php'; // تحميل مكتبة PHPWord
use PhpOffice\PhpWord\TemplateProcessor;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استقبال البيانات من النموذج
    $file_number = $_POST['file_number'] ?? '';
    $request_number = $_POST['request_number'] ?? '';
    $decision_number = $_POST['decision_number'] ?? '';
    $decision_date = $_POST['decision_date'] ?? '';
    $delivery_date = $_POST['delivery_date'] ?? '';
    $recipient_name1 = $_POST['recipient_name1'] ?? '';
    $recipient_address1 = $_POST['recipient_address1'] ?? '';
    $recipient_name2 = $_POST['recipient_name2'] ?? '';
    $recipient_address2 = $_POST['recipient_address2'] ?? '';

    // تحميل القالب الصحيح
    $templatePath = __DIR__ . '/templates/شهادة التسليم التبليغ التلقائي.docx';

    if (!file_exists($templatePath)) {
        die(json_encode(["error" => "❌ ملف القالب غير موجود! تأكد من أن المسار صحيح: " . $templatePath]));
    }

    // قائمة الملفات التي سيتم تحميلها
    $generatedFiles = [];

    // إنشاء شهادة تسليم للمستلم الأول إذا كان موجودًا
    if (!empty($recipient_name1)) {
        $outputFile1 = __DIR__ . "/generated_files/شهادة_التسليم_{$recipient_name1}_" . time() . ".docx";
        $templateProcessor1 = new TemplateProcessor($templatePath);
        $templateProcessor1->setValue('{FILE_NUMBER}', $file_number);
        $templateProcessor1->setValue('{REQUEST_NUMBER}', (string)$request_number);
        $templateProcessor1->setValue('{DECISION_NUMBER}', (string)$decision_number);
        $templateProcessor1->setValue('{DECISION_DATE}', (string)$decision_date);
        $templateProcessor1->setValue('{NAME_OF_THE_RECIPIENT}', $recipient_name1);
        $templateProcessor1->setValue('{ADDRESS_OF_THE_RECIPIENT}', $recipient_address1);
        $templateProcessor1->setValue('{NOTIFICATION_REPORT_DATE}', (string)$delivery_date);
        $templateProcessor1->saveAs($outputFile1);
        $generatedFiles[] = "generated_files/" . basename($outputFile1);
    }

    // إنشاء شهادة تسليم للمستلم الثاني إذا كان موجودًا
    if (!empty($recipient_name2)) {
        $outputFile2 = __DIR__ . "/generated_files/شهادة_التسليم_{$recipient_name2}_" . time() . ".docx";
        $templateProcessor2 = new TemplateProcessor($templatePath);
        $templateProcessor2->setValue('{FILE_NUMBER}', $file_number);
        $templateProcessor2->setValue('{REQUEST_NUMBER}', (string)$request_number);
        $templateProcessor2->setValue('{DECISION_NUMBER}', (string)$decision_number);
        $templateProcessor2->setValue('{DECISION_DATE}', (string)$decision_date);
        $templateProcessor2->setValue('{NAME_OF_THE_RECIPIENT}', $recipient_name2);
        $templateProcessor2->setValue('{ADDRESS_OF_THE_RECIPIENT}', $recipient_address2);
        $templateProcessor2->setValue('{NOTIFICATION_REPORT_DATE}', (string)$delivery_date);
        $templateProcessor2->saveAs($outputFile2);
        $generatedFiles[] = "generated_files/" . basename($outputFile2);
    }

    // إرجاع قائمة الملفات إلى JavaScript لتحميلها تلقائيًا
    echo json_encode($generatedFiles);
    exit;
}
?>
