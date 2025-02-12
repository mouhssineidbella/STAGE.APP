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
    $templatePath = "templates/محضر التبليغ التلقائي - Copie.docx";
    $outputFile = "محضر_التبليغ_" . time() . ".docx";

    // التحقق من وجود القالب
    if (!file_exists($templatePath)) {
        die("❌ ملف القالب غير موجود! تأكد من أن المسار صحيح: " . $templatePath);
    }

    // إنشاء معالج القالب
    $templateProcessor = new TemplateProcessor($templatePath);
    

    // استبدال القيم داخل المستند
    $templateProcessor->setValue('{FILE_NUMBER}', $file_number);
    $templateProcessor->setValue('{Request_Number}', (string)$request_number);
    $templateProcessor->setValue('{Decision_Number}', (string)$decision_number);
    $templateProcessor->setValue('{Decision_Date}', (string)$decision_date);
    $templateProcessor->setValue('{Name_of_the_recipient1}', $recipient_name1);
    $templateProcessor->setValue('{Address_of_the_recipient1}', $recipient_address1);
    $templateProcessor->setValue('{Name_of_the_recipient2}', $recipient_name2);
    $templateProcessor->setValue('{Address_of_the_recipient2}', $recipient_address2);
    $templateProcessor->setValue('{Notification_Report_Date}', (string)$delivery_date);
    
    
    // حفظ الملف الجديد
    $templateProcessor->saveAs($outputFile);

    // تحميل الملف للمستخدم
    header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header("Content-Disposition: attachment; filename=" . basename($outputFile));
    header("Content-Length: " . filesize($outputFile));
    readfile($outputFile);

    // حذف الملف بعد التحميل (اختياري)
    unlink($outputFile);
    exit;
}
?>