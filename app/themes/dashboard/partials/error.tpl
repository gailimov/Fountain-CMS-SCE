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
