Add-Type -AssemblyName System.Drawing
$img = New-Object System.Drawing.Bitmap(1200, 630)
$graphics = [System.Drawing.Graphics]::FromImage($img)
$graphics.Clear([System.Drawing.Color]::FromArgb(73, 103, 216))
$tempPath = 'C:\temp\og-placeholder.jpg'
$img.Save($tempPath)
Copy-Item $tempPath 'C:\temp\og-default.jpg'
Copy-Item $tempPath 'C:\temp\og-business-systems.jpg'
Copy-Item $tempPath 'C:\temp\og-web-systems.jpg'
Remove-Item $tempPath
$graphics.Dispose()
$img.Dispose()
Write-Host 'Created placeholder images in C:\temp\'
Get-ChildItem 'C:\temp\og-*.jpg' | Select-Object Name, Length
