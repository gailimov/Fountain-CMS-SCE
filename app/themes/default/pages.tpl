{include file='partials/header.tpl'}
<section class="content">
{foreach $pages as $page}
    <article>
        <header>
            <h2>{$page.title}</h2>
        </header>
        {$page.content}
    </article>
{/foreach}
</section>
{include file='partials/sidebar.tpl'}
{include file='partials/footer.tpl'}
