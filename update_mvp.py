import os
import re

root = os.path.dirname(os.path.abspath(__file__))
files = ['index.html','business-systems.html','bitrix24.html','bitrix24-prices.html','web-systems.html','1c-bitrix.html','1c-bitrix-prices.html','data-bi.html','about.html','contacts.html','404.html']

header_path = os.path.join(root, 'partials', 'header.html')
footer_path = os.path.join(root, 'partials', 'footer.html')

with open(header_path, 'r', encoding='utf-8') as f:
    new_header = f.read()
with open(footer_path, 'r', encoding='utf-8') as f:
    new_footer = f.read()

for fname in files:
    fpath = os.path.join(root, fname)
    if os.path.exists(fpath):
        with open(fpath, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Remove duplicate headers (keep first, remove rest)
        header_pattern = r'(<!-- Header -->.*?</nav>\s*\n\s*<div class="mobile-overlay".*?</nav>)'
        matches = list(re.finditer(header_pattern, content, re.DOTALL))
        if len(matches) > 1:
            for m in reversed(matches[1:]):
                content = content[:m.start()] + content[m.end():]
            content = content[:matches[0].start()] + new_header + content[matches[0].end():]
        
        # Remove duplicate footers
        footer_pattern = r'(<!-- Footer -->.*?</footer>\s*\n)'
        matches = list(re.finditer(footer_pattern, content, re.DOTALL))
        if len(matches) > 1:
            for m in reversed(matches[1:]):
                content = content[:m.start()] + content[m.end():]
            content = content[:matches[0].start()] + new_footer + content[matches[0].end():]
        
        with open(fpath, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f'Updated: {fname}')
    else:
        print(f'NOT FOUND: {fname}')

print('Done!')
