with open(r'C:\Users\Анна\IdeaProjects\bitrix\1c-bitrix-prices.html', 'r', encoding='utf-8') as f:
    lines = f.readlines()

# Keep lines 0-637 (up to and including </section> on line 638)
# Skip lines 638-811 (corrupted fragments)
# Keep lines 812+ (starting from <!-- Производительность -->)

with open(r'C:\Users\Анна\IdeaProjects\bitrix\1c-bitrix-prices-fixed.html', 'w', encoding='utf-8') as f:
    f.writelines(lines[:638])  # Lines 1-638 (0-637)
    f.writelines(lines[812:])  # Lines 813+ (812+)

print("Fixed file created: 1c-bitrix-prices-fixed.html")
print(f"Original: {len(lines)} lines")
print(f"Fixed: {len(lines[:638]) + len(lines[812:])} lines")
print(f"Removed: {len(lines[638:812])} lines")
