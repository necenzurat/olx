OLX Crawler
============

Cralwer pentru olx.ro

Un crawler bazat pe [XML DOM Parser][1] pentru categoria de masini de pe olx.ro

#### De ce?
1. [de mere][2]
2. ca vruiam sa stiu ce masini se vand in romania

#### WTF?
...

#### Todo:
1. More data
2. even more data

#### How to:
```bash
    git clone https://github.com/necenzurat/olx-clarwler/ olx
    cd olx
    composer update
```

rename config.example.php in config.php
update the mysql credentials, or leave blank for sqlite fallback

```bash
    php crawler.php
```

#### License
 
[WTFPL][3]

  [1]: https://en.wikipedia.org/wiki/Document_Object_Model
  [2]: https://www.youtube.com/watch?v=dhXBBvPhGDQ
  [3]: http://www.wtfpl.net/txt/copying/
