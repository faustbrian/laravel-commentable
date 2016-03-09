# Laravel Commentable

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require draperstudio/laravel-commentable
```

And then include the service provider within `app/config/app.php`.

``` php
'providers' => [
    DraperStudio\Commentable\ServiceProvider::class
];
```

At last you need to publish and run the migration.
```
php artisan vendor:publish --provider="DraperStudio\Commentable\ServiceProvider" && php artisan migrate
```

## Usage


### Setup a Model
``` php
<?php

/*
 * This file is part of Laravel :package_name.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App;

use DraperStudio\Commentable\Contracts\Commentable;
use DraperStudio\Commentable\Traits\Commentable as CommentableTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Commentable
{
    use CommentableTrait;
}

```

### Create a comment
``` php
$user = User::first();
$post = Post::first();

$comment = $post->comment([
    'title' => 'Some title',
    'body' => 'Some body',
], $user);

dd($comment);
```

### Create a comment as a child of another comment (e.g. an answer)
``` php
$user = User::first();
$post = Post::first();

$parent = $post->comments->first();

$comment = $post->comment([
    'title' => 'Some title',
    'body' => 'Some body',
], $user, $parent);

dd($comment);
```

### Update a comment
``` php
$comment = $post->updateComment(1, [
    'title' => 'new title',
    'body' => 'new body',
]);
```

### Delete a comment
``` php
$post->deleteComment(1);
```

### Count comments an entity has
``` php
$post = Post::first();

dd($post->getCommentCount());
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hello@draperstudio.tech instead of using the issue tracker.

## Credits

- [DraperStudio][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/DraperStudio/laravel-commentable.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/DraperStudio/Laravel-Commentable/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/DraperStudio/laravel-commentable.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/DraperStudio/laravel-commentable.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/DraperStudio/laravel-commentable.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/DraperStudio/laravel-commentable
[link-travis]: https://travis-ci.org/DraperStudio/Laravel-Commentable
[link-scrutinizer]: https://scrutinizer-ci.com/g/DraperStudio/laravel-commentable/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/DraperStudio/laravel-commentable
[link-downloads]: https://packagist.org/packages/DraperStudio/laravel-commentable
[link-author]: https://github.com/DraperStudio
[link-contributors]: ../../contributors
