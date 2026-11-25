Dirindex
========

This is a drop-in replacement for Apache's built-in directory indexes, to modernize it with modern accessibility, dark mode, nicer-looking icons, etc.

For a demo, it's currently running in:

https://play.pokemonshowdown.com/sprites/

To use, put the `dirindex` directory in your webroot, then add this to your `.htaccess`:

```
DirectoryIndex index.php index.html /dirindex/dirindex.php
```

License
-------

Dirindex is mostly MIT-licensed.

The included icons are from Font Awesome 4.7 by Dave Gandy, whose CSS files are MIT licensed, and whose font files are SIL OFL 1.1.

See the [Font Awesome 4 license details](https://fontawesome.com/v4/license/).
