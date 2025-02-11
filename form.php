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
    <form action="generate_word.php" method="post" class="border border-3 p-4 rounded">
        
        <div class="mb-3">
            <label>📌 رقم الملف:</label>
            <input type="text" name="file_number" class="form-control p-3" required>
        </div>

        <div class="mb-3">
            <label>📌 رقم الطلب:</label>
            <input type="text" name="request_number" class="form-control p-3" required>
        </div>

        <div class="mb-3">
            <label>📌 اسم المستلم 1:</label>
            <input type="text" name="recipient_name1" class="form-control p-3" required>
        </div>

        <div class="mb-3">
            <label>📌 عنوان المستلم 1:</label>
            <input type="text" name="recipient_address1" class="form-control p-3" required>
        </div>

        <div class="mb-3">
            <label>📌 اسم المستلم 2:</label>
            <input type="text" name="recipient_name2" class="form-control p-3">
        </div>

        <div class="mb-3">
            <label>📌 عنوان المستلم 2:</label>
            <input type="text" name="recipient_address2" class="form-control p-3">
        </div>

        <div class="mb-3">
            <label>📌 تاريخ التبليغ:</label>
            <input type="date" name="delivery_date" class="form-control p-3" required>
        </div>

        <div class="mb-3">
            <label>📌 رقم القرار:</label>
            <input type="text" name="decision_number" class="form-control p-3" required>
        </div>

        <div class="mb-3">
            <label>📌 تاريخ القرار:</label>
            <input type="date" name="decision_date" class="form-control p-3" required>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" name="type" value="notification" class="btn btn-primary btn-custom">🔹 تحميل محضر التبليغ</button>
            <button type="submit" name="type" value="filing" class="btn btn-secondary btn-custom">🔹 تحميل طي التبليغ</button>
        </div>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
