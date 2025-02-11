<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدخال بيانات التبليغ</title>
</head>
<body>

<h2>إدخال بيانات التبليغ</h2>
<form action="generate_word.php" method="post">
    <label>📌 رقم الملف:</label>
    <input type="text" name="file_number" required><br><br>

    <label>📌 رقم الطلب:</label>
    <input type="text" name="request_number" required><br><br>

    <label>📌 اسم المستلم 1:</label>
    <input type="text" name="recipient_name1" required><br><br>

    <label>📌 عنوان المستلم 1:</label>
    <input type="text" name="recipient_address1" required><br><br>

    <label>📌 اسم المستلم 2:</label>
    <input type="text" name="recipient_name2" required><br><br>

    <label>📌 عنوان المستلم 2:</label>
    <input type="text" name="recipient_address2" required><br><br>

    <label>📌 تاريخ التبليغ:</label>
    <input type="date" name="delivery_date" required><br><br>

    <label>📌 رقم القرار:</label>
    <input type="text" name="decision_number" required><br><br>

    <label>📌 تاريخ القرار:</label>
    <input type="date" name="decision_date" required><br><br>

    <button type="submit" name="type" value="notification">🔹 تحميل محضر التبليغ</button>
    <button type="submit" name="type" value="filing">🔹 تحميل طي التبليغ</button>
</form>

</body>
</html>
