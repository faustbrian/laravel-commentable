# Laravel Commentable

[![Build Status](https://img.shields.io/travis/faustbrian/Laravel-Commentable/master.svg?style=flat-square)](https://travis-ci.org/faustbrian/Laravel-Commentable)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/faustbrian/laravel-commentable.svg?style=flat-square)]()
[![Latest Version](https://img.shields.io/github/release/faustbrian/Laravel-Commentable.svg?style=flat-square)](https://github.com/faustbrian/Laravel-Commentable/releases)
[![License](https://img.shields.io/packagist/l/faustbrian/Laravel-Commentable.svg?style=flat-square)](https://packagist.org/packages/faustbrian/Laravel-Commentable)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require faustbrian/laravel-commentable
```

To get started, you'll need to publish the vendor assets and migrate:

```
php artisan vendor:publish --provider="BrianFaust\Commentable\CommentableServiceProvider" && php artisan migrate
```

## Usage


### Setup a Model
``` php
<?php

namespace App;


use BrianFaust\Commentable\Traits\HasComments;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasComments;
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

dd($post->commentCount());
```

## Testing

``` bash
$ phpunit
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@brianfaust.me. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.me)
