$projectRoot = "C:\Users\Анна\IdeaProjects\bitrix"
$files = @('index.html','business-systems.html','bitrix24.html','bitrix24-prices.html','web-systems.html','1c-bitrix.html','1c-bitrix-prices.html','data-bi.html','about.html','contacts.html','404.html')
$newHeader = Get-Content "$projectRoot\partials\header.html" -Raw
$newFooter = Get-Content "$projectRoot\partials\footer.html" -Raw

foreach ($f in $files) {
    $filePath = "$projectRoot\$f"
    if (Test-Path $filePath) {
        Write-Host "Processing: $f"
        $content = Get-Content $filePath -Raw
        
        # Remove duplicate header sections (keep first one, replace all)
        $headerPattern = '(?s)(<!-- Header -->.*?</nav>\s*\n\s*<div class="mobile-overlay".*?</nav>)'
        $matches = [regex]::Matches($content, $headerPattern)
        if ($matches.Count -gt 1) {
            # Remove all but the first header
            for ($i = $matches.Count - 1; $i -gt 0; $i--) {
                $content = $content.Remove($matches[$i].Index, $matches[$i].Length)
            }
            # Update the first header
            $firstMatch = $matches[0]
            $content = $content.Substring(0, $firstMatch.Index) + $newHeader + $content.Substring($firstMatch.Index + $firstMatch.Length)
        }
        
        # Remove duplicate footer sections
        $footerPattern = '(?s)(<!-- Footer -->.*?</footer>\s*\n)'
        $matches = [regex]::Matches($content, $footerPattern)
        if ($matches.Count -gt 1) {
            for ($i = $matches.Count - 1; $i -gt 0; $i--) {
                $content = $content.Remove($matches[$i].Index, $matches[$i].Length)
            }
            $firstMatch = $matches[0]
            $content = $content.Substring(0, $firstMatch.Index) + $newFooter + $content.Substring($firstMatch.Index + $firstMatch.Length)
        }
        
        [System.IO.File]::WriteAllText($filePath, $content, [System.Text.Encoding]::UTF8)
        Write-Host "  Updated: $f"
    } else {
        Write-Host "NOT FOUND: $f"
    }
}
Write-Host "Done!"
