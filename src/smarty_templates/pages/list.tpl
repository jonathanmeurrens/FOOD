{*

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
</section>*}

<div id="list_container" class="wood_container">
    <div id="list_left">
        <div id="list_counter">
            <ul>
                <li id="first_number">48</li>
                <li id="second_number">12</li>
                <li id="third_number">22</li>
            </ul>
        </div>

        <div id="list_selected_burger">
            <header>
                <h1>Awesome-o-burger</h1>
            </header>
            <div id="list_products_bar">

            </div>
            <img src="images/burgers/burger_1.png" alt="naam_burger"/>
            <div id="list_progress_bar">
                <div id="numb_active">
                    <p>165</p>
                </div>
                <div id="list_progress_bar_outer">
                    <div id="list_progress_bar_inner"></div>
                </div>
                <p id="numb_left">0</p>
                <p id="numb_right">300</p>
            </div>
            <div class="clear"></div>
            <a id="list_vote_btn" href="#vote"></a>
            <p id="list_names">paul, martine, jacky, berend, bol, hazepad, handyman, mengkom</p>
        </div>
    </div>

    <div id="list_right">
        <form method="#" action="#">
            <fieldset>
                <input id="list_search" type="text" placeholder="search for a burger..."/>
                <input id="list_submit" type="submit" value="" />
            </fieldset>
        </form>

        <header id="list_burger_title">
            <h1><span>All burgers <div id="list_burger_stroke"></div></span> in the box</h1>
            <a id="list_filter" href="#"></a>
        </header>
        <div id="list_all_burgers">
            <div id="columns">
                <div class="pin top_3">
                    <div class="list_top_3">
                        <p>Almost there!</p>
                    </div>
                    <header>
                        <h1>Superburger</h1>
                    </header>
                    <p class="list_voting_count"><span class="list_voting_image"></span>280</p>
                    <img  id="kaka" class="list_burger_image" src="images/burgers/burger_1.png" />
                    <div class="list_burger_image_active"></div>
                </div>
                <div class="pin top_3">
                    <div class="list_top_3">
                        <p>Almost there!</p>
                    </div>
                    <header>
                        <h1>megaburger</h1>
                    </header>
                        <img src="images/burgers/burger_1.png" />
                    </div>
                    <div class="pin top_3">
                        <div class="list_top_3">
                            <p>Almost there!</p>
                        </div>
                        <header>
                            <h1>kakadrol</h1>
                        </header>
                        <img src="images/burgers/burger_1.png" />
                    </div>

                    <div class="pin">
                        <header>
                            <h1>Braakbal extremistimus</h1>
                        </header>
                        <img src="images/burgers/burger_1.png" />
                    </div>

                    <div class="pin">
                        <header>
                            <h1>Superburger</h1>
                        </header>
                        <img src="images/burgers/burger_1.png" />
                    </div>

                    <div class="pin">
                        <header>
                            <h1>Superburger</h1>
                        </header>
                        <img src="images/burgers/burger_1.png" />
                    </div>

                    <div class="pin">
                        <header>
                            <h1>Superburger</h1>
                        </header>
                        <img src="images/burgers/burger_1.png" />
                    </div>

                    <div class="pin">
                        <header>
                            <h1>Superburger</h1>
                        </header>
                        <img src="images/burgers/burger_1.png" />
                    </div>

                    <div class="pin">
                        <header>
                            <h1>Superburger</h1>
                        </header>
                        <img src="images/burgers/burger_1.png" />
                    </div>

                    <div class="pin">
                        <header>
                            <h1>Superburger</h1>
                        </header>
                        <img src="images/burgers/burger_1.png" />
                    </div>

                    <div class="pin">
                        <header>
                            <h1>Superburger</h1>
                        </header>
                        <img src="images/burgers/burger_1.png" />
                    </div>

                    <div class="pin">
                        <header>
                            <h1>Superburger</h1>
                        </header>
                        <img src="images/burgers/burger_1.png" />
                    </div>

                    <div class="pin">
                        <header>
                            <h1>Superburger</h1>
                        </header>
                        <img src="images/burgers/burger_1.png" />
                    </div>

                    <div class="pin">
                        <header>
                            <h1>Superburger</h1>
                        </header>
                    </div>

                    <div class="pin">
                        <header>
                            <h1>Superburger</h1>
                        </header>
                        <img src="images/burgers/burger_1.png" />
                    </div>
            </div>
        </div>
    </div>


</div>
