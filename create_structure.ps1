# Скрипт создания структуры директорий Bitrix
# Запустить: powershell -ExecutionPolicy Bypass -File create_structure.ps1

$basePath = 'C:\Users\Анна\IdeaProjects\bitrix'

# Структура шаблона
$dirs = @(
    "$basePath\local\templates\dianomi\lang\ru",
    "$basePath\local\templates\dianomi\components\bitrix\menu\templates\megamenu",
    "$basePath\local\components\bitrix\menu\templates\megamenu",
    "$basePath\local\components\bitrix\form\templates\project_form",
    "$basePath\local\components\bitrix\main.feedback\templates\.default",
    "$basePath\local\components\dianomi\hero\templates\.default",
    "$basePath\local\components\dianomi\problems\templates\.default",
    "$basePath\local\components\dianomi\solutions\templates\.default",
    "$basePath\local\components\dianomi\before-after\templates\.default",
    "$basePath\local\components\dianomi\approach\templates\.default",
    "$basePath\local\components\dianomi\about-company\templates\.default",
    "$basePath\local\components\dianomi\faq\templates\.default",
    "$basePath\local\components\dianomi\cta-form\templates\.default",
    "$basePath\local\php\include"
)

foreach ($dir in $dirs) {
    if (-not (Test-Path $dir)) {
        New-Item -ItemType Directory -Path $dir -Force | Out-Null
        Write-Host "Created: $dir"
    } else {
        Write-Host "Exists: $dir"
    }
}

Write-Host "`nStructure created successfully!"
