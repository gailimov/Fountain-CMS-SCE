{include file='partials/header.tpl'}
{if $pagePluginId == 0}
    <section class="content">
        <article>
            <header>
                <h2>{$pageTitle}</h2>
            </header>
            {$content}
        </article>
    </section>
{else}
    {$plugin}
{/if}
{include file='partials/sidebar.tpl'}
{include file='partials/footer.tpl'}
