# Multi-Site Architecture for Bitrix

## Overview

This document describes the multi-site architecture for hosting multiple Bitrix websites on a single domain with shared core and isolated site content.

## Recommended Structure

```
/var/www/site.ru/
│
├── bitrix/                          # Shared Bitrix core (installed once)
│   ├── modules/                     # Core modules (shared)
│   ├── components/                  # Core components (shared)
│   ├── templates/                   # Core templates (shared)
│   └── php_interface/               # Shared application logic
│       ├── dbconn.php               # Database connection (if separate DBs)
│       ├── init.php                 # Initialization for ALL sites
│       ├── events.php               # Event handlers (shared)
│       └── settings.php             # Global settings
│
├── dianomi/                         # Site 1 (current site)
│   ├── index.php                    # Site entry point
│   ├── bitrix24.php                 # Site pages
│   ├── contacts.php
│   └── bitrix/
│       ├── templates/               # Site-specific templates
│       │   └── dianomi/
│       │       ├── header.php
│       │       ├── footer.php
│       │       ├── style.css
│       │       └── img/
│       ├── components/              # Site-specific components (optional)
│       └── php_interface/           # Site-specific initialization
│           └── init.php
│
├── shop/                            # Site 2 (example)
│   ├── index.php
│   ├── catalog.php
│   └── bitrix/
│       ├── templates/
│       │   └── shop_template/
│       └── php_interface/
│           └── init.php
│
└── blog/                            # Site 3 (example)
    ├── index.php
    └── bitrix/
        ├── templates/
        │   └── blog_template/
        └── php_interface/
            └── init.php
```

## Key Principles

### 1. Shared Core (bitrix/)
- **Single installation** of Bitrix framework
- All sites share the same core files
- Updates to core affect all sites
- Location: `/var/www/site.ru/bitrix/`

### 2. Isolated Sites
- Each site has its own folder at root level
- Sites are completely isolated from each other
- Separate templates, components, and page files
- Can have separate databases or shared database

### 3. Site-Specific Customizations
- Each site can override shared logic in its own `bitrix/php_interface/init.php`
- Site-specific templates in `bitrix/templates/{site_name}/`
- Site-specific components in `bitrix/components/` (if needed)

## Bitrix Admin Configuration

### For Each Site (in Bitrix Admin):

**Settings → Site Management → Add/Edit Site**

| Field | Value for Dianomi | Value for Shop |
|-------|-------------------|----------------|
| **Domain** | `site.ru` | `site.ru` |
| **Site Code** | `dianomi` | `shop` |
| **Folder** | `/dianomi/` | `/shop/` |
| **Document Root** | `/var/www/site.ru/` | `/var/www/site.ru/` |
| **Template** | `dianomi` | `shop_template` |
| **Sort Order** | `100` | `200` |
| **Active** | Yes | Yes |

## Database Strategies

### Option A: Single Database (Recommended for similar sites)
```
Database: site_ru_db
Tables: b_user, b_iblock, b_block... (all sites share)
Site differentiation: IBlock filters by ID or properties
```

**Pros:**
- Simpler backups
- Easier to manage
- Good for sites with similar content structure

**Cons:**
- Content mixing risk
- Less isolation

### Option B: Separate Databases (Recommended for different clients/projects)
```
Database 1: site_ru_dianomi
Database 2: site_ru_shop
Database 3: site_ru_blog
```

**Connection in `bitrix/php_interface/dbconn.php`:**
```php
<?php
// This file can be overridden per-site in site_folder/bitrix/php_interface/dbconn.php

if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/dbconn.php')) {
    return include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/dbconn.php');
}

// Default database connection
$dbHost = 'localhost';
$dbUser = 'site_ru_default';
$dbPassword = 'password';
$dbName = 'site_ru_default';

define('DB_HOST', $dbHost);
define('DB_USER', $dbUser);
define('DB_PASSWORD', $dbPassword);
define('DB_NAME', $dbName);
```

**Site-specific connection in `/dianomi/bitrix/php_interface/dbconn.php`:**
```php
<?php
// Dianomi site uses its own database
define('DB_HOST', 'localhost');
define('DB_USER', 'site_ru_dianomi');
define('DB_PASSWORD', 'dianomi_password');
define('DB_NAME', 'site_ru_dianomi');
```

## Deployment Workflow

### 1. Create New Site
```bash
# Run the site initialization script
php scripts/create-new-site.php --name=newsite --domain=site.ru
```

### 2. Manual Creation
```bash
# Copy template structure
cp -r template-site/ newsite/

# Update site files
nano newsite/index.php
nano newsite/bitrix/php_interface/init.php
```

### 3. Configure in Bitrix Admin
1. Go to Settings → Site Management
2. Add new site with folder `/newsite/`
3. Assign template
4. Configure domain

## Module Management

### Shared Modules (in bitrix/modules/)
- Installed once, available to all sites
- Example: `sprint.migration/`, custom shared modules

### Site-Specific Modules (in site_folder/bitrix/modules/)
- Example: `/dianomi/bitrix/modules/dianomi/`
- Only loaded for specific site

## Template Structure

Each site should have its own template:

```
bitrix/templates/{site_name}/
├── .description.php       # Template metadata
├── .style.php            # Template parameters
├── header.php            # Header include
├── footer.php            # Footer include
├── styles.css            # Template styles
├── img/                  # Template images
├── css/                  # Additional CSS
└── js/                   # Template JavaScript
```

## Security Considerations

1. **File Permissions:**
   - Core `bitrix/`: 755 (directories), 644 (files)
   - Site folders: 755 (directories), 644 (files)
   - `php_interface/`: readable by web server

2. **Isolation:**
   - Sites cannot access each other's templates
   - Separate session cookies per site (configured in Bitrix)
   - Database access controlled per site

3. **Backup Strategy:**
   - Core `bitrix/`: backup weekly
   - Site folders: backup daily
   - Databases: backup daily (or per-site if separate)

## Troubleshooting

### Site not loading
1. Check folder exists: `ls -la /var/www/site.ru/{site_name}/`
2. Check `index.php` exists in site folder
3. Check Bitrix admin site configuration
4. Check permissions

### Templates not showing
1. Verify template exists in `bitrix/templates/{site_name}/`
2. Check template code matches in Bitrix admin
3. Clear cache: Settings → System Settings → Cache

### Database connection errors
1. Check `bitrix/php_interface/dbconn.php` exists
2. Verify database credentials
3. Check database exists and is accessible

## Migration from Single Site to Multi-Site

If migrating existing single site:

1. Create new structure with shared `bitrix/`
2. Move existing site to `dianomi/` folder
3. Update Bitrix admin site configuration
4. Test all functionality
5. Add new sites as needed

## Performance Optimization

1. **Cache:**
   - Enable layered cache in Bitrix
   - Each site has separate cache in its folder
   - Use OPcache for PHP

2. **Static Files:**
   - Serve images/CSS/JS via web server directly
   - Use CDN for static assets
   - Enable compression in `.htaccess`

3. **Database:**
   - Enable query cache
   - Optimize tables regularly
   - Use separate DB servers for high-load sites

## Monitoring

1. **Per-site metrics:**
   - Traffic analytics (separate for each site)
   - Performance monitoring
   - Error logs per site

2. **Core monitoring:**
   - Bitrix version
   - Module updates
   - Security patches

## Support & Maintenance

- **Core updates:** Test on staging first, affect all sites
- **Site-specific changes:** Safe to deploy independently
- **Module updates:** Check compatibility with all sites
- **Backup testing:** Restore individual sites from backup

---

**Version:** 1.0  
**Last Updated:** 2025  
**Maintained by:** Development Team
