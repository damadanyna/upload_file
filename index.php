<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>File Upload</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="upload-container">
        <h1>Charger les fichiers</h1>
        <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" id="fileInput" name="files[]" accept=".xls,.xlsx" multiple hidden>
            <label for="fileInput" class=" file-label bg-cyan-600 mr-5 px-3 py-[.88rem] rounded-lg text-white">
                <i class=" fas fa-folder-open"></i>
                <span class=" text-sm">Chercher les fichiers</span>
            </label>
            <button type="submit" class="upload-btn">
                <i class=" fas fa-upload"></i>
                <span class=" text-sm">Charger</span>
            </button>
        </form>
        <div id="fileList"></div>
    </div>
    <script src="tailwind.js"></script>
    <script src="upload.js"></script>
</body>

</html>