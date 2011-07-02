<aside>
    <section>
        <header>
            <h4>Категории</h4>
        </header>
        <ul>
        {foreach $categories as $category}
            <li><a href="{$url}/site/category/{$category.slug}">{$category.title}</a></li>
        {/foreach}
        </ul>
    </section>
</aside>
