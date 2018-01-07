/**
 * @preserve
 * APNG-loader
 *
 * @author Mudkip Me
 * @copyright 2013 Mudkip Me
 * @link https://github.com/mudkipme/mediawiki-apng
 * @license https://github.com/mudkipme/mediawiki-apng/blob/master/LICENSE (MIT License)
 */
$(function () {
    var apng = $('img.apng[src$=".png"], .apng img[src$=".png"]');
    if (mw.config.get('wgCanonicalNamespace') == 'File' && mw.config.get('wgTitle').match(/\.png$/)
        && $('.mw-noanimatethumb').size() > 0) {
        apng = apng.add('#file img');
    }
    if (apng.size() > 0) {
        APNG.ifNeeded().then(function () {
            apng.each(function (i, img) {
                APNG.animateImage(img);
            });
        });
    }
});