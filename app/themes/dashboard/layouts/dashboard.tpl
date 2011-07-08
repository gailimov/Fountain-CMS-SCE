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
                    <li>{$lang.welcome}, <a href="#" title="{$lang.editYourData}">admin</a>! | <a href="{$url}/admin/logout">{$lang.signout}</a></li>
                    <li>{$lang.yourLastVisitWas} 28.06.2011 {$lang.at} 13:15 {$lang.withIPaddress} 127.0.0.1</li>
                </ul>
            </div>
        </header> <!-- .header -->
        <nav>
            <ul>
                <li><a href="{$url}/admin" class="active">{$lang.dashboard}</a></li>
                <li><a href="{$url}/admin/pages">{$lang.pages}</a></li>
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
