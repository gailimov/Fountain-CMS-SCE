<section class="content">
    <article>
        <header>
            <h2>{$lang.feedback}</h2>
        </header>
        {if $errors}
            <div class="errors">
                <p>{$lang.youNeedToCorrectTheFollowingErrors}:</p>
                <ul>
                {foreach $errors as $error}
                    <li>{$error}</li>
                {/foreach}
                </ul>
            </div>
        {/if}
        {if $success}
            <div class="success">
                <p>{$success}</p>
            </div>
        {/if}
        <form action="#" method="post">
            <div><label for="message">{$lang.message}:</label></div>
            <div><textarea name="contactForm[message]" id="message" required>{if isset($post)}{$post.message}{/if}</textarea></div>
            <div><label for="name">{$lang.name}:</label></div>
            <div><input type="text" name="contactForm[name]" id="name" value="{if isset($post)}{$post.name}{/if}" required /></div>
            <div><label for="email">{$lang.email}:</label></div>
            <div><input type="email" name="contactForm[email]" id="email" value="{if isset($post)}{$post.email}{/if}" required /></div>
            <div><input type="submit" value="{$lang.sendMessage}" /></div>
        </form>
    </article>
</section>
