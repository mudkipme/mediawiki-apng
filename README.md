MediaWiki APNG Extension
========================

This is an extension of MediaWiki to enable animated PNG support in unsupported browsers.

Currently, the only modern browser [without APNG support](https://caniuse.com/#feat=apng) is Microsoft Edge.

Demo: [http://wiki.52poke.com/wiki/七賢人](http://wiki.52poke.com/wiki/%E4%B8%83%E8%B3%A2%E4%BA%BA)

This extension is based on David Mzareulyan's [apng-canvas library](https://github.com/davidmz/apng-canvas). Thanks for the brilliant work.

## Requirements

APNG extension requires MediaWiki 1.25 or higher. It is supported in all modern browsers and IE starting with version 10.

## Installation

To install the extension, place the entire `APNG` directory within your MediaWiki `extensions` directory, then add the following line to your `LocalSettings.php` file:

```php
wfLoadExtension( 'APNG' );
```

If you use a different domain for your `$wgUploadPath`, the web server is required to send a `Access-Control-Allow-Origin: *` header for PNG files.

For example, you can simply add the following lines to the location scope of your Nginx configuration:

```nginx
if ($request_uri ~* \.png$) {
    add_header Access-Control-Allow-Origin *;
}
```

## License

[MIT](LICENSE)