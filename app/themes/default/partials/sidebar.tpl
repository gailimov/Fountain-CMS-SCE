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
