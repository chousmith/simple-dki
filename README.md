Simple DKI
==========

Quick and Dirty Dynamic Keyword Injection with Shortcode

If a URL argument keyword={keyword} or kw={keyword} is present, automagically overwrites the default WordPress Page the_title() and Header <title> with that {keyword}. + characters separating multiple words is automatically converted into spaces upon output.

Also provides a [keyword] shortcode for Dynamic Keyword Injection in to Page / Post / Widget / whatever content, which has the following arguments:

# case :
#* "titlecase" (default) uses ucwords(...) to Title Case whatever keyword(s) are present
#* "upper" or "uppercase"
#* "lower" or "lowercase"
# default
#* defaults to "" which will not override the default Page Title wherever it may appear, but will just not output anything when the shortcode is used.
#* optionally specify a word or phrase to output if a keyword or kw is found present in the URL

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
