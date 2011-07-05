{include file='partials/header.tpl'}
{if $page.plugin_id == 0}
    <section class="content">
        <article>
            <header>
                <h2>{$page.title}</h2>
            </header>
            {$page.content}
        </article>
    </section>
{else}
    {$plugin}
{/if}
{include file='partials/sidebar.tpl'}
{include file='partials/footer.tpl'}
