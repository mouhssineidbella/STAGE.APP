<?php
require 'vendor/autoload.php'; // تحميل مكتبة PHPWord

use PhpOffice\PhpWord\TemplateProcessor;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // جلب البيانات من النموذج
    $file_number = $_POST['file_number'];
    $request_number = $_POST['request_number'];
    $recipient_name1 = $_POST['recipient_name1'];
    $recipient_address1 = $_POST['recipient_address1'];
    $recipient_name2 = $_POST['recipient_name2'];
    $recipient_address2 = $_POST['recipient_address2'];
    $delivery_date = $_POST['delivery_date'];
    $decision_number = $_POST['decision_number'];
    $decision_date = $_POST['decision_date'];

    // تحميل القالب
    $templatePath = "templates/محضر التبليغ التلقائي.docx";
    $outputFile = "محضر_التبليغ_" . time() . ".docx";

    // إنشاء معالج القالب
    $templateProcessor = new TemplateProcessor($templatePath);

    // استبدال القيم في القالب
    $templateProcessor->setValue('FILE_NUMBER', $file_number);
    $templateProcessor->setValue('Request_Number', $request_number);
    $templateProcessor->setValue('Name_of_the_recipient1', $recipient_name1);
    $templateProcessor->setValue('Name_of_the_recipient2', $recipient_name2);
    $templateProcessor->setValue('Address_of_the_recipient', $recipient_address1);
    $templateProcessor->setValue('DELIVERY_DATE', $delivery_date);
    $templateProcessor->setValue('DECISION_NUMBER', $decision_number);
    $templateProcessor->setValue('DECISION_DATE', $decision_date);
    $templateProcessor->setValue('Notification_Report_Date', $delivery_date);

    // حفظ الملف الجديد
    $templateProcessor->saveAs($outputFile);

    // إرسال الملف للتحميل
    header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header("Content-Disposition: attachment; filename=" . basename($outputFile));
    header("Content-Length: " . filesize($outputFile));
    readfile($outputFile);

    // حذف الملف بعد التحميل (اختياري)
    unlink($outputFile);
    exit;
}
?>
