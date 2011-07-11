<aside>
    <section>
        <header>
            <h4>{$lang.pages}</h4>
        </header>
        <ul>
            <li><a href="{$url}/admin/pages">{$lang.view}</a></li>
            <li><a href="{$url}/admin/pages/add">{$lang.add}</a></li>
            <li><a href="{$url}/admin/pages/edit/{$page.id}" class="active">{$lang.edit}</a></li>
        </ul>
    </section>
</aside>
<section class="content">
    <article>
        <header>
            <h2>{$lang.editPage}</h2>
        </header>
        {include file = 'partials/error.tpl'}
        <form action="#" method="post" class="admin-form">
            <div><label>{$lang.category}:</label></div>
            <div>
                <select name="page[category_id]">
                    <option value="0">{$lang.no}</option>
                {foreach $categories as $category}
                    {if $page.category_id == $category.id}{assign var="selected" value="selected"}{else}{assign var="selected" value=""}{/if}
                    <option value="{$category.id}" {$selected}>{$category.title}</option>
                {/foreach}
                </select>
            </div>
            <div><label>{$lang.plugin}:</label></div>
            <div>
                <select name="page[plugin_id]">
                    <option value="0">{$lang.no}</option>
                {foreach $plugins as $plugin}
                    {if $page.plugin_id == $plugin.id}{assign var="selected" value="selected"}{else}{assign var="selected" value=""}{/if}
                    <option value="{$plugin.id}" {$selected}>{$plugin.name}</option>
                {/foreach}
                </select>
            </div>
            <div><label for="title">{$lang.title}:</label></div>
            <div><input type="text" name="page[title]" id="title" value="{$page.title}" /></div>
            <div><label for="slug">{$lang.permalink}:</label></div>
            <div><input type="text" name="page[slug]" id="slug" value="{$page.slug}" /></div>
            <div><label for="description">{$lang.description}:</label></div>
            <div><input type="text" name="page[description]" id="description" value="{$page.description}" /></div>
            <div><label for="content">{$lang.content}:</label></div>
            <div><textarea name="page[content]" id="content">{$page.content}</textarea></div>
            <div>
                <input type="submit" name="save" value="{$lang.save}" />
                <input type="submit" name="delete" value="{$lang.delete}" />
            </div>
        </form>
    </article>
</section>
