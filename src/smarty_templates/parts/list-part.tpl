{foreach $burgers as $key => $burger}
<div class="pin {if $finished|default:false}finished{/if}">
    {if $finished|default:false}<div class="list_finished">
        <p>Nominated!</p>
    </div>{/if}
    <header>
        <h1>{$burger.name}</h1>
    </header>
    <p class="list_voting_count"><span class="list_voting_image"></span>{$burger.rating}</p>
    <img class="list_burger_image" src="images/burgers/{$burger.image_url}"/>
    <a href="{$burger.id}" class="list_burger_image_active"></a>
</div>
{/foreach}