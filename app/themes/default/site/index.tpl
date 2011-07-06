<section class="content">
{foreach $pages as $page}
    <article>
        <header>
            <h2><a href="{$url}/page/{$page.slug}">{$page.title}</a></h2>
        </header>
        {$page.content}
    </article>
{/foreach}
{$pagination}
</section>
