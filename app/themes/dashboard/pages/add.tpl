<aside>
    <section>
        <header>
            <h4>{$lang.pages}</h4>
        </header>
        <ul>
            <li><a href="{$url}/admin/pages">{$lang.view}</a></li>
            <li><a href="{$url}/admin/pages/add" class="active">{$lang.add}</a></li>
        </ul>
    </section>
</aside>
<section class="content">
    <article>
        <header>
            <h2>{$lang.addPage}</h2>
        </header>
        {include file = 'partials/notice.tpl'}
        <form action="#" method="post" class="admin-form">
            <div><label>{$lang.category}:</label></div>
            <div>
                <select name="page[category_id]">
                    <option value="0">{$lang.no}</option>
                {foreach $categories as $category}
                    <option value="{$category.id}">{$category.title}</option>
                {/foreach}
                </select>
            </div>
            <div><label>{$lang.plugin}:</label></div>
            <div>
                <select name="page[plugin_id]">
                    <option value="0">{$lang.no}</option>
                {foreach $plugins as $plugin}
                    <option value="{$plugin.id}">{$plugin.name}</option>
                {/foreach}
                </select>
            </div>
            <div><label for="title">{$lang.title}:</label></div>
            <div><input type="text" name="page[title]" id="title" value="{if isset($request)}{$request.title}{/if}" /></div>
            <div><label for="slug">{$lang.permalink}:</label></div>
            <div><input type="text" name="page[slug]" id="slug" value="{if isset($request)}{$request.slug}{/if}" /></div>
            <div><label for="description">{$lang.description}:</label></div>
            <div><input type="text" name="page[description]" id="description" value="{if isset($request)}{$request.description}{/if}" /></div>
            <div><label for="content">{$lang.content}:</label></div>
            <div><textarea name="page[content]" id="content">{if isset($request)}{$request.content}{/if}</textarea></div>
            <div>
                <input type="submit" value="{$lang.add}" />
            </div>
        </form>
    </article>
</section>
