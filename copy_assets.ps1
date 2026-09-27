# Скрипт копирования файлов из текущего проекта в структуру Bitrix
# Запустить: powershell -ExecutionPolicy Bypass -File copy_assets.ps1

$src = 'C:\Users\Анна\IdeaProjects\bitrix'
$dst = 'C:\Users\Анна\IdeaProjects\bitrix'

# Копирование CSS
Copy-Item "$src\css\style.css" "$dst\css\style.css" -Force
Write-Host "Copied: css/style.css"

# Копирование JS
Copy-Item "$src\js\main.js" "$dst\js\main.js" -Force
Write-Host "Copied: js/main.js"

# Копирование изображений
Copy-Item "$src\img\*" "$dst\img\" -Force -Recurse
Write-Host "Copied: img/*"

Write-Host "`nAssets copied successfully!"
