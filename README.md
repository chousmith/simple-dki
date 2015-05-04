Simple DKI
==========

Quick and Dirty Dynamic Keyword Injection with Shortcode

If a Page has a URL argument `keyword={keyword}` or `kw={keyword}` the Plugin automagically overwrites the default WordPress Page `the_title()` and Header `<title>` with that `{keyword}`. Multiple words can be separate by a `+` character which is converted to spaces upon output.

Installation
------------

# Upload file to the `/wp-content/plugins/` directory
# Activate the Simple DKI plugin through the 'Plugins' menu in the WordPress Admin Panel.
# Use the shortcode on any Pages you want
# Link people to those pages with the kw or keyword URL arguments

Changelog
---------

### 1.0.1

Updated author, author URI, and License in the Plugin info

### 1.0

Initial release
