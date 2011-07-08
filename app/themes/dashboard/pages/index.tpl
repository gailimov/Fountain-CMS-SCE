<aside>
    <section>
        <header>
            <h4>{$lang.pages}</h4>
        </header>
        <ul>
            <li><a href="#" class="active">{$lang.view}</a></li>
            <li><a href="#">{$lang.add}</a></li>
            <li><a href="#">{$lang.edit}</a></li>
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
                <th>{$lang.createdAt}</th>
                <th>{$lang.updatedAt}</th>
                <th></th>
            </tr>
        {foreach $pages as $page}
            <tr>
                <td>{$page.title}</td>
                <td>{$page.created_at}</td>
                <td>{$page.updated_at}</td>
                <td><a href="#"><img src="{$path}/img/edit.gif" title="{$lang.edit}" alt="{$lang.edit}" /></a></td>
            </tr>
        {/foreach}
        </table>
        {$pagination}
    </article>
</section>
