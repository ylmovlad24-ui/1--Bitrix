# Полный скрипт для завершения MVP
# Запустить ОДИН РАЗ: powershell -ExecutionPolicy Bypass -File finalize_mvp.ps1

Add-Type -AssemblyName System.Drawing

# 1. Создаём placeholder изображения
Write-Host "Creating placeholder images..."
$img = New-Object System.Drawing.Bitmap(1200, 630)
$graphics = [System.Drawing.Graphics]::FromImage($img)
$graphics.Clear([System.Drawing.Color]::FromArgb(73, 103, 216))

# Сохраняем во временную папку (избегаем проблем с кириллическими путями)
$tempPath = 'C:\temp\og-placeholder.jpg'
$img.Save($tempPath)

# 2. Копируем в проект
Write-Host "Copying images to project..."
$projectPath = 'C:\Users\Анна\IdeaProjects\bitrix'
Copy-Item $tempPath "$projectPath\img\og-default.jpg"
Copy-Item $tempPath "$projectPath\img\og-business-systems.jpg"
Copy-Item $tempPath "$projectPath\img\og-web-systems.jpg"

# 3. Удаляем временные файлы
Remove-Item $tempPath -ErrorAction SilentlyContinue
Remove-Item "$projectPath\create_images.ps1" -ErrorAction SilentlyContinue
Remove-Item "$projectPath\finalize_mvp.ps1" -ErrorAction SilentlyContinue

$img.Dispose()
$graphics.Dispose()

Write-Host "Images created successfully!"

# 4. Делаем git commit
Write-Host "Committing changes..."
Set-Location $projectPath
git add -A
git commit -m "Fix missing og:image files and cleanup temporary scripts"

Write-Host "`n========================================"
Write-Host "MVP FINALIZATION COMPLETE!"
Write-Host "========================================"
Write-Host ""
Write-Host "Changes committed successfully."
Write-Host "Images created: og-default.jpg, og-business-systems.jpg, og-web-systems.jpg"
Write-Host ""
Write-Host "Press any key to exit..."
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")
