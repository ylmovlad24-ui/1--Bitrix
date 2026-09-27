import os
root = 'C:\Users\Анна\IdeaProjects\bitrix'
fpath = os.path.join(root, 'index.html')
content = open(fpath, encoding='utf-8').read()
headers = content.count('<header class="header"')
footers = content.count('<footer class="footer"')
with open(os.path.join(root, 'result.txt'), 'w', encoding='utf-8') as f:
    f.write(f'Headers: {headers}, Footers: {footers}\n')
    
# Check for deleted page links
deleted = ['ai-bots.html', 'approach.html', 'cases.html', 'integrations.html', 'privacy.html', 'personal-data.html', 'license.html', 'success.html', 'bitrix24-on-premise.html']
for d in deleted:
    count = content.count(d)
    if count > 0:
        f.write(f'{d}: {count} references\n')
f.write('Done\n')
