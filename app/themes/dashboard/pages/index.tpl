<aside>
    <section>
        <header>
            <h4>{$lang.pages}</h4>
        </header>
        <ul>
            <li><a href="{$url}/admin/pages" class="active">{$lang.view}</a></li>
            <li><a href="{$url}/admin/pages/add">{$lang.add}</a></li>
        </ul>
    </section>
</aside>
<section class="content">
    <article>
        <header>
            <h2>{$lang.pages}</h2>
        </header>
        <table>
            <tr>
                <th>{$lang.title}</th>
                <th>{$lang.category}</th>
                <th>{$lang.createdAt}</th>
                <th>{$lang.updatedAt}</th>
                <th></th>
            </tr>
        {foreach $pages as $page}
            <tr>
                <td>{$page.title}</td>
            {foreach $categories as $category}
                {if $category.id == $page.category_id}
                    <td><a href="#" title="Посмотреть все страницы в этой категории">{$category.title}</a></td>
                {/if}
            {/foreach}
            {if $page.category_id == 0}
                <td><a href="#" title="Посмотреть все страницы в этой категории">{$lang.no}</a></td>
            {/if}
                <td>{$page.created_at}</td>
                <td>{$page.updated_at}</td>
                <td><a href="{$url}/admin/pages/edit/{$page.id}"><img src="{$path}/img/edit.gif" title="{$lang.edit}" alt="{$lang.edit}" /></a></td>
            </tr>
        {/foreach}
        </table>
        {$pagination}
    </article>
</section>
