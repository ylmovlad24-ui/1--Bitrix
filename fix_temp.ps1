$file = 'C:\Users\Анна\IdeaProjects\bitrix\1c-bitrix-prices.html'
$lines = [System.IO.File]::ReadAllLines($file, [System.Text.Encoding]::UTF8)

Write-Host "Total lines: $($lines.Length)"

Write-Host "`nSearching for 'Услуги внедрения':"
for ($i = 0; $i -lt $lines.Length; $i++) {
    if ($lines[$i] -match 'Услуги внедрения|<!-- CTA -->') {
        Write-Host "  Line $($i+1): $($lines[$i].Trim().Substring(0, [Math]::Min(80, $lines[$i].Trim().Length)))"
    }
}

Write-Host "`nFirst </section> after line 600:"
for ($i = 600; $i -lt [Math]::Min(700, $lines.Length); $i++) {
    if ($lines[$i] -match '</section>') {
        Write-Host "  Line $($i+1): $($lines[$i].Trim())"
        break
    }
}
