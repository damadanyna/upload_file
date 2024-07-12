<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Fonction pour vérifier et créer le répertoire d'upload si nécessaire
function ensureUploadsDirectory($uploadsDir)
{
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0777, true);
    }
}

// Fonction pour vérifier si le type de fichier est autorisé
function isFileTypeAllowed($fileType)
{
    $allowedTypes = [
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];
    return in_array($fileType, $allowedTypes);
}

// Fonction pour charger et traiter le fichier Excel
function processExcelFile($filePath, $fileName)
{
    // Charger le fichier Excel
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    // Créer une chaîne pour stocker les données
    $content = "";

    foreach ($data as $row) {
        foreach ($row as $cell) {
            $cellValue = ($cell !== null) ? htmlspecialchars($cell) : '';
            $content .= "$cellValue | ";
        }
        $content .= "\n"; // Nouvelle ligne pour chaque nouvelle ligne de données
    }

    // Enregistrer les données dans un fichier texte
    $txtFilePath = 'uploads/' . pathinfo($fileName, PATHINFO_FILENAME) . '.txt';
    file_put_contents($txtFilePath, $content);

    echo "Voici le lien du fichier  '$fileName'<br>  👉 <a href='$txtFilePath'>$txtFilePath</a> 😎😎.<br>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {
    $uploadsDir = 'uploads/';
    ensureUploadsDirectory($uploadsDir);

    foreach ($_FILES['files']['name'] as $key => $name) {
        $tmpName = $_FILES['files']['tmp_name'][$key];
        $fileType = $_FILES['files']['type'][$key];

        if (isFileTypeAllowed($fileType)) {
            $filePath = $uploadsDir . basename($name);
            move_uploaded_file($tmpName, $filePath);
            echo "Fichier '$name' Est importer 🥱.<br>";

            processExcelFile($filePath, $name);
        } else {
            echo "File '$name' is not a valid Excel file.<br>";
        }
    }
} else {
    echo "No files uploaded.";
}
