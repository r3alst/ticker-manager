# Ticker Manager

This repo includes ticker manager which can collect price feeds of pairs from tickers and do various actions .i.e. alerts, swaps and check liquidity pool creation of new tokens.

## Development

**Install dependencies:**
```
composer install 
```

**Setup Environment:**

1. copy `.env.example` as `.env` 
2. run following commands
```
php artisan key:generate
php artisan migrate
php artisan db:seed
```

**XDroid Notifications:**

1. Install xdroid notification android application:
<a href="https://play.google.com/store/apps/details?id=net.xdroid.pn">Push Notification API</a>
2. Get API key from Mobile app and put it in `.env` file as follows: 
```
XDROID_API_KEY=[API_KEY]
```

**OPTIONAL:** Please support me by contributing to project or to following BSC/ERC/TRC address.
`0x200753090BC55A39Ff790150143D28635f0E87bb`
