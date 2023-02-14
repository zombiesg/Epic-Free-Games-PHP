# Epic Free Games PHP
Wrapper free games from Epic Games API 

## Usage
```php
<?php
require "EpicFreeGames.php";

$epicFreeGames  = new EpicFreeGames();
try {
  echo $epicFreeGames->getGames();
} catch (Exception $e) {
  echo $e;
}
?>
```

## Output
```js
{
    currentGames: [{
        title: 'Recipe for Disaster',
        id: '40607137e7ff40059c3d3ba232dae958',
        namespace: '615a4dc5c85c4c28a390dda4298acd80',
        description: 'Recipe for Disaster is a management sim that captures the fast-paced, drama-filled environment of a professional kitchen and dining room. Build your dream restaurant, create recipes, design menus and manage your staff, all while contending with disastrous situations!',
        effectiveDate: '2022-08-11T11:00:00.000Z',
        offerType: 'BASE_GAME',
        expiryDate: null,
        status: 'ACTIVE',
        isCodeRedemptionOnly: false,
        keyImages: [Array],
        seller: [Object],
        productSlug: null,
        urlSlug: '6c04d3fa72f54b93ba648b53ecdb7d24',
        url: null,
        items: [Array],
        customAttributes: [Array],
        categories: [Array],
        tags: [Array],
        catalogNs: [Object],
        offerMappings: [Array],
        price: [Object],
        promotions: [Object]
    }],
    nextGames: [{
        title: 'Warpips',
        id: 'f6e75092c08045afa343fb5c5aa817ae',
        namespace: '277788d421e748e580ca0972c339f1a6',
        description: 'Warpips is the ultimate quick to learn but amazingly deep tug-of-war strategy game. Deploy the right composition of soldiers, tanks, helicopters and planes in this tight, streamlined strategy-focused war game. Compose the best army, research the right tech; overwhelm your enemy!',
        effectiveDate: '2022-04-21T17:00:00.000Z',
        offerType: 'BASE_GAME',
        expiryDate: null,
        status: 'ACTIVE',
        isCodeRedemptionOnly: false,
        keyImages: [Array],
        seller: [Object],
        productSlug: null,
        urlSlug: '328b55dfde1c4c56927f6af911f1b276',
        url: null,
        items: [Array],
        customAttributes: [Array],
        categories: [Array],
        tags: [Array],
        catalogNs: [Object],
        offerMappings: [Array],
        price: [Object],
        promotions: [Object]
    }]
}
```

## Other Lang
- [JavaScript][1]

[1]: https://github.com/AuroPick/epic-free-games#readme
