$path = "C:/Users/Анна/IdeaProjects/bitrix/1c-bitrix-prices.html"
$lines = Get-Content $path
for($i=0; $i -lt $lines.Count; $i++) { 
    $lineNum = $i + 1
    $line = $lines[$i].Trim()
    if($line -match '</section>') { 
        Write-Output "SECTION_END: Line $lineNum"
    }
    if($line -match '<!--') { 
        Write-Output "COMMENT: Line $lineNum - $line"
    }
    if($line -match '<th') {
        Write-Output "TH_TAG: Line $lineNum - $line"
    }
}
