# Laravel Commentable

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require faustbrian/laravel-commentable
```

And then include the service provider within `app/config/app.php`.

``` php
'providers' => [
    BrianFaust\Commentable\CommentableServiceProvider::class
];
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

use BrianFaust\Commentable\HasCommentsTrait;
use BrianFaust\Commentable\Interfaces\HasComments;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements HasComments
{
    use HasCommentsTrait;
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

## Security

If you discover a security vulnerability within this package, please send an e-mail to Brian Faust at hello@brianfaust.de. All security vulnerabilities will be promptly addressed.

## License

The [The MIT License (MIT)](LICENSE). Please check the [LICENSE](LICENSE) file for more details.
