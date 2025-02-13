<?php

require 'vendor/autoload.php'; // تحميل مكتبة PHPWord
use PhpOffice\PhpWord\TemplateProcessor;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استقبال البيانات من النموذج
    $file_number = $_POST['file_number'] ?? '';
    $request_number = $_POST['request_number'] ?? '';
    $decision_number = $_POST['decision_number'] ?? '';
    $decision_date = $_POST['decision_date'] ?? '';
    $recipient_name1 = $_POST['recipient_name1'] ?? '';
    $recipient_address1 = $_POST['recipient_address1'] ?? '';
    $recipient_name2 = $_POST['recipient_name2'] ?? '';
    $recipient_address2 = $_POST['recipient_address2'] ?? '';
    $delivery_date = $_POST['delivery_date'] ?? '';

    // تحميل القالب الصحيح
    $templatePath = "templates/طي التبليغ .docx"; // تأكد من عدم وجود مسافة زائدة في اسم الملف

    if (!file_exists($templatePath)) {
        die("❌ ملف القالب غير موجود! تأكد من أن المسار صحيح: " . $templatePath);
    }

    // قائمة الملفات التي سيتم تحميلها
    $generatedFiles = [];

    // إنشاء طي تبليغ للمستلم الأول إذا كان موجودًا
    if (!empty($recipient_name1)) {
        $outputFile1 = "طي_التبليغ_{$recipient_name1}_" . time() . ".docx";
        $templateProcessor1 = new TemplateProcessor($templatePath);
        $templateProcessor1->setValue('{FILE_NUMBER}', $file_number);
        $templateProcessor1->setValue('{REQUEST_NUMBER}', (string)$request_number);
        $templateProcessor1->setValue('{DECISION_NUMBER}', (string)$decision_number);
        $templateProcessor1->setValue('{DECISION_DATE}', (string)$decision_date);
        $templateProcessor1->setValue('{Name_of_the_recipient}', $recipient_name1);
        $templateProcessor1->setValue('{address_of_the_recipient}', $recipient_address1);
        $templateProcessor1->setValue('{Notification_Report_Date}', (string)$delivery_date);
        $templateProcessor1->saveAs($outputFile1);
        $generatedFiles[] = $outputFile1;
    }

    // إنشاء طي تبليغ للمستلم الثاني إذا كان موجودًا
    if (!empty($recipient_name2)) {
        $outputFile2 = "طي_التبليغ_{$recipient_name2}_" . time() . ".docx";
        $templateProcessor2 = new TemplateProcessor($templatePath);
        $templateProcessor2->setValue('{FILE_NUMBER}', $file_number);
        $templateProcessor2->setValue('{REQUEST_NUMBER}', (string)$request_number);
        $templateProcessor2->setValue('{DECISION_NUMBER}', (string)$decision_number);
        $templateProcessor2->setValue('{DECISION_DATE}', (string)$decision_date);
        $templateProcessor2->setValue('{Name_of_the_recipient}', $recipient_name2);
        $templateProcessor2->setValue('{address_of_the_recipient}', $recipient_address2);
        $templateProcessor2->setValue('{Notification_Report_Date}', (string)$delivery_date);
        $templateProcessor2->saveAs($outputFile2);
        $generatedFiles[] = $outputFile2;
    }

    // إرجاع قائمة الملفات إلى JavaScript لتحميلها تلقائيًا
    echo json_encode($generatedFiles);
    exit;
}
?>
