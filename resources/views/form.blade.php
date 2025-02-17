<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدخال بيانات التبليغ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            direction: rtl;
            text-align: right;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        .btn-custom {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h3 class="text-center mb-4">📄 إدخال بيانات التبليغ</h3>
    
    <form id="notificationForm" method="POST" action="{{ route('generate.document') }}" onsubmit="return debugForm()" class="border border-3 p-4 rounded">
    @csrf 

    <label>📌 رقم الملف:</label>
    <input type="text" id="file_number" name="file_number" class="form-control p-3" required>

    <label>📌 رقم الطلب:</label>
    <input type="text" id="request_number" name="request_number" class="form-control p-3" required>

    <label>📌 اسم المستلم 1:</label>
    <input type="text" id="recipient_name1" name="recipient_name1" class="form-control p-3" required>

    <label>📌 عنوان المستلم 1:</label>
    <input type="text" id="recipient_address1" name="recipient_address1" class="form-control p-3" required>

    <label>📌 اسم المستلم 2:</label>
    <input type="text" id="recipient_name2" name="recipient_name2" class="form-control p-3">

    <label>📌 عنوان المستلم 2:</label>
    <input type="text" id="recipient_address2" name="recipient_address2" class="form-control p-3">

    <label>📌 تاريخ التبليغ:</label>
    <input type="date" id="delivery_date" name="delivery_date" class="form-control p-3" required>

    <label>📌 رقم القرار:</label>
    <input type="text" id="decision_number" name="decision_number" class="form-control p-3" required>

    <label>📌 تاريخ القرار:</label>
    <input type="date" id="decision_date" name="decision_date" class="form-control p-3" required>

    <label>📄 اختر نوع الوثيقة:</label>
    <select id="document_type" name="document_type" class="form-control p-3" required>
        <option value="notification_report_copy1">محضر التبليغ التلقائي</option>
        <option value="filing_notification">طي التبليغ</option>
        <option value="delivery_certificate">شهادة التسليم</option>
    </select>

    <button type="submit" class="btn btn-primary btn-custom mt-3">🔹 تحميل الوثيقة</button>
</form>

<script>
function debugForm() {
    let formData = new FormData(document.getElementById("notificationForm"));
    console.log("Form Data Being Sent:");
    for (var pair of formData.entries()) {
        console.log(pair[0] + ": " + pair[1]);
    }
    return true;
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
