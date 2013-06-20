<div id="list_container" class="wood_container">
    <div id="list_left">
        <div id="list_counter">
            <ul>
                <li id="first_number">00</li>
                <li id="second_number">00</li>
                <li id="third_number">00</li>
            </ul>
        </div>

        <div id="list_selected_burger">
            <header>
                <h1>{$burgers[0].name}</h1>
            </header>
            <div id="list_products_bar">

            </div>
            <img id="list_detail_image" src="images/burgers/{$burgers[0].image_url}" alt="{$burgers[0].name}"/>
            <div id="list_progress_bar">

                <div id="numb_active_box">
                    <div id="numb_active" style="margin-left:{($burgers[0].rating / 300) * 100}%">
                        <p>{$burgers[0].rating}</p>
                    </div>
                </div>
                <div id="list_progress_bar_outer">
                    <div id="list_progress_bar_inner" style="width:{($burgers[0].rating / 300) * 100}%"></div>
                </div>
                <p id="numb_left">0</p>
                <p id="numb_right">300</p>
            </div>
            <div class="clear"></div>
            <a id="list_vote_btn" href="#vote" src="{$burgers[0].id}"></a>
            <a id="list_voted_btn" href="#vote"></a>
            <a id="list_votedalready_btn" href="#vote"></a>
            <a id="list_votedreached_btn" href="#vote"></a>

            <p id="list_names">{$burgernames}</p>
        </div>
    </div>

    <div id="list_right">
        <form method="#" action="#">
            <fieldset>
                <input id="list_search" type="text" placeholder="search for a burger..." autocomplete="off"/>
                <button id="list_clear"><span>clear</span></button>
                <input id="list_submit" type="submit" value=""/>
            </fieldset>
        </form>

        <header id="list_burger_title">
            <h1><span>All burgers <div id="list_burger_stroke"></div></span> in the box</h1>
            <a id="list_filter" href="#"></a>
        </header>
        <div id="no_burgers"></div>
        <div id="list_all_burgers">
            <div id="columns">
                {foreach $burgers as $key => $burger}
                <div class="pin {if $key < 3}top_3{/if}">
                    {if $key < 3}<div class="list_top_3">
                        <p>Almost there!</p>
                    </div>{/if}
                    <header>
                        <h1>{$burger.name}</h1>
                    </header>
                    <p class="list_voting_count"><span class="list_voting_image"></span>{$burger.rating}</p>
                    <img class="list_burger_image" src="images/burgers/{$burger.image_url}"/>
                    <a href="{$burger.id}" class="list_burger_image_active"></a>
                </div>
                {/foreach}
            </div>
        </div>
    </div>


</div>
