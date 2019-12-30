# Wufoo Endpoints for Cockpit CMS

## Installation
Install Cockpit CMS addon by extracting to the addons folder (/addons/Wufoo)

### Install Dependencies

```
$ cd /addons/Wufoo
$ composer install
```

### Add Wufoo API Key and Subdomain to Config

```
wufoo:
    subdomain: YOUR_SUBDOMAIN,
    api_key: YOUR_API_KEY
```