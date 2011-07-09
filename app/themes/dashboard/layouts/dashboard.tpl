<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{$path}/css/style.css" media="all" />
    <title>{$mainTitle}</title>
</head>
<body>
    <div id="wrapper" class="round">
        <header class="header">
            <div class="logo round">
                <h1><a href="{$url}" title="{$lang.backToTheSite}">{$title}</a></h1>
            </div>
            <div class="info round">
                <ul>
                    <li>{$lang.welcome}, <a href="#" title="{$lang.editYourData}">{$manager.username}</a>! | <a href="{$url}/admin/logout">{$lang.signout}</a></li>
                    <li>{$lang.yourLastVisitWas} {$manager.formatted_login_at} {$lang.withIPaddress} {$manager.last_ip}</li>
                </ul>
            </div>
        </header> <!-- .header -->
        <nav>
            <ul>
                <li><a href="{$url}/admin"{if $controller == 'Admin'}class="active"{/if}>{$lang.dashboard}</a></li>
                <li><a href="{$url}/admin/pages"{if $controller == 'Pages'}class="active"{/if}>{$lang.pages}</a></li>
                <li><a href="#">{$lang.categories}</a></li>
                <li><a href="#">{$lang.plugins}</a></li>
                <li><a href="#">{$lang.settings}</a></li>
            </ul>
        </nav>
        {include file = $content}
        <footer>
            <p>&copy; &laquo;{$name} {$version}&raquo; {$smarty.now|date_format: 'Y'}</p>
        </footer>
    </div> <!-- #wrapper -->
</body>
</html>
