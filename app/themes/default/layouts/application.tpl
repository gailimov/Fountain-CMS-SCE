<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="description" content="{$description}" />
    <link rel="stylesheet" href="{$themePath}css/style.css" media="all" />
    <title>{$mainTitle}</title>
</head>
<body>
    <div id="wrapper" class="round">
        <div class="header">
            <header class="logo round">
                <h1><a href="{$url}" rel="home" title="На главную">{$title}</a></h1>
            </header>
            <nav class="round">
                <ul>
                    <li><a href="{$url}" rel="home">{$lang.home}</a></li>
                {foreach $menu as $nav}
                    <li><a href="{$url}/page/{$nav.slug}">{$nav.title}</a></li>
                {/foreach}
                </ul>
            </nav>
        </div> <!-- .header -->
        {include file = $content}
        <aside>
            <section>
                <header>
                    <h4>{$lang.categories}</h4>
                </header>
                <ul>
                {foreach $categories as $category}
                    <li><a href="{$url}/category/{$category.slug}">{$category.title}</a></li>
                {/foreach}
                </ul>
            </section>
        </aside>
        <footer>
            <p>&copy; &laquo;{$title}&raquo; {$smarty.now|date_format: 'Y'}</p>
        </footer>
    </div> <!-- #wrapper -->
</body>
</html>
