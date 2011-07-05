<section class="content">
    <article>
        <header>
            <h2>{$lang.feedback}</h2>
        </header>
        <form action="#" method="post">
            <div><label for="message">{$lang.message}:</label></div>
            <div><textarea name="contactForm[message]" id="message" required></textarea></div>
            <div><label for="name">{$lang.name}:</label></div>
            <div><input type="text" name="contactForm[name]" id="name" required /></div>
            <div><label for="email">{$lang.email}:</label></div>
            <div><input type="email" name="contactForm[email]" id="email" required /></div>
            <div><input type="submit" value="{$lang.sendMessage}" /></div>
        </form>
    </article>
</section>
