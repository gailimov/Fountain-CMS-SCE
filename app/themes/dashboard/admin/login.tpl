<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{$path}/css/login.css" media="all" />
    <title>{$lang.authentication} | {$lang.dashboard} | {$name}</title>
</head>
<body>
    <header class="header">
        <h1><a href="{$url}" title="{$lang.backToTheSite}">{$mainTitle}</a></h1>
    </header>
    <section class="login-form">
        <header>
            <h2>{$lang.authentication}</h2>
        </header>
        {if $errors}
            <div class="errors">
                <p>{$lang.youNeedToCorrectTheFollowingErrors}:</p>
                <ul>
                {foreach $errors as $error}
                    <li>{$error}</li>
                {/foreach}
                </ul>
            </div>
        {/if}
        <form action="#" method="post">
            <div><label for="username">{$lang.username}:</label></div>
            <div><input type="text" name="user[username]" id="username" value="{if isset($request)}{$request.username}{/if}" /></div>
            <div><label for="password">{$lang.password}:</label></div>
            <div><input type="password" name="user[password]" id="password" /></div>
            <div><input type="submit" value="{$lang.login}" /></div>
        </form>
    </section>
    <footer>
        <p>&copy; &laquo;{$name} {$version}&raquo; {$smarty.now|date_format: 'Y'}</p>
    </footer>
</body>
</html>
