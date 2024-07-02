# YMCA Website Services Colorway Favicons

## Configuration

We've created a set of favicons to support each colorway. Currently, these are
set on a site-wide basis, so it's best to choose the colorway of your homepage
to use as the favicon color. In the future this could be set per-page based on
the colorway set in Y Styles.

The blue favicon is default, but using another color only requires some small
configuration changes:

1. Go to Admin > Configuration > User interface > Responsive favicons (`/admin/config/user-interface/responsive_favicons`).
2. Set **Path to responsive favicon files** to your color:
   - `/profiles/contrib/yusaopeny/assets/favicon/green`
   - `/profiles/contrib/yusaopeny/assets/favicon/purple`
   - `/profiles/contrib/yusaopeny/assets/favicon/red`
3. Copy and paste the corresponding code from below into the **Favicon tags**
block.
4. Clear caches.

### Blue

```html
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#0089d0">
<meta name="msapplication-TileColor" content="#0089d0">
<meta name="msapplication-config" content="browserconfig.xml">
<meta name="theme-color" content="#ffffff">
```

### Red

```html
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#ed1c24">
<meta name="msapplication-TileColor" content="#ed1c24">
<meta name="msapplication-config" content="browserconfig.xml">
<meta name="theme-color" content="#ffffff">
```

### Green

```html
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#01a490">
<meta name="msapplication-TileColor" content="#01a490">
<meta name="msapplication-config" content="browserconfig.xml">
<meta name="theme-color" content="#ffffff">
```

### Purple

```html
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#92278f">
<meta name="msapplication-TileColor" content="#92278f">
<meta name="msapplication-config" content="browserconfig.xml">
<meta name="theme-color" content="#ffffff">
```
