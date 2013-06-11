{$header}

<p>Top 3 instoppen</p>

<section id="list_burgerlist">
    {foreach $burgers as $key => $burger}
            <section class="list_burger">
                <header><h1>{$burger.name}</h1></header>
                <img src="images/burgers/{$burger.image_url}_mini.png" alt="{$burger.name}"/>
                <p class="list_rating">#{$key+3}</p>
                <a class="list_link_burger" href="?page=detail&id={$burger.id}">link naar detail</a>
            </section>
    {/foreach}
</section>