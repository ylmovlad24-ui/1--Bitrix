import sys

with open(r'C:\Users\Анна\IdeaProjects\bitrix\1c-bitrix-prices.html', 'r', encoding='utf-8') as f:
    lines = f.readlines()

print(f"Total lines: {len(lines)}")
print("\nLines containing 'Услуги внедрения' or 'CTA':")
for i, line in enumerate(lines):
    if 'Услуги внедрения' in line or '<!-- CTA -->' in line:
        print(f"  Line {i+1}: {line.strip()[:80]}")

# Find the first </section> after line 600 (end of comparison table)
print("\nFirst </section> after line 600:")
for i in range(600, min(700, len(lines))):
    if '</section>' in lines[i]:
        print(f"  Line {i+1}: {lines[i].strip()}")
        break

# Find orphaned table fragments - look for <th> without <table> parent
print("\nSearching for orphaned <th> tags (after line 640):")
in_table = False
for i in range(640, min(850, len(lines))):
    if '<table' in lines[i]:
        in_table = True
    if '<th' in lines[i] and not in_table:
        print(f"  Line {i+1}: {lines[i].strip()[:100]}")
    if '</table>' in lines[i]:
        in_table = False
