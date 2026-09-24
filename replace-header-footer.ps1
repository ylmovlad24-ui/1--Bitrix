# Replace corrupted header and footer with correct versions from partials

$dir = 'C:\Users\Vlad\Documents\Ptodjec\1--Bitrix'
$partialsDir = Join-Path $dir 'partials'

# Read correct header and footer from partials
$header = Get-Content (Join-Path $partialsDir 'header.html') -Raw -Encoding UTF8
$footer = Get-Content (Join-Path $partialsDir 'footer.html') -Raw -Encoding UTF8

# Get all HTML files (except license.html - old template)
$htmlFiles = Get-ChildItem -Path $dir -Filter '*.html' | Where-Object { $_.Name -notin @('license.html') }

Write-Output "Processing $($htmlFiles.Count) HTML files..."
Write-Output ""

$fixed = 0
$errors = 0

foreach ($file in $htmlFiles) {
    try {
        $content = Get-Content $file.FullName -Raw -Encoding UTF8
        
        # Remove old header (from <!-- Header --> to </header>)
        $content = [regex]::Replace($content, '<!-- Header -->.*?</header>', $header, 'Singleline')
        
        # Remove old footer (from <!-- Footer --> to </footer>)
        $content = [regex]::Replace($content, '<!-- Footer -->.*?</footer>', $footer, 'Singleline')
        
        # Save with UTF-8 BOM
        $utf8BOM = New-Object System.Text.UTF8Encoding $true
        [System.IO.File]::WriteAllText($file.FullName, $content, $utf8BOM)
        
        Write-Output "OK: $($file.Name)"
        $fixed++
    }
    catch {
        Write-Output "ERROR: $($file.Name) - $_"
        $errors++
    }
}

Write-Output ""
Write-Output "Fixed: $fixed, Errors: $errors"
